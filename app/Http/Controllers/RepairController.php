<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterRepair;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class RepairController extends Controller
{
    public function Index()
    {
        $repairs = DB::table('m_repair')->select('m_repair.*')->paginate(10);

        return view("Admin.repair", ['repairs' => $repairs]);
    }

    public function HalamanRepair() 
    {
        $repairs = DB::table('m_repair')->select('m_repair.*')->paginate(10);

        return view("Admin.repair", ['repairs' => $repairs]);
    }

    public function getRepair()
    {
        // Mengambil semua data dari tabel m_repair
        $repairs = MasterRepair::all();
        return response()->json($repairs); // Mengembalikan data dalam format JSON
    }

    public function AddDataRepair(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'repair_name' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterRepair
            $repair = new MasterRepair();
            $repair->repair_name = $request->input('repair_name');
            $repair->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan repair_id secara otomatis
            $maxRepairId = MasterRepair::max('repair_id'); // Ambil nilai repair_id maksimum
            $repair->repair_id = $maxRepairId ? $maxRepairId + 1 : 1; // Set repair_id, mulai dari 1 jika tidak ada
            
            $repair->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $repair->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'repair berhasil ditambahkan',
                'redirect_url' => route('Admin.repair')
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
            'data' => ['RepairId' => '12345']
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

    public function updateDataRepair(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'repair_name' => 'required|string|max:255',
        ]);

        // Cek apakah repair dengan id yang benar ada
        $repair = MasterRepair::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$repair) {
            return response()->json(['status' => 'error', 'message' => 'repair not found.'], 404);
        }

        // Update data repair
        $repair->repair_name = $request->repair_name;
        
        if ($repair->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'repair updated successfully.',
                'redirect_url' => route('Admin.repair'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update repair.'], 500);
        }
    }

    public function deleteDataRepair($id)
    {
        $repair = MasterRepair::find($id);

        if ($repair) {
            $repair->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'repair deleted successfully.',
                'redirect_url' => route('Admin.repair')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data repair Gagal Terhapus'], 404);
        }
    }


    public function details($RepairId)
    {
        $repair = MasterRepair::where('repair_id', $RepairId)->first();

        if (!$repair) {
            abort(404, 'repair not found');
        }

        return view('repair.details', ['asset' => $repair]);
    }
}