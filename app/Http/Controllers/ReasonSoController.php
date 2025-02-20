<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterReasonSo;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class ReasonSoController extends Controller
{
    public function IndexSo()
    {
        $reasonso = DB::table('m_reason_so')->select('m_reason_so.*')->paginate(10);

        return view("Admin.reasonso", ['reasonso' => $reasonso]);
    }

    public function HalamanReasonSo() 
    {
        $reasonso = DB::table('m_reason_so')->select('m_reason_so.*')->paginate(10);

        return view("Admin.reasonso", ['reasonso' => $reasonso]);
    }

    public function index()
    {
        $reasonso = DB::table('m_reason_so')->paginate(10); // Fetch paginated results
        return view("Admin.reasonso", compact('reasonso'));
    }

    // Ensure only necessary methods are retained
    public function getReasonSo()
    {
        $reasonso = MasterReasonSo::all();
        return response()->json($reasonso);
    }

    public function AddDataReasonSo(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'reason_so_name' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterReasonSo
            $reasonso = new MasterReasonSo();
            $reasonso->reason_so_name = $request->input('reason_so_name');
            $reasonso->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan reason_so_id secara otomatis
            $maxReasonSoId = MasterReasonSo::max('reason_so_id'); // Ambil nilai reason_so_id maksimum
            $reasonso->reason_so_id = $maxReasonSoId ? $maxReasonSoId + 1 : 1; // Set reason_so_id, mulai dari 1 jika tidak ada
            
            $reasonso->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $reasonso->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'reasonso berhasil ditambahkan',
                'redirect_url' => route('Admin.reasonso')
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
            'data' => ['ReasonSoId' => '12345']
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

    public function updateDataReasonSo(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'reason_so_name' => 'required|string|max:255',
        ]);

        // Cek apakah reasonso dengan id yang benar ada
        $reasonso = MasterReasonSo::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$reasonso) {
            return response()->json(['status' => 'error', 'message' => 'reasonso not found.'], 404);
        }

        // Update data reasonso
        $reasonso->reason_so_name = $request->reason_so_name;
        
        if ($reasonso->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'reasonso updated successfully.',
                'redirect_url' => route('Admin.reasonso'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update reasonso.'], 500);
        }
    }

    public function deleteDataReasonSo($id)
    {
        $reasonso = MasterReasonSo::find($id);

        if ($reasonso) {
            $reasonso->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'reasonso deleted successfully.',
                'redirect_url' => route('Admin.reasonso')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data reasonso Gagal Terhapus'], 404);
        }
    }


    public function details($ReasonSoId)
    {
        $reasonso = MasterReasonSo::where('reason_so_id', $ReasonSoId)->first();

        if (!$reasonso) {
            abort(404, 'reasonso not found');
        }

        return view('reason.details', ['asset' => $reasonso]);
    }
}