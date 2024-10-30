<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterChecklist;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class ChecklistController extends Controller
{
    public function Index()
    {
        $checklists = DB::table('m_checklist')->select('m_checklist.*')->paginate(10);

        return view("Admin.checklist", ['checklists' => $checklists]);
    }

    public function HalamanChecklist() 
    {
        $checklists = DB::table('m_checklist')->select('m_checklist.*')->paginate(10);

        return view("Admin.checklist", ['checklists' => $checklists]);
    }

    public function getChecklist()
    {
        // Mengambil semua data dari tabel m_checklist
        $checklists = MasterChecklist::all();
        return response()->json($checklists); // Mengembalikan data dalam format JSON
    }

    public function AddDataChecklist(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'checklist_name' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterChecklist
            $checklist = new MasterChecklist();
            $checklist->checklist_name = $request->input('checklist_name');
            $checklist->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan checklist_id secara otomatis
            $maxChecklistId = MasterChecklist::max('checklist_id'); // Ambil nilai checklist_id maksimum
            $checklist->checklist_id = $maxChecklistId ? $maxChecklistId + 1 : 1; // Set checklist_id, mulai dari 1 jika tidak ada
            
            $checklist->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $checklist->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'checklist berhasil ditambahkan',
                'redirect_url' => route('Admin.checklist')
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
            'data' => ['ChecklistId' => '12345']
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

    public function updateDataChecklist(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'checklist_name' => 'required|string|max:255',
        ]);

        // Cek apakah checklist dengan id yang benar ada
        $checklist = MasterChecklist::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$checklist) {
            return response()->json(['status' => 'error', 'message' => 'checklist not found.'], 404);
        }

        // Update data checklist
        $checklist->checklist_name = $request->checklist_name;
        
        if ($checklist->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'checklist updated successfully.',
                'redirect_url' => route('Admin.checklist'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update checklist.'], 500);
        }
    }

    public function deleteDataChecklist($id)
    {
        $checklist = MasterChecklist::find($id);

        if ($checklist) {
            $checklist->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'checklist deleted successfully.',
                'redirect_url' => route('Admin.checklist')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data checklist Gagal Terhapus'], 404);
        }
    }


    public function details($ChecklistId)
    {
        $checklist = MasterChecklist::where('checklist_id', $ChecklistId)->first();

        if (!$checklist) {
            abort(404, 'checklist not found');
        }

        return view('checklist.details', ['asset' => $checklist]);
    }
}
