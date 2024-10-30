<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterAsset;
use App\Models\Master\MasterAssetApproval;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AssetsController extends Controller
{
    public function Index()
    {
        $priorities = DB::table('m_priority')->select('priority_id', 'priority_name')->get();
        $categories = DB::table('m_category')->select('cat_id', 'cat_name')->get();
        $tipies = DB::table('m_type')->select('type_id', 'type_name')->get();
        $uomies = DB::table('m_uom')->select('uom_id', 'uom_name')->get();

        $assets = DB::table('m_assets')
        ->join('m_priority', 'm_assets.priority_id', '=', 'm_priority.priority_id') // Join with m_priority
        ->select('m_assets.*', 'm_priority.priority_name')
        ->where('m_assets.type_id', 1) // Filter for equipment
        ->paginate(10);

        return view("Admin.asset", [
            'priorities' => $priorities,
            'categories' => $categories,
            'tipies' => $tipies,
            'uomies' => $uomies,
            'assets' => $assets
        ]);
    }
    
    public function IndexEquipment()
    {
        $priorities = DB::table('m_priority')->select('priority_id', 'priority_name')->get();
        $categories = DB::table('m_category')->select('cat_id', 'cat_name')->get();
        $tipies = DB::table('m_type')->select('type_id', 'type_name')->get();
        $uomies = DB::table('m_uom')->select('uom_id', 'uom_name')->get();

        $assets_equipment = DB::table('m_assets')
        ->join('m_priority', 'm_assets.priority_id', '=', 'm_priority.priority_id') // Join with m_priority
        ->select('m_assets.*', 'm_priority.priority_name')
        ->where('m_assets.type_id', 2) // Filter for equipment
        ->paginate(10);

        return view("Admin.assetequipment", [
            'priorities' => $priorities,
            'categories' => $categories,
            'tipies' => $tipies,
            'uomies' => $uomies,
            'assets_equipment' => $assets_equipment
        ]);
    }

    public function HalamanAssets() 
    {
        $priorities = DB::table('m_priority')->select('priority_id', 'priority_name')->get();
        $categories = DB::table('m_category')->select('cat_id', 'cat_name')->get();
        $tipies = DB::table('m_type')->select('type_id', 'type_name')->get();
        $uomies = DB::table('m_uom')->select('uom_id', 'uom_name')->get();
        
        $assets = DB::table('m_assets')
        ->join('m_priority', 'm_assets.priority_id', '=', 'm_priority.priority_id') // Join with m_priority
        ->select('m_assets.*', 'm_priority.priority_name')
        ->where('m_assets.type_id', 1) // Filter for equipment
        ->paginate(10);

        return view("Admin.asset", [
            'priorities' => $priorities,
            'categories' => $categories,
            'tipies' => $tipies,
            'uomies' => $uomies,
            'assets' => $assets
        ]);
    }

    public function HalamanAssetsEquipment() 
    {
        $priorities = DB::table('m_priority')->select('priority_id', 'priority_name')->get();
        $categories = DB::table('m_category')->select('cat_id', 'cat_name')->get();
        $tipies = DB::table('m_type')->select('type_id', 'type_name')->get();
        $uomies = DB::table('m_uom')->select('uom_id', 'uom_name')->get();

        $assets_equipment = DB::table('m_assets')
        ->join('m_priority', 'm_assets.priority_id', '=', 'm_priority.priority_id') // Join with m_priority
        ->select('m_assets.*', 'm_priority.priority_name')
        ->where('m_assets.type_id', 2) // Filter for equipment
        ->paginate(10);

        return view("Admin.assetequipment", [
            'priorities' => $priorities,
            'categories' => $categories,
            'tipies' => $tipies,
            'uomies' => $uomies,
            'assets_equipment' => $assets_equipment
        ]);
    }

    public function getAssets()
    {
        try {
            // Fetch assets from the database
            $assets = MasterAsset::all();
    
            return response()->json([
                'status' => 'success',
                'data' => $assets
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve assets',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // public function AddDataAssets(Request $request)
    // {
    //     // Validasi data yang dikirimkan
    //     $request->validate([
    //         'asset_code' => 'required|string|max:255',
    //         'asset_model' => 'required|string|max:255',
    //         'asset_status' => 'required|string|max:100',
    //         'asset_quantity' => 'required|int|max:1000',
    //         'asset_image' => 'required|string|max:255',
    //         'priority_id' => 'required|exists:m_priority,priority_id',
    //         'cat_id' => 'required|exists:m_category,cat_id',
    //         'type_id' => 'required|exists:m_type,type_id',
    //         'uom_id' => 'required|exists:m_uom,uom_id',
    //     ]);

    //     try {
    //         // Buat instance dari model MasterAsset
    //         $asset = new MasterAsset();
    //         $asset->asset_code = $request->input('asset_code');
    //         $asset->asset_model = $request->input('asset_model');
    //         $asset->asset_status = $request->input('asset_status');
    //         $asset->asset_quantity = $request->input('asset_quantity');
    //         $asset->asset_image = $request->input('asset_image');
    //         $asset->priority_id = $request->input('priority_id');
    //         $asset->cat_id = $request->input('cat_id');
    //         $asset->type_id = $request->input('type_id');
    //         $asset->uom_id = $request->input('uom_id');
    //         $asset->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
    //         // Menghasilkan asset_id secara otomatis
    //         $maxAssetId = MasterAsset::max('asset_id'); // Ambil nilai asset_id maksimum
    //         $asset->asset_id = $maxAssetId ? $maxAssetId + 1 : 1; // Set asset_id, mulai dari 1 jika tidak ada
            
    //         $asset->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
    //         $asset->save(); // Simpan data

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'asset berhasil ditambahkan',
    //             'redirect_url' => route('Admin.asset')
    //         ]);
            
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Terjadi kesalahan: ' . $e->getMessage()
    //         ]);
    //     }
    // }

    public function AddDataAssets(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'asset_code' => 'required|string|max:255',
            'asset_model' => 'required|string|max:255',
            'asset_status' => 'required|string|max:100',
            'asset_quantity' => 'required|int|max:1000',
            'asset_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'priority_id' => 'required|exists:m_priority,priority_id',
            'cat_id' => 'required|exists:m_category,cat_id',
            'type_id' => 'required|exists:m_type,type_id',
            'uom_id' => 'required|exists:m_uom,uom_id',
        ]);

        try {
            // Create an instance of the MasterAsset model
            $asset = new MasterAsset();
            $asset->asset_code = $request->input('asset_code');
            $asset->asset_model = $request->input('asset_model');
            $asset->asset_status = $request->input('asset_status');
            $asset->asset_quantity = $request->input('asset_quantity');
            // Handle the image upload
            if ($request->hasFile('asset_image')) {
                $image = $request->file('asset_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/images'), $imageName); // Move the file to public/assets/images
                $asset->asset_image = 'assets/images/' . $imageName; // Store relative path
            }
            $asset->priority_id = $request->input('priority_id');
            $asset->cat_id = $request->input('cat_id');
            $asset->type_id = $request->input('type_id');
            $asset->uom_id = $request->input('uom_id');
            $asset->create_by = Auth::user()->username; // Get the logged-in user's username

            // Generate asset_id automatically
            $maxAssetId = MasterAsset::max('asset_id'); // Get the maximum asset_id
            $asset->asset_id = $maxAssetId ? $maxAssetId + 1 : 1; // Set asset_id, starting from 1 if none

            $asset->create_date = Carbon::now(); // Set the current date
            $asset->save(); // Save the asset data

            // Generate the QR code
            // $asset_code = $asset->asset_code;

            // // Define the folder path for the QR code
            // $folderPath = public_path('assets/qrcodes');

            // // Check if the folder exists; if not, create it
            // if (!file_exists($folderPath)) {
            //     mkdir($folderPath, 0755, true);
            // }

            // // Generate the QR code and save it as an image
            // $qrCodePath = $folderPath . '/' . $asset_code . '.png';

            // // Generate the QR code
            // QrCode::format('png')->size(300)->generate($asset_code, $qrCodePath);

            // // Save the QR code path to the asset record
            // $asset->qr_code_path = 'assets/qrcodes/' . $asset_code . '.png'; // Store relative path
            // $asset->save(); // Save the updated asset data

            return response()->json([
                'status' => 'success',
                'message' => 'Asset berhasil ditambahkan',
                'redirect_url' => route('Admin.asset')
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    
    public function showForm() {
        $priorities = DB::table('m_priority')->select('priority_id', 'priority_name')->get();
        $categories = DB::table('m_category')->select('cat_id', 'cat_name')->get();
        $tipies = DB::table('m_type')->select('type_id', 'type_name')->get();
        $uomies = DB::table('m_uom')->select('uom_id', 'uom_name')->get();
        
        return view("Admin.asset", [
            'priorities' => $priorities,
            'categories' => $categories,
            'tipies' => $tipies,
            'uomies' => $uomies,
        ]);
    }

    // public function AddDataAssets(Request $request)
    // {
    //     // Validasi data yang dikirimkan
    //     $request->validate([
    //         'asset_code' => 'required|string|max:255',
    //         'asset_model' => 'required|string|max:255',
    //         'asset_status' => 'required|string|max:100',
    //         'asset_quantity' => 'required|int|max:1000',
    //         'asset_image' => 'required|string|max:255',
    //         'priority_id' => 'required|exists:m_priority,priority_id',
    //         'cat_id' => 'required|exists:m_category,cat_id',
    //         'type_id' => 'required|exists:m_type,type_id',
    //         'uom_id' => 'required|exists:m_uom,uom_id',
    //     ]);

    //     try {
    //         // Buat instance dari model MasterAsset
    //         $asset = new MasterAsset();
    //         $asset->asset_code = $request->input('asset_code');
    //         $asset->asset_model = $request->input('asset_model');
    //         $asset->asset_status = $request->input('asset_status');
    //         $asset->asset_quantity = $request->input('asset_quantity');
    //         $asset->asset_image = $request->input('asset_image');
    //         $asset->priority_id = $request->input('priority_id');
    //         $asset->cat_id = $request->input('cat_id');
    //         $asset->type_id = $request->input('type_id');
    //         $asset->uom_id = $request->input('uom_id');
    //         $asset->create_by = Auth::user()->username; // Mengambil username yang sedang login
            
    //         // Menghasilkan asset_id secara otomatis
    //         $maxAssetId = MasterAsset::max('asset_id'); // Ambil nilai asset_id maksimum
    //         $asset->asset_id = $maxAssetId ? $maxAssetId + 1 : 1; // Set asset_id, mulai dari 1 jika tidak ada

    //         // Generate QR code
    //         $priorityFolder = public_path('assets/images/' . $request->input('type_id'));

    //         // Jika folder belum ada, buat foldernya
    //         if (!File::exists($priorityFolder)) {
    //             File::makeDirectory($priorityFolder, 0755, true);
    //         }

    //         // Tentukan nama file QR code dari asset_code
    //         $qrCodeFileName = $request->input('asset_code') . '.png';
    //         $qrCodeFilePath = $priorityFolder . '/' . $qrCodeFileName;

    //         // Generate dan simpan QR code dengan ukuran 1:1
    //         QrCode::format('png')
    //             ->size(300) // Ukuran QR code
    //             ->generate($request->input('asset_code'), $qrCodeFilePath);

    //         // Simpan path QR code ke dalam database
    //         $asset->qr_code_path = 'assets/images/' . $request->input('type_id') . '/' . $qrCodeFileName;

    //         $asset->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
    //         $asset->save(); // Simpan data

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Asset berhasil ditambahkan',
    //             'redirect_url' => route('Admin.asset')
    //         ]);
            
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Terjadi kesalahan: ' . $e->getMessage()
    //         ]);
    //     }
    // }

    // Example push notification function
    private function sendPushNotification($expoPushToken, $title, $body)
    {
        $url = 'https://exp.host/--/api/v2/push/send';
        $data = [
            'to' => $expoPushToken,
            'sound' => 'default',
            'title' => $title,
            'body' => $body,
            'data' => ['AssetId' => '12345']
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

    public function updateDataAssets(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'asset_code' => 'required|string|max:255',
            'asset_model' => 'required|string|max:255',
            'asset_status' => 'required|string|max:255',
            'asset_quantity' => 'required|string|max:255',
            'asset_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'priority_id' => 'required|string|max:255',
            'cat_id' => 'required|string|max:255',
            'type_id' => 'required|string|max:255',
            'uom_id' => 'required|string|max:255',
        ]);

        // Cek apakah asset dengan id yang benar ada
        $asset = MasterAsset::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$asset) {
            return response()->json(['status' => 'error', 'message' => 'asset not found.'], 404);
        }

        // Update data asset
        $asset->asset_code = $request->asset_code;
        $asset->asset_model = $request->asset_model;
        $asset->asset_status = $request->asset_status;
        $asset->asset_quantity = $request->asset_quantity;
        // Handle the image upload
        if ($request->hasFile('asset_image')) {
            $image = $request->file('asset_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images'), $imageName); // Move the file to public/assets/images
            $asset->asset_image = 'assets/images/' . $imageName; // Store relative path
        }
        $asset->priority_id = $request->priority_id;
        $asset->cat_id = $request->cat_id;
        $asset->type_id = $request->type_id;
        $asset->uom_id = $request->uom_id;
        
        if ($asset->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'asset updated successfully.',
                'redirect_url' => route('Admin.asset'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update asset.'], 500);
        }
    }

    public function deleteDataAssets($id)
    {
        $asset = MasterAsset::find($id);

        if ($asset) {
            $asset->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'asset deleted successfully.',
                'redirect_url' => route('Admin.asset')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data asset Gagal Terhapus'], 404);
        }
    }


    public function details($AssetId)
    {
        $asset = MasterAsset::where('asset_id', $AssetId)->first();

        if (!$asset) {
            abort(404, 'asset not found');
        }

        return view('asset.details', ['asset' => $asset]);
    }

    
    public function HalamanApproval() 
    {
        $priorities = DB::table('m_priority')->select('priority_id', 'priority_name')->get();
        $categories = DB::table('m_category')->select('cat_id', 'cat_name')->get();
        $tipies = DB::table('m_type')->select('type_id', 'type_name')->get();
        $uomies = DB::table('m_uom')->select('uom_id', 'uom_name')->get();
        
        return view("Admin.asset_approval", [
            'priorities' => $priorities,
            'categories' => $categories,
            'tipies' => $tipies,
            'uomies' => $uomies,
        ]);
    }

    public function getApproval()
    {
        // Mengambil semua data dari tabel m_asset
        $assets_approval = MasterAssetApproval::all();
        return response()->json($assets_approval); // Mengembalikan data dalam format JSON
    }
}
