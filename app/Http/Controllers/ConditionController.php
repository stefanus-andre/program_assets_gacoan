<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterCondition;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class ConditionController extends Controller
{
    public function Index()
    {
        $conditions = DB::table('m_condition')->select('m_condition.*')->paginate(10);

        return view("Admin.condition", ['conditions' => $conditions]);
    }

    public function HalamanCondition() 
    {
        $conditions = DB::table('m_condition')->select('m_condition.*')->paginate(10);

        return view("Admin.condition", ['conditions' => $conditions]);
    }

    public function getCondition()
    {
        // Mengambil semua data dari tabel m_condition
        $conditions = MasterCondition::all();
        return response()->json($conditions); // Mengembalikan data dalam format JSON
    }

    public function AddDataCondition(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'condition_name' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterCondition
            $condition = new MasterCondition();
            $condition->condition_name = $request->input('condition_name');
            $condition->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan condition_id secara otomatis
            $maxConditionId = MasterCondition::max('condition_id'); // Ambil nilai condition_id maksimum
            $condition->condition_id = $maxConditionId ? $maxConditionId + 1 : 1; // Set condition_id, mulai dari 1 jika tidak ada
            
            $condition->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $condition->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'condition berhasil ditambahkan',
                'redirect_url' => route('Admin.condition')
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    // Example push notification function
    private function sendPushNotification($expoPushToken, $title, $body)
    {
        $url = 'https://exp.host/--/api/v2/push/send';
        $data = [
            'to' => $expoPushToken,
            'sound' => 'default',
            'title' => $title,
            'body' => $body,
            'data' => ['ConditionId' => '12345']
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/json\r\n",
                'method' => 'POST',
                'content' => json_encode($data)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        return $result;
    }

    public function updateDataCondition(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'condition_name' => 'required|string|max:255',
        ]);

        // Cek apakah condition dengan id yang benar ada
        $condition = MasterCondition::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$condition) {
            return response()->json(['status' => 'error', 'message' => 'condition not found.'], 404);
        }

        // Update data condition
        $condition->condition_name = $request->condition_name;
        
        if ($condition->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'condition updated successfully.',
                'redirect_url' => route('Admin.condition'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update condition.'], 500);
        }
    }

    public function deleteDataCondition($id)
    {
        $condition = MasterCondition::find($id);

        if ($condition) {
            $condition->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'condition deleted successfully.',
                'redirect_url' => route('Admin.condition')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data condition Gagal Terhapus'], 404);
        }
    }


    public function details($ConditionId)
    {
        $condition = MasterCondition::where('condition_id', $ConditionId)->first();

        if (!$condition) {
            abort(404, 'condition not found');
        }

        return view('condition.details', ['asset' => $condition]);
    }
}
