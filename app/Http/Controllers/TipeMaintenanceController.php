<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Master\MasterTipeMaintenance;

use Carbon\Carbon;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Support\Facades\File;


class TipeMaintenanceController extends Controller
{
    public function Index()
    {
        $typesMaintenance = DB::table('m_mtc_type')->select('m_mtc_type.*')->paginate(10);

        return view("Admin.tipe_maintenance", ['typesMaintenance' => $typesMaintenance]);
    }

    public function HalamanTipeMaintenance() 
    {
        $typesMaintenance = DB::table('m_mtc_type')->select('m_mtc_type.*')->paginate(10);

        return view("Admin.tipe_maintenance", ['typesMaintenance' => $typesMaintenance]);
    }

    public function GetTipeMaintenance()
    {
        // Mengambil semua data dari tabel m_type
        $typesMaintenance = MasterTipeMaintenance::all();
        return response()->json($typesMaintenance); // Mengembalikan data dalam format JSON
    }

    public function AddDataTipeMaintenance(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'mtc_type_name' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterType
            $type = new MasterTipeMaintenance();
            $type->mtc_type_name = $request->input('mtc_type_name');
            $type->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan type_id secara otomatis
            $maxMtcTypeId = MasterTipeMaintenance::max('mtc_type_id'); // Ambil nilai type_id maksimum
            $type->mtc_type_id = $maxMtcTypeId ? $maxMtcTypeId + 1 : 1; // Set type_id, mulai dari 1 jika tidak ada
            
            $type->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $type->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'Data Type Maintenance berhasil ditambahkan',
                'redirect_url' => route('Admin.tipe_maintenance')
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
            'data' => ['TypeId' => '12345']
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

    public function updateDataTipeMaintenance(Request $request, $mtc_type_id)
    {
        // Validasi input
        $request->validate([
            'mtc_type_name' => 'required|string|max:255',
        ]);

        // Cek apakah type dengan id yang benar ada
        $type = MasterTipeMaintenance::find($mtc_type_id); // Langsung gunakan find jika ID adalah primary key

        if (!$type) {
            return response()->json(['status' => 'error', 'message' => 'type not found.'], 404);
        }

        // Update data type
        $type->mtc_type_name = $request->mtc_type_name;
        
        if ($type->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'Data Tipe Maintenance updated successfully.',
                'redirect_url' => route('Admin.tipe_maintenance'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update type.'], 500);
        }
    }

    public function deleteDataTipeMaintenance($id)
    {
        $type = MasterTipeMaintenance::find($id);

        if ($type) {
            $type->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'Data Tipe Maintenance Delete successfully.',
                'redirect_url' => route('Admin.tipe_maintenance')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data type Gagal Terhapus'], 404);
        }
    }


    // public function details($TypeId)
    // {
    //     $type = MasterType::where('mtc_type_id', $TypeId)->first();

    //     if (!$type) {
    //         abort(404, 'type not found');
    //     }

    //     return view('type.details', ['asset' => $type]);
    // }
}
