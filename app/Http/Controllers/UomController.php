<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterUom;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class UomController extends Controller
{
    public function Index()
    {
        $uoms = DB::table('m_uom')->select('m_uom.*')->paginate(10);

        return view("Admin.uom", ['uoms' => $uoms]);
    }

    public function HalamanUom() 
    {
        $uoms = DB::table('m_uom')->select('m_uom.*')->paginate(10);

        return view("Admin.uom", ['uoms' => $uoms]);
    }

    public function getUom()
    {
        // Mengambil semua data dari tabel m_uom
        $uoms = MasterUom::all();
        return response()->json($uoms); // Mengembalikan data dalam format JSON
    }

    public function AddDataUom(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'uom_name' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterUom
            $uom = new MasterUom();
            $uom->uom_name = $request->input('uom_name');
            $uom->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan uom_id secara otomatis
            $maxUomId = MasterUom::max('uom_id'); // Ambil nilai uom_id maksimum
            $uom->uom_id = $maxUomId ? $maxUomId + 1 : 1; // Set uom_id, mulai dari 1 jika tidak ada
            
            $uom->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $uom->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'uom berhasil ditambahkan',
                'redirect_url' => route('Admin.uom')
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
            'data' => ['UomId' => '12345']
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

    public function updateDataUom(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'uom_name' => 'required|string|max:255',
        ]);

        // Cek apakah uom dengan id yang benar ada
        $uom = MasterUom::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$uom) {
            return response()->json(['status' => 'error', 'message' => 'uom not found.'], 404);
        }

        // Update data uom
        $uom->uom_name = $request->uom_name;
        
        if ($uom->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'uom updated successfully.',
                'redirect_url' => route('Admin.uom'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update uom.'], 500);
        }
    }

    public function deleteDataUom($id)
    {
        $uom = MasterUom::find($id);

        if ($uom) {
            $uom->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'uom deleted successfully.',
                'redirect_url' => route('Admin.uom')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data uom Gagal Terhapus'], 404);
        }
    }


    public function details($UomId)
    {
        $uom = MasterUom::where('uom_id', $UomId)->first();

        if (!$uom) {
            abort(404, 'uom not found');
        }

        return view('uom.details', ['asset' => $uom]);
    }
}