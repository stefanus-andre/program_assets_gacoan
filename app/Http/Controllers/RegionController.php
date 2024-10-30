<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterRegion;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class RegionController extends Controller
{
    public function Index()
    {
        $regions = DB::table('m_region')->select('m_region.*')->paginate(10);

        return view("Admin.region", ['regions' => $regions]);
    }

    public function HalamanRegion() 
    {
        $regions = DB::table('m_region')->select('m_region.*')->paginate(10);

        return view("Admin.region", ['regions' => $regions]);
    }

    public function getRegion()
    {
        // Mengambil semua data dari tabel m_region
        $regions = MasterRegion::all();
        return response()->json($regions); // Mengembalikan data dalam format JSON
    }

    public function AddDataRegion(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'region_code' => 'required|string|max:255',
            'region_name' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterRegion
            $region = new MasterRegion();
            $region->region_code = $request->input('region_code');
            $region->region_name = $request->input('region_name');
            $region->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan region_id secara otomatis
            $maxRegionId = MasterRegion::max('region_id'); // Ambil nilai region_id maksimum
            $region->region_id = $maxRegionId ? $maxRegionId + 1 : 1; // Set region_id, mulai dari 1 jika tidak ada
            
            $region->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $region->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'region berhasil ditambahkan',
                'redirect_url' => route('Admin.region')
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
            'data' => ['RegionId' => '12345']
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

    public function updateDataRegion(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'region_code' => 'required|string|max:255',
            'region_name' => 'required|string|max:255',
        ]);

        // Cek apakah region dengan id yang benar ada
        $region = MasterRegion::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$region) {
            return response()->json(['status' => 'error', 'message' => 'region not found.'], 404);
        }

        // Update data region
        $region->region_code = $request->region_code;
        $region->region_name = $request->region_name;
        
        if ($region->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'region updated successfully.',
                'redirect_url' => route('Admin.region'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update region.'], 500);
        }
    }

    public function deleteDataRegion($id)
    {
        $region = MasterRegion::find($id);

        if ($region) {
            $region->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'region deleted successfully.',
                'redirect_url' => route('Admin.region')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data region Gagal Terhapus'], 404);
        }
    }


    public function details($RegionId)
    {
        $region = MasterRegion::where('region_id', $RegionId)->first();

        if (!$region) {
            abort(404, 'region not found');
        }

        return view('region.details', ['asset' => $region]);
    }
}