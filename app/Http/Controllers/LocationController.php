<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterLocation;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class LocationController extends Controller
{
    // public function Index()
    // {
    //     $location = DB::table('m_location')->select('m_location.*')->paginate(10);

    //     return view("Admin.location", ['location' => $location]);
    // }

    public function HalamanLocation() 
    {
        $locations = DB::table('m_location')->select('m_location.*')->paginate(10);

        return view("Admin.location", ['locations' => $locations]);
    }

    public function getLocation()
    {
        // Mengambil semua data dari tabel m_location
        $locations = MasterLocation::all();
        return response()->json($locations); // Mengembalikan data dalam format JSON
    }

    public function AddDataLocation(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'loc_code' => 'required|string|max:255',
            'loc_name' => 'required|string|max:255',
            'loc_city' => 'required|string|max:255',
            'loc_address' => 'required|string|max:255',
            'loc_distric' => 'required|string|max:255',
            'loc_vilage' => 'required|string|max:255',
            'region_id' => 'required|string|max:255',
            'loc_latitude' => 'required|string|max:255',
            'loc_longitude' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterLocation
            $location = new MasterLocation();
            $location->loc_code = $request->input('loc_code');
            $location->loc_name = $request->input('loc_name');
            $location->loc_city = $request->input('loc_city');
            $location->loc_address = $request->input('loc_address');
            $location->loc_distric = $request->input('loc_distric');
            $location->loc_vilage = $request->input('loc_vilage');
            $location->region_id = $request->input('region_id');
            $location->loc_latitude = $request->input('loc_latitude');
            $location->loc_longitude = $request->input('loc_longitude');
            $location->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan loc_id secara otomatis
            $maxLocationId = MasterLocation::max('loc_id'); // Ambil nilai loc_id maksimum
            $location->loc_id = $maxLocationId ? $maxLocationId + 1 : 1; // Set loc_id, mulai dari 1 jika tidak ada
            
            $location->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $location->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'location berhasil ditambahkan',
                'redirect_url' => route('Admin.location')
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
            'data' => ['LocationId' => '12345']
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

    public function updateDataLocation(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'loc_code' => 'required|string|max:255',
            'loc_name' => 'required|string|max:255',
            'loc_city' => 'required|string|max:255',
            'loc_address' => 'required|string|max:255',
            'loc_distric' => 'required|string|max:255',
            'loc_vilage' => 'required|string|max:255',
            'region_id' => 'required|string|max:255',
            'loc_latitude' => 'required|string|max:255',
            'loc_longitude' => 'required|string|max:255',
        ]);

        // Cek apakah location dengan id yang benar ada
        $location = MasterLocation::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$location) {
            return response()->json(['status' => 'error', 'message' => 'location not found.'], 404);
        }

        // Update data location
        $location->loc_code = $request->loc_code;
        $location->loc_name = $request->loc_name;
        $location->loc_city = $request->loc_city;
        $location->loc_address = $request->loc_address;
        $location->loc_distric = $request->loc_distric;
        $location->loc_vilage = $request->loc_vilage;
        $location->region_id = $request->region_id;
        $location->loc_latitude = $request->loc_latitude;
        $location->loc_longitude = $request->loc_longitude;
        
        if ($location->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'location updated successfully.',
                'redirect_url' => route('Admin.location'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update location.'], 500);
        }
    }

    public function deleteDataLocation($id)
    {
        $location = MasterLocation::find($id);

        if ($location) {
            $location->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'location deleted successfully.',
                'redirect_url' => route('Admin.location')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data location Gagal Terhapus'], 404);
        }
    }


    public function details($LocationId)
    {
        $location = MasterLocation::where('loc_id', $LocationId)->first();

        if (!$location) {
            abort(404, 'location not found');
        }

        return view('location.details', ['asset' => $location]);
    }
}