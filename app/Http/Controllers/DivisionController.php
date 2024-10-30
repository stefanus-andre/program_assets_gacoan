<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterDivision;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class DivisionController extends Controller
{
    public function Index()
    {
        $divisions = DB::table('m_division')->select('m_division.*')->paginate(10);

        return view("Admin.division", ['divisions' => $divisions]);
    }

    public function HalamanDivision() 
    {
        $divisions = DB::table('m_division')->select('m_division.*')->paginate(10);

        return view("Admin.division", ['divisions' => $divisions]);
    }

    public function getDivision()
    {
        // Mengambil semua data dari tabel m_division
        $divisions = MasterDivision::all();
        return response()->json($divisions); // Mengembalikan data dalam format JSON
    }

    public function AddDataDivision(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'division_name' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterDivision
            $division = new MasterDivision();
            $division->division_name = $request->input('division_name');
            $division->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan division_id secara otomatis
            $maxDivisionId = MasterDivision::max('division_id'); // Ambil nilai division_id maksimum
            $division->division_id = $maxDivisionId ? $maxDivisionId + 1 : 1; // Set division_id, mulai dari 1 jika tidak ada
            
            $division->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $division->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'division berhasil ditambahkan',
                'redirect_url' => route('Admin.division')
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
            'data' => ['DivisionId' => '12345']
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

    public function updateDataDivision(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'division_name' => 'required|string|max:255',
        ]);

        // Cek apakah division dengan id yang benar ada
        $division = MasterDivision::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$division) {
            return response()->json(['status' => 'error', 'message' => 'division not found.'], 404);
        }

        // Update data division
        $division->division_name = $request->division_name;
        
        if ($division->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'division updated successfully.',
                'redirect_url' => route('Admin.division'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update division.'], 500);
        }
    }

    public function deleteDataDivision($id)
    {
        $division = MasterDivision::find($id);

        if ($division) {
            $division->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'division deleted successfully.',
                'redirect_url' => route('Admin.division')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data division Gagal Terhapus'], 404);
        }
    }


    public function details($DivisionId)
    {
        $division = MasterDivision::where('division_id', $DivisionId)->first();

        if (!$division) {
            abort(404, 'division not found');
        }

        return view('division.details', ['asset' => $division]);
    }
}