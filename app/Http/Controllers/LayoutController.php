<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterLayout;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class LayoutController extends Controller
{
    public function Index()
    {
        $layouts = DB::table('m_layout')->select('m_layout.*')->paginate(10);

        return view("Admin.layout", ['layouts' => $layouts]);
    }

    public function HalamanLayout() 
    {
        $layouts = DB::table('m_layout')->select('m_layout.*')->paginate(10);

        return view("Admin.layout", ['layouts' => $layouts]);
    }

    public function getLayout()
    {
        // Mengambil semua data dari tabel m_layout
        $layouts = MasterLayout::all();
        return response()->json($layouts); // Mengembalikan data dalam format JSON
    }

    public function AddDataLayout(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'layout_code' => 'required|string|max:255',
            'layout_name' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterLayout
            $layout = new MasterLayout();
            $layout->layout_code = $request->input('layout_code');
            $layout->layout_name = $request->input('layout_name');
            $layout->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan layout_id secara otomatis
            $maxLayoutId = MasterLayout::max('layout_id'); // Ambil nilai layout_id maksimum
            $layout->layout_id = $maxLayoutId ? $maxLayoutId + 1 : 1; // Set layout_id, mulai dari 1 jika tidak ada
            
            $layout->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $layout->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'layout berhasil ditambahkan',
                'redirect_url' => route('Admin.layout')
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
            'data' => ['LayoutId' => '12345']
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

    public function updateDataLayout(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'layout_name' => 'required|string|max:255',
        ]);

        // Cek apakah layout dengan id yang benar ada
        $layout = MasterLayout::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$layout) {
            return response()->json(['status' => 'error', 'message' => 'layout not found.'], 404);
        }

        // Update data layout
        $layout->layout_name = $request->layout_name;
        
        if ($layout->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'layout updated successfully.',
                'redirect_url' => route('Admin.layout'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update layout.'], 500);
        }
    }

    public function deleteDataLayout($id)
    {
        $layout = MasterLayout::find($id);

        if ($layout) {
            $layout->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'layout deleted successfully.',
                'redirect_url' => route('Admin.layout')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data layout Gagal Terhapus'], 404);
        }
    }


    public function details($LayoutId)
    {
        $layout = MasterLayout::where('layout_id', $LayoutId)->first();

        if (!$layout) {
            abort(404, 'layout not found');
        }

        return view('layout.details', ['asset' => $layout]);
    }
}