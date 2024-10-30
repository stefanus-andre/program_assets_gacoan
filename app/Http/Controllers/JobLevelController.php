<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterJobLevel;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class JobLevelController extends Controller
{
    public function Index()
    {
        $joblevels = DB::table('m_joblevel')->select('m_joblevel.*')->paginate(10);

        return view("Admin.joblevel", ['joblevels' => $joblevels]);
    }

    public function HalamanJobLevel() 
    {
        $joblevels = DB::table('m_joblevel')->select('m_joblevel.*')->paginate(10);

        return view("Admin.joblevel", ['joblevels' => $joblevels]);
    }

    public function getJobLevel()
    {
        // Mengambil semua data dari tabel m_joblevel
        $joblevels = MasterJobLevel::all();
        return response()->json($joblevels); // Mengembalikan data dalam format JSON
    }

    public function AddDataJobLevel(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'joblevel_name' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterJobLevel
            $joblevel = new MasterJobLevel();
            $joblevel->joblevel_name = $request->input('joblevel_name');
            $joblevel->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan joblevel_id secara otomatis
            $maxJobLevelId = MasterJobLevel::max('joblevel_id'); // Ambil nilai joblevel_id maksimum
            $joblevel->joblevel_id = $maxJobLevelId ? $maxJobLevelId + 1 : 1; // Set joblevel_id, mulai dari 1 jika tidak ada
            
            $joblevel->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $joblevel->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'joblevel berhasil ditambahkan',
                'redirect_url' => route('Admin.joblevel')
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
            'data' => ['JobLevelId' => '12345']
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

    public function updateDataJobLevel(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'joblevel_name' => 'required|string|max:255',
        ]);

        // Cek apakah joblevel dengan id yang benar ada
        $joblevel = MasterJobLevel::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$joblevel) {
            return response()->json(['status' => 'error', 'message' => 'joblevel not found.'], 404);
        }

        // Update data joblevel
        $joblevel->joblevel_name = $request->joblevel_name;
        
        if ($joblevel->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'joblevel updated successfully.',
                'redirect_url' => route('Admin.joblevel'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update joblevel.'], 500);
        }
    }

    public function deleteDataJobLevel($id)
    {
        $joblevel = MasterJobLevel::find($id);

        if ($joblevel) {
            $joblevel->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'joblevel deleted successfully.',
                'redirect_url' => route('Admin.joblevel')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data joblevel Gagal Terhapus'], 404);
        }
    }


    public function details($JobLevelId)
    {
        $joblevel = MasterJobLevel::where('joblevel_id', $JobLevelId)->first();

        if (!$joblevel) {
            abort(404, 'joblevel not found');
        }

        return view('joblevel.details', ['asset' => $joblevel]);
    }
}