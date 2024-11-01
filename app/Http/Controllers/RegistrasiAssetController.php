<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterRegistrasiModel;
use Illuminate\Http\JsonResponse;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Exports\AssetExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MasterRegistrasiImport;

class RegistrasiAssetController extends Controller
{
    public function HalamanRegistrasiAsset()
    {
        return view("Admin.registrasi_asset.laman_registrasi_asset");
    }

    public function GetDataRegistrasiAsset(): JsonResponse
    {
        // Fetch all assets including soft-deleted ones
        $dataAsset = MasterRegistrasiModel::withTrashed()->get();

        foreach ($dataAsset as $Asset) {
            // Set data_registrasi_asset_status based on deleted_at
            $Asset->data_registrasi_asset_status = is_null($Asset->deleted_at) ? 'active' : 'nonactive';

            // Check if asset_code is not null before generating the QR code
            if (!empty($Asset->asset_code)) {
                // Define the file path for the QR code
                $qrCodeFileName = $Asset->asset_code . '.png';
                $qrCodeFilePath = storage_path('app/public/qrcodes/' . $qrCodeFileName);

                // Check if the QR code already exists
                if (file_exists($qrCodeFilePath)) {
                    // Assign the QR code path to the asset object
                    $Asset->qr_code_path = asset('app/public/qrcodes/' . $qrCodeFileName);
                } else {
                    // Generate the QR code and save it to the defined path if it doesn't exist
                    QrCode::format('png')->size(300)->generate($Asset->asset_code, $qrCodeFilePath);
                    // Assign the newly generated QR code path to the asset object
                    $Asset->qr_code_path = asset('app/public/qrcodes/' . $qrCodeFileName);
                }
            }
        }

        // Return the assets with QR code paths and status as a JSON response
        return response()->json($dataAsset);
    }




