<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterPriority;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class PriorityController extends Controller
{
    public function Index()
    {
        $prioritys = DB::table('m_priority')->select('m_priority.*')->paginate(10);

        return view("Admin.priority", ['prioritys' => $prioritys]);
    }

    public function HalamanPriority() 
    {
        $prioritys = DB::table('m_priority')->select('m_priority.*')->paginate(10);

        return view("Admin.priority", ['prioritys' => $prioritys]);
    }

    public function getPriority()
    {
        // Mengambil semua data dari tabel m_priority
        $prioritys = MasterPriority::all();
        return response()->json($prioritys); // Mengembalikan data dalam format JSON
    }

    public function AddDataPriority(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'priority_name' => 'required|string|max:255',
            'priority_code' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterPriority
            $priority = new MasterPriority();
            $priority->priority_code = $request->input('priority_code');
            $priority->priority_name = $request->input('priority_name');
            $priority->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan priority_id secara otomatis
            $maxPriorityId = MasterPriority::max('priority_id'); // Ambil nilai priority_id maksimum
            $priority->priority_id = $maxPriorityId ? $maxPriorityId + 1 : 1; // Set priority_id, mulai dari 1 jika tidak ada
            
            $priority->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $priority->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'priority berhasil ditambahkan',
                'redirect_url' => route('Admin.priority')
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
            'data' => ['PriorityId' => '12345']
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

    public function updateDataPriority(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'priority_code' => 'required|string|max:255',
            'priority_name' => 'required|string|max:255',
        ]);

        // Cek apakah priority dengan id yang benar ada
        $priority = MasterPriority::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$priority) {
            return response()->json(['status' => 'error', 'message' => 'priority not found.'], 404);
        }

        // Update data priority
        $priority->priority_code = $request->priority_code;
        $priority->priority_name = $request->priority_name;
        
        if ($priority->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'priority updated successfully.',
                'redirect_url' => route('Admin.priority'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update priority.'], 500);
        }
    }

    public function deleteDataPriority($id)
    {
        $priority = MasterPriority::find($id);

        if ($priority) {
            $priority->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'priority deleted successfully.',
                'redirect_url' => route('Admin.priority')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data priority Gagal Terhapus'], 404);
        }
    }


    public function details($PriorityId)
    {
        $priority = MasterPriority::where('priority_id', $PriorityId)->first();

        if (!$priority) {
            abort(404, 'priority not found');
        }

        return view('priority.details', ['asset' => $priority]);
    }
}