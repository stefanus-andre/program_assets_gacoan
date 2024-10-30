<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Master\MasterBrand;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function Index()
    {
        $brands = DB::table('m_brand')->select('m_brand.*')->paginate(10);

        return view("Admin.brand", [
            'brands' => $brands
        ]);
    }

    public function HalamanBrand() 
    {
        $brands = DB::table('m_brand')->select('m_brand.*')->paginate(10);

        return view("Admin.brand", ['brands' => $brands]);
    }

    public function getBrand()
    {
        // Mengambil semua data dari tabel m_brand
        $brands = MasterBrand::all();
        return response()->json($brands); // Mengembalikan data dalam format JSON
    }

    public function AddDataBrand(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterBrand
            $brand = new MasterBrand();
            $brand->brand_name = $request->input('brand_name');
            $brand->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
            // Menghasilkan brand_id secara otomatis
            $maxBrandId = MasterBrand::max('brand_id'); // Ambil nilai brand_id maksimum
            $brand->brand_id = $maxBrandId ? $maxBrandId + 1 : 1; // Set brand_id, mulai dari 1 jika tidak ada
            
            $brand->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $brand->save(); // Simpan data

            return response()->json([
                'status' => 'success',
                'message' => 'Brand berhasil ditambahkan',
                'redirect_url' => route('Admin.brand')
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
            'data' => ['BrandId' => '12345']
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

    public function updateDataBrand(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);

        // Cek apakah brand dengan id yang benar ada
        $brand = MasterBrand::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$brand) {
            return response()->json(['status' => 'error', 'message' => 'Brand not found.'], 404);
        }

        // Update data brand
        $brand->brand_name = $request->brand_name;
        
        if ($brand->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'Brand updated successfully.',
                'redirect_url' => route('Admin.brand'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update Brand.'], 500);
        }
    }

    public function deleteDataBrand($id)
    {
        $brand = MasterBrand::find($id);

        if ($brand) {
            $brand->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'Brand deleted successfully.',
                'redirect_url' => route('Admin.brand')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data Brand Gagal Terhapus'], 404);
        }
    }


    public function details($BrandId)
    {
        $brand = MasterBrand::where('brand_id', $BrandId)->first();

        if (!$brand) {
            abort(404, 'Brand not found');
        }

        return view('brand.details', ['asset' => $brand]);
    }
}
