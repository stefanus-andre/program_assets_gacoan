<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssetModel;
use App\Models\Master\MasterAsset;
use App\Models\Master\MasterRegion;
use App\Models\Master\MasterRegistrasiModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;





class AdminController extends Controller
{
    public function Index()
    {

        $total_asset = DB::table('t_transaction_qty')
        ->sum('qty');

        $bad_asset = DB::table('t_transaction_qty')
        ->whereIn('condition', [2, 4])
        ->sum('qty');


        $good_asset = DB::table('t_transaction_qty')
        ->whereIn('condition', [1, 3])
        ->sum('qty');


        $total_resto = DB::table('master_resto_v2')
        ->count();

        return view("Admin.dashboard_admin", [
            'totalAsset' => $total_asset,
            'badAsset' => $bad_asset,
            'goodAsset' => $good_asset,
            'totalResto' => $total_resto
        ]);
    }

    public function getDataResto(Request $request)
    {
        $dataQuery = DB::table('t_transaction_qty')
        
        ->leftjoin('m_assets', 't_transaction_qty.asset_id', '=', 'm_assets.asset_id')

        ->leftjoin('master_resto_v2', 't_transaction_qty.from_loc', '=', 'master_resto_v2.id')

        ->leftjoin('t_out', 't_transaction_qty.out_id', '=', 't_out.out_id')

        ->leftjoin('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
        
        ->leftjoin('m_condition', 't_out_detail.condition', '=', 'm_condition.condition_id')

        ->select('master_resto_v2.id AS id_resto','master_resto_v2.name_store_street', 'm_assets.asset_model', 'm_condition.condition_name', 'm_condition.condition_id', 't_transaction_qty.qty', 't_transaction_qty.out_id', 't_transaction_qty.created_at');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = $request->input('start_date') . ' 00:00:00'; 
            $endDate = $request->input('end_date') . ' 23:59:59'; 
            $dataQuery->whereBetween('t_transaction_qty.created_at', [$startDate, $endDate]);
        }

        // Execute the query and get the paginated result
        
        $data = $dataQuery->get();

        return response()->json($data);
    }

    public function HalamanAsset() {
        return view("Admin.Master.halaman_asset");
    }


    public function GetDataAsset(): JsonResponse
    {
        // Fetch all assets from the database
        $dataAsset = MasterAsset::all();
    
        foreach ($dataAsset as $Asset) {
            // Define the file path for the QR code
            $qrCodeFileName = $Asset->asset_code . '.png';
            $qrCodeFilePath = storage_path('app/public/qrcodes/' . $qrCodeFileName);
    
            // Check if the QR code already exists
            if (file_exists($qrCodeFilePath)) {
                // Assign the QR code path to the asset object
                $Asset->qr_code_path = asset('storage/qrcodes/' . $qrCodeFileName);
            } else {
                // Generate the QR code and save it to the defined path if it doesn't exist
                QrCode::format('png')->size(300)->generate($Asset->asset_code, $qrCodeFilePath);
                // Assign the newly generated QR code path to the asset object
                $Asset->qr_code_path = asset('storage/qrcodes/' . $qrCodeFileName);
            }
        }
    
        // Return the assets with QR code paths as a JSON response
        return response()->json($dataAsset);
    }
    