    public function AddDataRegistrasiAsset(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'register_code' => 'required|string|max:255',
            'asset_name' => 'required|string|max:255',
            'serial_number' => 'required|string',
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
            'approve_status' => 'nullable|string|max:255'
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
        $approve_status = $validatedData['approve_status'];

        // Generate the URL that the QR code will link to, based on your route
        $url = route('assets.details', ['register_code' => $register_code]);

        // Generate the QR Code with the URL
        $qrCode = QrCode::format('png')->size(300)->generate($url);

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
        $filePath = base_path('qrcodes');
        $fileName = $register_code . '.png';

        // Create the directory if it doesn't exist
        if (!File::exists($filePath)) {
            File::makeDirectory($filePath, 0755, true);
        }

        if (!File::exists($filePath)) {
            File::makeDirectory($filePath, 0755, true);
        }

        // Save the modified QR code image
        imagepng($qrImage, $filePath . '/' . $fileName);
        imagedestroy($qrImage); // Free

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
        $asset->approve_status = $approve_status;

        // Update the asset's qr_code_path before saving
        $asset->qr_code_path = asset('public/qrcodes/' . $fileName);

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


    // public function UpdateDataRegistrasiAsset(Request $request, $id) {
    //     // Validate input
    //     $request->validate([
    //         'register_code' => 'required|string|max:255',
    //         'asset_name' => 'required|string|max:255',
    //         'serial_number' => 'required|string|max:255',
    //         'type_asset' => 'required|string|max:255',
    //         'category_asset' => 'required|string|max:255',
    //         'prioritas' => 'required|string|max:255',
    //         'merk' => 'required|string|max:255',
    //         'qty' => 'required|integer',
    //         'satuan' => 'required|string|max:255',
    //         'register_location' => 'required|string|max:255',
    //         'layout' => 'required|string|max:255',
    //         'register_date' => 'required|date',
    //         'supplier' => 'required|string|max:255',
    //         'status' => 'required|string|max:255',
    //         'purchase_number' => 'required|string|max:255',
    //         'purchase_date' => 'required|date',
    //         'warranty' => 'required|string|max:255',
    //         'periodic_maintenance' => 'required|string|max:255',
    //         'qr_code_path' => 'required|string|max:255',
    //     ]);

    //     // Find the asset using the provided ID
    //     $registrasiAsset = MasterRegistrasiModel::find($id);

    //     // Check if the asset exists
    //     if (!$registrasiAsset) {
    //         return response()->json(['status' => 'error', 'message' => 'Asset not found.'], 404);
    //     }

    //     // Update data using the validated request data
    //     try {
    //         $registrasiAsset->update($request->only([
    //             'register_code',
    //             'asset_name',
    //             'serial_number',
    //             'type_asset',
    //             'category_asset',
    //             'prioritas',
    //             'merk',
    //             'qty',
    //             'satuan',
    //             'register_location',
    //             'layout',
    //             'register_date',
    //             'supplier',
    //             'status',
    //             'purchase_number',
    //             'purchase_date',
    //             'warranty',
    //             'periodic_maintenance',
    //             'qr_code_path'
    //         ])); // Use $request->only() directly for update

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Asset updated successfully.'
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json(['status' => 'error', 'message' => 'Error updating asset: ' . $e->getMessage()], 500);
    //     }
    // }




    public function DeleteDataRegistrasiAsset($id)
    {
        $registrasiAsset = MasterRegistrasiModel::find($id);

        if ($registrasiAsset == true) {
            $registrasiAsset->delete();
            return response()->json(['status' => 'Success', 'message' => 'Data Asset Berhasil Terhapus']);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data Asset Gagal Terhapus'], 404);
        }
    }



    public function GetDetailDataRegistrasiAsset($id)
    {
        $asset = MasterRegistrasiModel::find($id);
        if (!$asset) {
            return response()->json(['message' => 'Asset not found.'], 404);
        }

        return response()->json($asset);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'register_code' => 'required|string|max:255',
            'asset_name' => 'required|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'type_asset' => 'nullable|string|max:255',
            'category_asset' => 'nullable|string|max:255',
            'prioritas' => 'nullable|string|max:100',
            'merk' => 'nullable|string|max:255',
            'qty' => 'required|integer|min:1',
            'satuan' => 'nullable|string|max:100',
            'register_location' => 'nullable|string|max:255',
            'layout' => 'nullable|string|max:255',
            'register_date' => 'nullable|date',
            'supplier' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:100',
            'purchase_number' => 'nullable|string|max:255',
            'purchase_date' => 'nullable|date',
            'warranty' => 'nullable|string|max:255',
            'periodic_maintenance' => 'nullable|string|max:255',
        ]);

        $asset = MasterRegistrasiModel::findOrFail($id);
        $asset->update($request->all());

        return response()->json(['message' => 'Asset updated successfully!']);
    }




    public function ExportToExcel()
    {
        return Excel::download(new AssetExport, 'data_registrasi_asset.xlsx');
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new MasterRegistrasiImport, $request->file('file'));
            return back()->with('success', 'Excel data imported successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error importing Excel data: ' . $e->getMessage());
        }
    }


    public function Trash()
    {
        $dataRegistrasiAsset = MasterRegistrasiModel::onlyTrashed()->get();
        return response()->json($dataRegistrasiAsset);
    }



    public function TampilDataQR($register_code)
    {
        // Find the asset by register_code
        $asset = MasterRegistrasiModel::where('register_code', $register_code)->first();

        // Check if the asset exists
        if (!$asset) {
            return redirect()->route('assets.index')->with('error', 'Asset not found.');
        }

        // Pass the asset data to the view
        return view('Admin.registrasi_asset.qr_scan_registrasi_asset', compact('asset'));
    }

    public function approve(Request $request)
    {
        $assetId = $request->input('id');

        $asset = MasterRegistrasiModel::find($assetId);

        if ($asset) {
            // Update the approve_status to 'sudah approve'
            $asset->approve_status = 'sudah approve';
            if ($asset->save()) {
                return response()->json(['status' => 'success', 'message' => 'Asset approved successfully']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Failed to approve asset']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Asset not found']);
        }
    }
}
