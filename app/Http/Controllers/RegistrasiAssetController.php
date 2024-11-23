<?php



namespace App\Http\Controllers;



use App\Models\Master\MasterRegistrasiModel;

use App\Models\Master\MasterPeriodicMtc;

use App\Models\Master\MasterType;

use Illuminate\Http\JsonResponse;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

use App\Exports\AssetExport;

use Maatwebsite\Excel\Facades\Excel;

use App\Imports\MasterRegistrasiImport;
use App\Models\Master\MasterAsset;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class RegistrasiAssetController extends Controller

{

    public function HalamanRegistrasiAsset() {

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

            $qrCodeFilePath = public_path('qrcodes/' . $qrCodeFileName);



            // Check if the QR code already exists

            if (file_exists($qrCodeFilePath)) {

                // Assign the QR code path to the asset object

                $Asset->qr_code_path = asset('public/qrcodes/' . $qrCodeFileName);

            } else {

                // Generate the QR code and save it to the defined path if it doesn't exist

                QrCode::format('png')->size(300)->generate($Asset->asset_code, $qrCodeFilePath);

                // Assign the newly generated QR code path to the asset object

                $Asset->qr_code_path = asset('public/qrcodes/' . $qrCodeFileName);

            }

        }

    }



    // Return the assets with QR code paths and status as a JSON response

    return response()->json($dataAsset);

}


public function LamanTambahRegistrasi() {
    return view('Admin.registrasi_asset.add_data_asset');
}




    

    