    public function GetDetailDataAsset($id) {
        $asset = AssetModel::find($id);

        if ($asset) {
            return response()->json($asset);
        }

        return response()->json(['Error' => 'Asset not found'], 404);
    }
    public function AddDataAsset(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'register_code' => 'required|string|max:255',
            'asset_name' => 'required|string|max:255',
            'serial_number' => 'required|string|in:PRIORITY,NOT PRIORITY,BASIC',
            'type_asset' => 'required|string|max:255',
            'category_asset' => 'required|string|max:255',
            'prioritas' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'qty' => 'required',
            'satuan' => 'required|string|max:255',
            'register_location' => 'required|string|max:255',
            'layout' => 'required|string|max:255',
            'register_date' => 'required',
            'supplier' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'purchase_number' => 'required|string|max:255',
            'purchase_date' => 'required',
            'warranty' => 'required',
            'periodic_maintenance' => 'required',
        ]);
    
        // Retrieve validated input data
        $register_code = $validatedData['register_code'];
        $asset_name = $validatedData['asset_name'];
        $serial_number = $validatedData['serial_number'];
        $type_asset = $validatedData['type_asset'];
        $category_asset = $validatedData['category_asset'];
        $prioritas = $validatedData['prioritas'];
        $merk = $validatedData['merk'];
        $qty = $validatedData['qty'];
        $satuan = $validatedData['satuan'];
        $register_location = $validatedData['register_location'];
        $layout = $validatedData['layout'];
        $register_date = $validatedData['register_date'];
        $supplier = $validatedData['supplier'];
        $status = $validatedData['status'];
        $purchase_number = $validatedData['purchase_number'];
        $purchase_date = $validatedData['purchase_date'];
        $warranty = $validatedData['warranty'];
        $periodic_maintenance = $validatedData['periodic_maintenance'];

        // Generate QR Code
        $qrCode = QrCode::format('png')->size(300)->generate($register_code);
    
        // Create an image resource from the QR code
        $qrImage = imagecreatefromstring($qrCode);
        if ($qrImage === false) {
            return response()->json(['status' => 'error', 'message' => 'Failed to create image from QR code.'], 500);
        }
    
        // Define the color based on the asset status
        $squareColor = match ($status) {
            'PRIORITY' => imagecolorallocate($qrImage, 255, 0, 0), // Red
            'NOT PRIORITY' => imagecolorallocate($qrImage, 255, 255, 0), // Yellow
            'BASIC' => imagecolorallocate($qrImage, 0, 0, 255), // Blue
            default => imagecolorallocate($qrImage, 0, 0, 0), // Default to black
        };
    
        // Calculate position for the square
        $squareSize = 50; // Size of the small square
        $xPosition = (imagesx($qrImage) / 2) - ($squareSize / 2);
        $yPosition = (imagesy($qrImage) / 2) - ($squareSize / 2);
    
        // Draw the square on the QR code
        imagefilledrectangle($qrImage, $xPosition, $yPosition, $xPosition + $squareSize, $yPosition + $squareSize, $squareColor);
    
        // Define the file path for the QR code
        $filePath = storage_path('app/public/qrcodes');
        $fileName = $$register_code . '.png';
    
        // Create the directory if it doesn't exist
        if (!File::exists($filePath)) {
            File::makeDirectory($filePath, 0755, true);
        }
    
        // Save the modified QR code image
        imagepng($qrImage, $filePath . '/' . $fileName);
        imagedestroy($qrImage); // Free up memory
    
        // Store asset data in the database
        $asset = new MasterRegistrasiModel();
        $asset->register_code = $register_code;
        $asset->asset_name = $asset_name;
        $asset->serial_number = $serial_number;
        $asset->type_asset = $type_asset;
        $asset->category_asset = $category_asset;
        $asset->prioritas = $prioritas;
        $asset->merk = $merk;
        $asset->qty = $qty;
        $asset->satuan = $satuan;
        $asset->register_location = $register_location;
        $asset->layout = $layout;
        $asset->register_date = $register_date;
        $asset->supplier = $supplier;
        $asset->status = $status;
        $asset->purchase_number = $purchase_number;
        $asset->purchase_date = $purchase_date;
        $asset->warranty = $warranty;
        $asset->periodic_maintenance = $periodic_maintenance;


        // Update the asset's qr_code_path before saving
        $asset->qr_code_path = asset('storage/qrcodes/' . $fileName);
    
        if ($asset->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Tambah Data Asset Berhasil',
                'qr_code_path' => $asset->qr_code_path
            ], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Tambah Data Asset Gagal'], 500);
        }
    }
    
    
    
    


    public function updateDataAsset(Request $request){
    $data = $request->only(['asset_id', 'asset_code', 'asset_model', 'asset_status', 'asset_quantity']);

    $asset = MasterAsset::find($data['asset_id']);

    if ($asset && $asset->update([
        'asset_code' => $data['asset_code'],
        'asset_model' => $data['asset_model'],
        'asset_status' => $data['asset_status'],
        'asset_quantity' => $data['asset_quantity']
    ])) {
        return response()->json(['status' => 'success', 'message' => 'Asset updated successfully.']);
    } else {
        return response()->json(['status' => 'error', 'message' => 'Failed to update asset.'], 500);
    }
}

public function deleteDataAsset($id)
{
    $asset = AssetModel::find($id);

    if ($asset) {
        $asset->delete();
        return response()->json(['status' => 'Success', 'message' => 'Data Asset Berhasil Terhapus']);
    } else {
        return response()->json(['status' => 'Error', 'message' => 'Data Asset Gagal Terhapus'], 404);
    }
}


public function details($assetCode)
{
    $asset = AssetModel::where('asset_code', $assetCode)->first();

    if (!$asset) {
        abort(404, 'Asset not found');
    }

    return view('asset.details', ['asset' => $asset]);
}


public function UserManagement() {
    
}




}
