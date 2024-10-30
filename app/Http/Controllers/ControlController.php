<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterControl;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class ControlController extends Controller
{
    public function Index()
    {
        $controls = DB::table('m_control')->select('m_control.*')->paginate(10);

        return view("Admin.control", ['controls' => $controls]);
    }

    public function HalamanControl() 
    {
        $controls = DB::table('m_control')->select('m_control.*')->paginate(10);

        return view("Admin.control", ['controls' => $controls]);
    }

    public function getControl()
    {
        // Mengambil semua data dari tabel m_control
        $controls = MasterControl::all();
        return response()->json($controls); // Mengembalikan data dalam format JSON
    }

    public function AddDataControl(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'control_name' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterControl
            $control = new MasterControl();
            $control->control_name = $request->input('control_name');
            $control->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan control_id secara otomatis
            $maxControlId = MasterControl::max('control_id'); // Ambil nilai control_id maksimum
            $control->control_id = $maxControlId ? $maxControlId + 1 : 1; // Set control_id, mulai dari 1 jika tidak ada
            
            $control->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $control->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'control berhasil ditambahkan',
                'redirect_url' => route('Admin.control')
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
            'data' => ['ControlId' => '12345']
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

    public function updateDataControl(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'control_name' => 'required|string|max:255',
        ]);

        // Cek apakah control dengan id yang benar ada
        $control = MasterControl::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$control) {
            return response()->json(['status' => 'error', 'message' => 'control not found.'], 404);
        }

        // Update data control
        $control->control_name = $request->control_name;
        
        if ($control->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'control updated successfully.',
                'redirect_url' => route('Admin.control'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update control.'], 500);
        }
    }

    public function deleteDataControl($id)
    {
        $control = MasterControl::find($id);

        if ($control) {
            $control->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'control deleted successfully.',
                'redirect_url' => route('Admin.control')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data control Gagal Terhapus'], 404);
        }
    }


    public function details($ControlId)
    {
        $control = MasterControl::where('control_id', $ControlId)->first();

        if (!$control) {
            abort(404, 'control not found');
        }

        return view('control.details', ['asset' => $control]);
    }
}
