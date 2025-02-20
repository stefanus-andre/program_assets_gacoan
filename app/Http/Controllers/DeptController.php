<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterDept;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class DeptController extends Controller
{
    public function Index()
    {
        $depts = DB::table('m_dept')->select('m_dept.*')->paginate(10);

        return view("Admin.dept", ['depts' => $depts]);
    }

    public function HalamanDept() 
    {
        $depts = DB::table('m_dept')->select('m_dept.*')->paginate(10);

        return view("Admin.dept", ['depts' => $depts]);
    }

    public function getDept()
    {
        // Mengambil semua data dari tabel m_dept
        $depts = MasterDept::all();
        return response()->json($depts); // Mengembalikan data dalam format JSON
    }

    public function AddDataDept(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'dept_name' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterDept
            $dept = new MasterDept();
            $dept->dept_name = $request->input('dept_name');
            $dept->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan dept_id secara otomatis
            $maxDeptId = MasterDept::max('dept_id'); // Ambil nilai dept_id maksimum
            $dept->dept_id = $maxDeptId ? $maxDeptId + 1 : 1; // Set dept_id, mulai dari 1 jika tidak ada
            
            $dept->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $dept->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'dept berhasil ditambahkan',
                'redirect_url' => route('Admin.dept')
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
            'data' => ['DeptId' => '12345']
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

    public function updateDataDept(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'dept_name' => 'required|string|max:255',
        ]);

        // Cek apakah dept dengan id yang benar ada
        $dept = MasterDept::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$dept) {
            return response()->json(['status' => 'error', 'message' => 'dept not found.'], 404);
        }

        // Update data dept
        $dept->dept_name = $request->dept_name;
        
        if ($dept->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'dept updated successfully.',
                'redirect_url' => route('Admin.dept'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update dept.'], 500);
        }
    }

    public function deleteDataDept($id)
    {
        $dept = MasterDept::find($id);

        if ($dept) {
            $dept->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'dept deleted successfully.',
                'redirect_url' => route('Admin.dept')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data dept Gagal Terhapus'], 404);
        }
    }


    public function details($DeptId)
    {
        $dept = MasterDept::where('dept_id', $DeptId)->first();

        if (!$dept) {
            abort(404, 'dept not found');
        }

        return view('dept.details', ['asset' => $dept]);
    }
}