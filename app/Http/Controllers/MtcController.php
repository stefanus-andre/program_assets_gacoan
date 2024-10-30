<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterMtc;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class MtcController extends Controller
{
    public function Index()
    {
        $mtcs = DB::table('m_mtc')->select('m_mtc.*')->paginate(10);

        return view("Admin.mtc", ['mtcs' => $mtcs]);
    }

    public function HalamanMtc() 
    {
        $mtcs = DB::table('m_mtc')->select('m_mtc.*')->paginate(10);

        return view("Admin.mtc", ['mtcs' => $mtcs]);
    }

    public function getMtc()
    {
        // Mengambil semua data dari tabel m_mtc
        $mtcs = MasterMtc::all();
        return response()->json($mtcs); // Mengembalikan data dalam format JSON
    }

    public function AddDataMtc(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'mtc_name' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterMtc
            $mtc = new MasterMtc();
            $mtc->mtc_name = $request->input('mtc_name');
            $mtc->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan mtc_id secara otomatis
            $maxMtcId = MasterMtc::max('mtc_id'); // Ambil nilai mtc_id maksimum
            $mtc->mtc_id = $maxMtcId ? $maxMtcId + 1 : 1; // Set mtc_id, mulai dari 1 jika tidak ada
            
            $mtc->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $mtc->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'mtc berhasil ditambahkan',
                'redirect_url' => route('Admin.mtc')
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
            'data' => ['MtcId' => '12345']
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

    public function updateDataMtc(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'mtc_name' => 'required|string|max:255',
        ]);

        // Cek apakah mtc dengan id yang benar ada
        $mtc = MasterMtc::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$mtc) {
            return response()->json(['status' => 'error', 'message' => 'mtc not found.'], 404);
        }

        // Update data mtc
        $mtc->mtc_name = $request->mtc_name;
        
        if ($mtc->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'mtc updated successfully.',
                'redirect_url' => route('Admin.mtc'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update mtc.'], 500);
        }
    }

    public function deleteDataMtc($id)
    {
        $mtc = MasterMtc::find($id);

        if ($mtc) {
            $mtc->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'mtc deleted successfully.',
                'redirect_url' => route('Admin.mtc')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data mtc Gagal Terhapus'], 404);
        }
    }


    public function details($MtcId)
    {
        $mtc = MasterMtc::where('mtc_id', $MtcId)->first();

        if (!$mtc) {
            abort(404, 'mtc not found');
        }

        return view('mtc.details', ['asset' => $mtc]);
    }
}