public function AddDataRegistrasiAsset(Request $request) {

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

        'condition' => 'required|string|max:255',

        'purchase_number' => 'required|string|max:255',

        'purchase_date' => 'required',

        'warranty' => 'required',

        'periodic_maintenance' => 'required',

        'approve_status' => 'nullable|string|max:255',

        'width' => 'nullable|int',

        'height' => 'nullable|int',

        'depth' => 'nullable|int',

        'location_now' => 'nullable|string|max:255',


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

    $condition = $validatedData['condition'];

    $purchase_number = $validatedData['purchase_number'];

    $purchase_date = $validatedData['purchase_date'];

    $warranty = $validatedData['warranty'];

    $periodic_maintenance = $validatedData['periodic_maintenance'];

    $approve_status = $validatedData['approve_status'];

    $width = $validatedData['width'];

    $height = $validatedData['height'];

    $depth = $validatedData['depth'];

    $location_now = $validatedData['location_now'] ?? $register_location;



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

    $squareColor = match ($prioritas) {

        'HIGH' => imagecolorallocate($qrImage, 255, 0, 0), // Red

        'MEDIUM' => imagecolorallocate($qrImage, 255, 255, 0), // Yellow

        'LOW' => imagecolorallocate($qrImage, 0, 0, 255), // Blue

        default => imagecolorallocate($qrImage, 0, 0, 0), // Default to black

    };



    // Calculate position for the square

    $squareSize = 50; // Size of the small square

    $xPosition = (imagesx($qrImage) / 2) - ($squareSize / 2);

    $yPosition = (imagesy($qrImage) / 2) - ($squareSize / 2);



    // Draw the square on the QR code

    imagefilledrectangle($qrImage, $xPosition, $yPosition, $xPosition + $squareSize, $yPosition + $squareSize, $squareColor);



    // Define the file path for the QR code

    $filePath = public_path('/qrcodes');

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

    $asset->condition = $condition;

    $asset->purchase_number = $purchase_number;

    $asset->purchase_date = $purchase_date;

    $asset->warranty = $warranty;

    $asset->periodic_maintenance = $periodic_maintenance;

    $asset->approve_status = $approve_status;

    $asset->width = $width;

    $asset->height = $height;

    $asset->depth = $depth;

    $asset->location_now = $location_now;



    // Update the asset's qr_code_path before saving

    $asset->qr_code_path = asset('public/qrcodes/' . $fileName);



    if ($asset->save()) {

        return redirect()->to('/admin/registrasi_asset/lihat_data_registrasi_asset');

    } else {

        return redirect()->back()->with('error', 'Gagal Input Ke database');

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

    

    

    



    public function DeleteDataRegistrasiAsset($id) {
        $registrasiAsset = MasterRegistrasiModel::find($id);

        if ($registrasiAsset == true) {
            $registrasiAsset->delete();
            return response()->json(['status' => 'Success', 'message' => 'Data Asset Berhasil Terhapus']);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data Asset Gagal Terhapus'], 404);
        }
    }


public function GetDetailDataRegistrasiAsset($id) {
    $asset = MasterRegistrasiModel::findOrFail($id); // This will return null if not found

    if (!$asset) {
        return redirect()->back()->with('error', 'Asset not found.');
    }

    return view('Admin.registrasi_asset.update_data_asset', compact('asset'));
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
        'register_location' => 'required|string|max:255',
        'layout' => 'nullable|string|max:255',
        'register_date' => 'nullable|date',
        'supplier' => 'nullable|string|max:255',
        'condition' => 'nullable|string|max:100',
        'purchase_number' => 'nullable|string|max:255',
        'purchase_date' => 'nullable|date',
        'warranty' => 'nullable|string|max:255',
        'periodic_maintenance' => 'nullable|string|max:255',
    ]);

    // Retrieve the existing asset record
    $asset = MasterRegistrasiModel::findOrFail($id);

    // Update the asset data
    $updateData = $request->all();
    $asset->update($updateData);

    // Generate the new QR code URL
    $url = route('assets.details', ['register_code' => $asset->register_code]);

    // Generate the QR Code with the URL
    $qrCode = QrCode::format('png')->size(300)->generate($url);

    // Create an image resource from the QR code
    $qrImage = imagecreatefromstring($qrCode);
    if ($qrImage === false) {
        return response()->json(['status' => 'error', 'message' => 'Failed to create image from QR code.'], 500);
    }

    // Define the color based on the updated status
    $squareColor = match ($asset->prioritas) {
        'HIGH' => imagecolorallocate($qrImage, 255, 0, 0), // Red
        'MEDIUM' => imagecolorallocate($qrImage, 255, 255, 0), // Yellow
        'LOW' => imagecolorallocate($qrImage, 0, 0, 255), // Blue
        default => imagecolorallocate($qrImage, 0, 0, 0), // Default to black
    };

    // Calculate position for the square
    $squareSize = 50; // Size of the small square
    $xPosition = (imagesx($qrImage) / 2) - ($squareSize / 2);
    $yPosition = (imagesy($qrImage) / 2) - ($squareSize / 2);

    // Draw the square on the QR code
    imagefilledrectangle($qrImage, $xPosition, $yPosition, $xPosition + $squareSize, $yPosition + $squareSize, $squareColor);

    // Define the file path for the updated QR code
    $filePath = public_path('/qrcodes');
    $fileName = $asset->register_code . '.png';

    // Create the directory if it doesn't exist
    if (!File::exists($filePath)) {
        File::makeDirectory($filePath, 0755, true);
    }

    // Save the modified QR code image
    imagepng($qrImage, $filePath . '/' . $fileName);
    imagedestroy($qrImage); // Free memory

    // Update the asset's QR code path in the database
    $asset->qr_code_path = asset('qrcodes/' . $fileName);
    $asset->save();

    return redirect()->to('/admin/registrasi_asset/lihat_data_registrasi_asset');
}

    

    
    
    public function ExportToExcel()
    {
        return Excel::download(new AssetExport, 'data_registrasi_asset.xlsx');
    }

    public function import(Request $request)
    {

        ini_set('max_execution_time', 3600);
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
    
        try {
            // Import the Excel file and process each row
            Excel::import(new class extends MasterRegistrasiImport {
                public function model(array $row)
                {
                    $registerCode = $row['register_code'];
                    $assetName = $row['asset_name'];
                    $serialNumber = $row['serial_number'];
                    $typeAsset = $row['type_asset'];
                    $categoryAsset = $row['category_asset'];
                    $priorityAsset = $row['prioritas'];
                    $merkAsset = $row['merk'];
                    $satuanAsset = $row['satuan'];
                    $layoutAsset = $row['layout'];
                    $supplierAsset = $row['supplier'];
                    $warrantyAsset = $row['warranty'];
                    $periodicMaintenanceAsset = $row['periodic_maintenance'];
                    $quantityAsset = $row['qty'];
                    $registerLocationAsset = $row['register_location'];
                    $registerDateAsset = $row['register_date'];
                    $conditionAsset = $row['condition'];
                    $purchaseNumberAsset = $row['purchase_number'];
                    $purchaseDateAsset = $row['purchase_date'];
                    $widthAsset = $row['width'];
                    $heightAsset = $row['height'];
                    $depthAsset = $row['depth'];
        
                    // $isDuplicate = DB::table('table_registrasi_asset')
                    //                  ->where('register_code', $registerCode)
                    //                  ->orWhere('asset_name', $assetName)
                    //                  ->exists();
    
                    // if ($isDuplicate) {
                    //     throw new \Exception("Duplicate value found for asset name '{$assetName}' or register code '{$registerCode}'. Import aborted.");
                    // }
    
                    // Check for existence in other tables
                    $checks = [
                        ['table' => 'm_assets', 'field' => 'asset_model', 'value' => $assetName, 'name' => 'Asset'],
                        ['table' => 'm_type', 'field' => 'type_name', 'value' => $typeAsset, 'name' => 'Type'],
                        ['table' => 'm_category', 'field' => 'cat_name', 'value' => $categoryAsset, 'name' => 'Category'],
                        ['table' => 'm_priority', 'field' => 'priority_name', 'value' => $priorityAsset, 'name' => 'Priority'],
                        ['table' => 'm_brand', 'field' => 'brand_name', 'value' => $merkAsset, 'name' => 'Brand'],
                        ['table' => 'm_uom', 'field' => 'uom_name', 'value' => $satuanAsset, 'name' => 'UOM'],
                        ['table' => 'm_layout', 'field' => 'layout_name', 'value' => $layoutAsset, 'name' => 'Layout'],
                        ['table' => 'master_resto_v2', 'field' => 'name_store_street', 'value' => $registerLocationAsset, 'name' => 'Register Location'],

                    ];
    
                    foreach ($checks as $check) {
                        $exists = DB::table($check['table'])
                                    ->where($check['field'], $check['value'])
                                    ->exists();
                        if (!$exists) {
                            throw new \Exception("Data {$check['name']} '{$check['value']}' Tidak ada pada Master Data '{$check['table']}'. Import Data Excel Dibatalkan.");
                        }
                    }

                    $url = route('assets.details', ['register_code' => $registerCode]);

                $qrCode = QrCode::format('png')->size(300)->generate($url);

                // Create an image resource from the QR code
                $qrImage = imagecreatefromstring($qrCode);
                if ($qrImage === false) {
                    throw new \Exception('Failed to create image from QR code.');
                }

                // Define the color based on the asset status
                $squareColor = match ($priorityAsset) {
                    'HIGH' => imagecolorallocate($qrImage, 255, 0, 0), // Red
                    'MEDIUM' => imagecolorallocate($qrImage, 255, 255, 0), // Yellow
                    'LOW' => imagecolorallocate($qrImage, 0, 0, 255), // Blue
                    default => imagecolorallocate($qrImage, 0, 0, 0), // Default to black
                };

                // Calculate position for the square
                $squareSize = 50; // Size of the small square
                $xPosition = (imagesx($qrImage) / 2) - ($squareSize / 2);
                $yPosition = (imagesy($qrImage) / 2) - ($squareSize / 2);

                // Draw the square on the QR code
                imagefilledrectangle(
                    $qrImage, 
                    $xPosition, 
                    $yPosition, 
                    $xPosition + $squareSize, 
                    $yPosition + $squareSize, 
                    $squareColor
                );

                // Define the file path for the QR code
                $filePath = public_path('/qrcodes');
                $fileName = $registerCode . '.png';

                // Create the directory if it doesn't exist
                if (!File::exists($filePath)) {
                    File::makeDirectory($filePath, 0755, true);
                }

                // Save the modified QR code image
                imagepng($qrImage, $filePath . '/' . $fileName);
                imagedestroy($qrImage); // Free up memory

                // Store the URL path instead of the server path
                $qrCodeUrlPath = asset('public/qrcodes/' . $fileName);


                                DB::table('table_registrasi_asset')->insert([
                                    'register_code' => $registerCode,
                                    'asset_name' => $assetName,
                                    'serial_number' => $serialNumber,
                                    'type_asset' => $typeAsset,
                                    'category_asset' => $categoryAsset,
                                    'prioritas' => $priorityAsset, 
                                        'merk' => $merkAsset,
                                        'satuan' => $satuanAsset,
                                        'layout' => $layoutAsset,
                                        'supplier' => $supplierAsset,
                                        'warranty' => $warrantyAsset,
                                        'periodic_maintenance' => $periodicMaintenanceAsset,
                                    'qty' => $quantityAsset,
                                    'register_location' => $registerLocationAsset,
                                    'register_date' => $registerDateAsset,
                                    'condition' => $conditionAsset,
                                    'purchase_number' => $purchaseNumberAsset,
                                    'purchase_date' => $purchaseDateAsset,
                                    'width' => $widthAsset,
                                    'height' => $heightAsset,
                                    'depth' => $depthAsset,
                                    'qr_code_path' => $qrCodeUrlPath,
                                    'created_at' => now(),
                                    'updated_at' => now()
                                ]);  
                }
            }, $request->file('file'));
    
            // If import is successful, return a success message
            return redirect()->back()->with('success', 'Data imported successfully.');
            
        } catch (\Exception $e) {
            // Catch the exception and redirect with an error notification
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    


        
    
        // try {
        //     // Import the Excel file and process each row
        //     Excel::import(new class extends MasterRegistrasiImport {
        //         public function model(array $row)
        //         {
        //             $assetName = $row['asset_name'];
        //             $registerCode = $row['register_code'];
        //             $serialNumber = $row['serial_number'];
        //             $assetName = $row['asset_name'];
        //             $typeAsset = $row['type_asset'];
        //             $priorityAsset = $row['prioritas'];
        //             $categoryAsset = $row['category_asset'];
        //             $merkAsset = $row['merk'];
        //             $satuanAsset = $row['satuan'];
        //             $layoutAsset = $row['layout'];
        //             $supplierAsset = $row['supplier'];
        //             $warrantyAsset = $row['warranty'];
        //             $periodicMaintenanceAsset = $row['periodic_maintenance'];
        //             $quantityAsset  = $row['qty'];
        //             $registerLocationAsset = $row['register_location'];
        //             $registerDateAsset = $row['register_date'];
        //             $statusAsset = $row['status'];
        //             $purchaseNumberAsset = $row['purchase_number'];
        //             $purchaseDateAsset = $row['purchase_date'];
        //             $widthAsset = $row['width'];
        //             $heightAsset = $row['height'];
        //             $depthAsset = $row['depth'];
                    


    
        //             // Check if the asset_name and register_code already exist in table_registrasi_asset
        //             $isDuplicate = DB::table('table_registrasi_asset')
        //                              ->where('register_code', $registerCode)
        //                              ->orWhere('asset_name', $assetName)
        //                              ->exists();
    
        //             if ($isDuplicate) {
        //                 throw new \Exception("Duplicate value found for asset name '{$assetName}' or register code '{$registerCode}'. Import aborted.");
        //             }


        //             $assetExist = DB::table('m_assets')
        //             ->where('asset_model', $assetName)
        //             ->exists();

        //             if (!$assetExist) {
                    
        //             }

    
        //             $typeExists = DB::table('m_type')
        //                             ->where('type_name', $typeAsset)
        //                             ->exists();
    
        //             if (!$typeExists) {
                        
        //             }


        //             $categoryExists = DB::table('m_category')
        //             ->where('cat_name', $categoryAsset)
        //             ->exists();

        //             if (!$categoryExists) {
                    
        //             }

        //             $priorityExists = DB::table('m_priority')
        //             ->where('priority_name', $priorityAsset)
        //             ->exists();

        //             if (!$priorityExists) {
                       
        //             }

                    
        //             $merkExists = DB::table('m_brand')
        //             ->where('brand_name', $merkAsset)
        //             ->exists();

        //             if (!$merkExists) {
                      
        //             }

        //             $satuanExists = DB::table('m_uom')
        //             ->where('uom_name', $satuanAsset)
        //             ->exists();

        //             if (!$satuanExists) {
                       
        //             }


                    
        //             $layoutExists = DB::table('m_layout')
        //             ->where('layout_name', $layoutAsset)
        //             ->exists();

        //             if (!$layoutExists) {
                      
        //             }

        //             $supplierExists = DB::table('m_supplier')
        //             ->where('supplier_name', $supplierAsset)
        //             ->exists();

        //             if (!$supplierExists) {
                       
        //             }

        //             $warrantyExists = DB::table('m_warranty')
        //             ->where('warranty_name', $warrantyAsset)
        //             ->exists();

        //             if (!$warrantyExists) {
                       
        //             }

        //             $periodicMtcExists = DB::table('m_periodic_mtc')
        //             ->where('periodic_mtc_name', $periodicMaintenanceAsset)
        //             ->exists();

        //             if (!$periodicMtcExists) {
                      
        //             }

        //               // Define the path where QR codes will be saved
        //             $qrCodeDir = storage_path('app/public/qrcodes');

        //         // Ensure the directory exists
        //         if (!file_exists($qrCodeDir)) {
        //             mkdir($qrCodeDir, 0777, true);
        //         }

        //         // Generate the QR code based on the asset's register code
        //         $qrCodeFileName = 'QR-' . $registerCode . '.png';
        //         $qrCodePath = $qrCodeDir . '/' . $qrCodeFileName;

        //         // Generate and save the QR code
        //         QrCode::format('png')->size(200)->generate($registerCode, $qrCodePath);
    
        //             // Insert data into table_registrasi_asset
        //             DB::table('table_registrasi_asset')->insert([
        //                 'register_code' => $registerCode,
        //                 'asset_name' => $assetName,
        //                 'serial_number' => $serialNumber,
        //                 'type_asset' => $typeAsset,
        //                 'category_asset' => $categoryAsset,
        //                 'prioritas' => $priorityAsset, 
        //                     'merk' => $merkAsset,
        //                     'satuan' => $satuanAsset,
        //                     'layout' => $layoutAsset,
        //                     'supplier' => $supplierAsset,
        //                     'warranty' => $warrantyAsset,
        //                     'periodic_maintenance' => $periodicMaintenanceAsset,
        //                 'qty' => $quantityAsset,
        //                 'register_location' => $registerLocationAsset,
        //                 'register_date' => $registerDateAsset,
        //                 'status' => $statusAsset,
        //                 'purchase_number' => $purchaseNumberAsset,
        //                 'purchase_date' => $purchaseDateAsset,
        //                 'width' => $widthAsset,
        //                 'height' => $heightAsset,
        //                 'depth' => $depthAsset,
        //                 'qr_code_path' => $qrCodePath,
        //                 'created_at' => now(),
        //                 'updated_at' => now()
        //             ]);  
        //         }
        //     }, $request->file('file'));
        // } catch (\Exception $e) {
        //     return back()->withErrors(['error' => $e->getMessage()]);
        // }
    
        // return back()->withSuccess('File imported successfully.');

    
    
    


    public function Trash() {
        $dataRegistrasiAsset = MasterRegistrasiModel::onlyTrashed()->get();
        return response()->json($dataRegistrasiAsset);
    }



    public function TampilDataQR($register_code) 
    {
        $asset = MasterRegistrasiModel::where('register_code', $register_code)->first();
   
        if (!$asset) {
            return redirect()->route('assets.details')->with('error', 'Asset not found.');
        }

        // Generate QR code
        $qrCodeFileName = $register_code . '.png';
        $qrCodeFilePath = public_path('qrcodes/' . $qrCodeFileName);
        $qrCodeUrl = asset('qrcodes/' . $qrCodeFileName);

        // Generate QR code if it doesn't exist
        if (!file_exists($qrCodeFilePath)) {
            // Create qrcodes directory if it doesn't exist
            if (!file_exists(public_path('qrcodes'))) {
                mkdir(public_path('qrcodes'), 0777, true);
            }
            
            // Generate QR code with asset details
            QrCode::format('png')
                  ->size(200)
                  ->generate($register_code, $qrCodeFilePath);
        }

        // Pass both asset data and QR code URL to the view
        return view('Admin.registrasi_asset.qr_scan_registrasi_asset', compact('asset', 'qrCodeUrl'));
    }

    public function approve(Request $request) {
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

    public function generatePdf($registerCode)
    {
        // Fetch specific data based on register_code
        $data = MasterRegistrasiModel::where('register_code', $registerCode)->get();
    
        // Ensure QR codes are base64 encoded for embedding
        foreach ($data as $item) {
            if (!empty($item->registrasi_code)) {
                $qrCodeFileName = $item->registrasi_code . '.png';
                $qrCodeFilePath = public_path('qrcodes/' . $qrCodeFileName);
    
                // Generate QR code if it doesn't exist
                if (!file_exists($qrCodeFilePath)) {
                    QrCode::format('png')->size(10)->generate($item->registrasi_code, $qrCodeFilePath);
                }
    
                // Convert QR code image to base64
                $item->qr_code_path = 'data:image/png;base64,' . base64_encode(file_get_contents($qrCodeFilePath));
            }
        }
    
        // Load a view and pass the data to it, with landscape orientation
        $pdf = Pdf::loadView('Admin.registrasi_asset.cetak_pdf', compact('data'))
                  ->setPaper('a7', 'landscape');
    
        // Return the generated PDF for download
        return $pdf->download('registrasi_' . $registerCode . '.pdf');
    }


    public function DetailDataRegistrasiAsset($id) {
    try {
        $asset = MasterRegistrasiModel::findOrFail($id);

        // Generate the QR code (without the square)
        $qrCode = QrCode::format('png')->size(300)->generate($asset->register_code);

        // Create an image from the QR code
        $qrImage = imagecreatefromstring($qrCode);
        if ($qrImage === false) {
            throw new \Exception('Failed to create image from QR code.');
        }

        // Define the color for the square based on asset priority
        $priorityAsset = $asset->prioritas;
        $squareColor = match ($priorityAsset) {
            'HIGH' => imagecolorallocate($qrImage, 255, 0, 0), // Red
            'MEDIUM' => imagecolorallocate($qrImage, 255, 255, 0), // Yellow
            'LOW' => imagecolorallocate($qrImage, 0, 0, 255), // Blue
            default => imagecolorallocate($qrImage, 0, 0, 0), // Black
        };

        // Draw the square in the center of the QR code
        $squareSize = 50;
        $xPosition = (imagesx($qrImage) / 2) - ($squareSize / 2);
        $yPosition = (imagesy($qrImage) / 2) - ($squareSize / 2);
        imagefilledrectangle($qrImage, $xPosition, $yPosition, $xPosition + $squareSize, $yPosition + $squareSize, $squareColor);

        // Define the file path for the QR code
        $filePath = public_path('/qrcodes');
        $fileName = $asset->register_code . '.png';

        // Create the directory if it doesn't exist
        if (!File::exists($filePath)) {
            File::makeDirectory($filePath, 0755, true);
        }

        // Save the modified QR code image
        imagepng($qrImage, $filePath . '/' . $fileName);
        imagedestroy($qrImage);

    } catch (ModelNotFoundException $e) {
        return redirect()->back()->with('error', 'Data Registrasi Asset not found.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }

    return view('Admin.registrasi_asset.detail_data_asset', compact('asset'));
}

    
}







