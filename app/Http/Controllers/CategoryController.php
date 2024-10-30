<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterCategory;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function Index()
    {
        $categorys = DB::table('m_category')->select('m_category.*')->paginate(10);

        return view("Admin.category", ['categorys' => $categorys]);
    }

    public function HalamanCategory() 
    {
        $categorys = DB::table('m_category')->select('m_category.*')->paginate(10);

        return view("Admin.category", ['categorys' => $categorys]);
    }

    public function getCategory()
    {
        // Mengambil semua data dari tabel m_category
        $categorys = MasterCategory::all();
        return response()->json($categorys); // Mengembalikan data dalam format JSON
    }

    public function AddDataCategory(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'cat_name' => 'required|string|max:255',
            'cat_code' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterCategory
            $category = new MasterCategory();
            $category->cat_name = $request->input('cat_name');
            $category->cat_code = $request->input('cat_code');
            $category->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan cat_id secara otomatis
            $maxCategoryId = MasterCategory::max('cat_id'); // Ambil nilai cat_id maksimum
            $category->cat_id = $maxCategoryId ? $maxCategoryId + 1 : 1; // Set cat_id, mulai dari 1 jika tidak ada
            
            $category->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $category->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'category berhasil ditambahkan',
                'redirect_url' => route('Admin.category')
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
            'data' => ['CategoryId' => '12345']
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

    public function updateDataCategory(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'cat_name' => 'required|string|max:255',
            'cat_code' => 'required|string|max:255',
        ]);

        // Cek apakah category dengan id yang benar ada
        $category = MasterCategory::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$category) {
            return response()->json(['status' => 'error', 'message' => 'category not found.'], 404);
        }

        // Update data category
        $category->cat_name = $request->cat_name;
        $category->cat_code = $request->cat_code;
        
        if ($category->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'category updated successfully.',
                'redirect_url' => route('Admin.category'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update category.'], 500);
        }
    }

    public function deleteDataCategory($id)
    {
        $category = MasterCategory::find($id);

        if ($category) {
            $category->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'category deleted successfully.',
                'redirect_url' => route('Admin.category')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data category Gagal Terhapus'], 404);
        }
    }


    public function details($CategoryId)
    {
        $category = MasterCategory::where('cat_id', $CategoryId)->first();

        if (!$category) {
            abort(404, 'category not found');
        }

        return view('category.details', ['asset' => $category]);
    }
}
