<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterGroupUser;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class GroupUserController extends Controller
{
    public function Index()
    {
        $groupusers = DB::table('m_groupuser')->select('m_groupuser.*')->paginate(10);

        return view("Admin.groupuser", ['groupusers' => $groupusers]);
    }

    public function HalamanGroupUser() 
    {
        $groupusers = DB::table('m_groupuser')->select('m_groupuser.*')->paginate(10);

        return view("Admin.groupuser", ['groupusers' => $groupusers]);
    }

    public function getGroupUser()
    {
        // Mengambil semua data dari tabel m_group
        $groups = MasterGroupUser::all();
        return response()->json($groups); // Mengembalikan data dalam format JSON
    }

    public function AddDataGroupUser(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'group_name' => 'required|string|max:255',
            'group_roles' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterGroupUser
            $group = new MasterGroupUser();
            $group->group_name = $request->input('group_name');
            $group->group_roles = $request->input('group_roles');
            $group->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan group_id secara otomatis
            $maxGroupUserId = MasterGroupUser::max('group_id'); // Ambil nilai group_id maksimum
            $group->group_id = $maxGroupUserId ? $maxGroupUserId + 1 : 1; // Set group_id, mulai dari 1 jika tidak ada
            
            $group->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $group->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'group berhasil ditambahkan',
                'redirect_url' => route('Admin.groupuser')
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
            'data' => ['GroupUserId' => '12345']
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

    public function updateDataGroupUser(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'group_name' => 'required|string|max:255',
            'group_roles' => 'required|string|max:255',
        ]);

        // Cek apakah group dengan id yang benar ada
        $group = MasterGroupUser::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$group) {
            return response()->json(['status' => 'error', 'message' => 'group not found.'], 404);
        }

        // Update data group
        $group->group_name = $request->group_name;
        $group->group_roles = $request->group_roles;
        
        if ($group->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'group updated successfully.',
                'redirect_url' => route('Admin.groupuser'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update group.'], 500);
        }
    }

    public function deleteDataGroupUser($id)
    {
        $group = MasterGroupUser::find($id);

        if ($group) {
            $group->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'group deleted successfully.',
                'redirect_url' => route('Admin.groupuser')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data group Gagal Terhapus'], 404);
        }
    }


    public function details($GroupUserId)
    {
        $group = MasterGroupUser::where('group_id', $GroupUserId)->first();

        if (!$group) {
            abort(404, 'group not found');
        }

        return view('group.details', ['asset' => $group]);
    }
}