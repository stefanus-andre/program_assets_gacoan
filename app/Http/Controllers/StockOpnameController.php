<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterStockOpnameModel;
use App\Imports\MasterStockOpnameImport;
use App\Models\Master\OpnameDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class StockOpnameController extends Controller
{
    public function Index()
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $uoms = DB::table('m_uom')->select('uom_id', 'uom_name')->get();
    
        // Retrieve loc_id based on the logged-in user's username
        $username = auth()->user()->username;
        $locId = DB::table('m_people')
                ->where('nip', $username)
                ->value('loc_id');
    
        // Retrieve, modify, and paginate moveouts
        $moveouts = DB::table('t_opname_header')
        ->leftjoin('t_opname_detail', 't_opname_header.opname_id', '=', 't_opname_detail.opname_id')
        ->leftjoin('m_condition', 'm_condition.condition_id', '=', 't_opname_detail.condition')
        ->leftjoin('m_uom', 'm_uom.uom_id', '=', 't_opname_detail.uom')
        ->select('t_opname_header.*', 't_opname_detail.*', 'm_condition.condition_name', 'm_uom.uom_name')
        ->where('t_opname_header.is_active', '=', '1')
        ->get();
            // ->map(function ($moveout) {
            //     $moveout->relative_qr_code_path = str_replace('http://127.0.0.1:8000/', '', $moveout->qr_code_path);
            //     return $moveout;
            // });
    
        $perPage = 10;
        $currentPage = request()->get('page', 1);
        $paginatedMoveouts = new \Illuminate\Pagination\LengthAwarePaginator(
            $moveouts->forPage($currentPage, $perPage),
            $moveouts->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    
        return view('Admin.stockopname', [
            'locId' => $locId,
            'reasons' => $reasons,
            'approvals' => $approvals,
            'assets' => $assets,
            'conditions' => $conditions,
            'uoms' => $uoms,
            'moveouts' => $paginatedMoveouts
        ]);
    }

    public function IndexA()
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $uoms = DB::table('m_uom')->select('uom_id', 'uom_name')->get();
    
        // Retrieve loc_id based on the logged-in user's username
        $username = auth()->user()->username;
        $locId = DB::table('m_people')
                ->where('nip', $username)
                ->value('loc_id');
    
        // Retrieve, modify, and paginate moveouts
        $moveouts = DB::table('t_opname_header')
        ->leftjoin('t_opname_detail', 't_opname_header.opname_id', '=', 't_opname_detail.opname_id')
        ->leftjoin('m_condition', 'm_condition.condition_id', '=', 't_opname_detail.condition_id')
        ->leftjoin('m_uom', 'm_uom.uom_id', '=', 't_opname_detail.uom')
        ->select('t_opname_header.*', 't_opname_detail.*', 'm_condition.condition_name', 'm_uom.uom_name')
        ->where('t_opname_header.is_active', '=', '1')
        ->get();
            // ->map(function ($moveout) {
            //     $moveout->relative_qr_code_path = str_replace('http://127.0.0.1:8000/', '', $moveout->qr_code_path);
            //     return $moveout;
            // });
    
        $perPage = 10;
        $currentPage = request()->get('page', 1);
        $paginatedMoveouts = new \Illuminate\Pagination\LengthAwarePaginator(
            $moveouts->forPage($currentPage, $perPage),
            $moveouts->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    
        return view('Admin.adjuststock', [
            'locId' => $locId,
            'reasons' => $reasons,
            'approvals' => $approvals,
            'assets' => $assets,
            'conditions' => $conditions,
            'uoms' => $uoms,
            'moveouts' => $paginatedMoveouts
        ]);
    }

    public function HalamanStockOpname(Request $request)
{
    // Other data fetch
    $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
    $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
    $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
    $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
    $uoms = DB::table('m_uom')->select('uom_id', 'uom_name')->get();
    
    // Get loc_id based on username
    $username = auth()->user()->username;
    $locId = DB::table('m_people')->where('nip', $username)->value('loc_id');

    // Handle date filtering logic
    $moveoutsQuery = DB::table('t_opname_header')
    ->select('t_opname_header.*', 'master_resto_v2.name_store_street AS location_now', 't_opname_header.verify', 't_opname_detail.qty_onhand', 't_opname_detail.qty_physical', 't_opname_detail.qty_difference', 't_opname_detail.register_code', 'm_uom.uom_name', 't_opname_header.deleted_at')
    ->join('master_resto_v2', 't_opname_header.loc_id', '=', 'master_resto_v2.id')
    ->join('t_opname_detail', 't_opname_header.opname_id', '=', 't_opname_detail.opname_id')
    ->join('m_uom', 't_opname_detail.uom', '=', 'm_uom.uom_id')
    ->where('t_opname_header.is_active', '=', '1');
        // ->leftjoin('t_opname_detail', 't_opname_header.opname_id', '=', 't_opname_detail.opname_id')
        // ->leftjoin('m_condition', 'm_condition.condition_id', '=', 't_opname_detail.condition_id')
        // ->leftjoin('m_uom', 'm_uom.uom_id', '=', 't_opname_detail.uom')

    // Apply date filter if both start_date and end_date are present
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $startDate = $request->input('start_date') . ' 00:00:00'; 
        $endDate = $request->input('end_date') . ' 23:59:59'; 
        $moveoutsQuery->whereBetween('t_opname_header.create_date', [$startDate, $endDate]);
    }

    // Execute the query and get the paginated result
    $moveouts = $moveoutsQuery->get();

    // Paginate the results
    $perPage = 10;
    $currentPage = request()->get('page', 1);
    $paginatedMoveouts = new \Illuminate\Pagination\LengthAwarePaginator(
        $moveouts->forPage($currentPage, $perPage),
        $moveouts->count(),
        $perPage,
        $currentPage,
        ['path' => request()->url(), 'query' => request()->query()]
    );

    // Return the view with the filtered data

    // dd($moveouts);
    return view('Admin.stockopname', [
        'locId' => $locId,
        'reasons' => $reasons,
        'approvals' => $approvals,
        'assets' => $assets,
        'conditions' => $conditions,
        'uoms' => $uoms,
        'moveouts' => $paginatedMoveouts
    ]);
}


    public function HalamanAdjustStock() 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $uoms = DB::table('m_uom')->select('uom_id', 'uom_name')->get();
    
        // Retrieve loc_id based on the logged-in user's username
        $username = auth()->user()->username;
        $locId = DB::table('m_people')
                ->where('nip', $username)
                ->value('loc_id');
    
        // Retrieve, modify, and paginate moveouts
        $moveouts = DB::table('t_opname_header')
        ->leftjoin('t_opname_detail', 't_opname_header.opname_id', '=', 't_opname_detail.opname_id')
        ->leftjoin('m_condition', 'm_condition.condition_id', '=', 't_opname_detail.condition_id')
        ->leftjoin('m_uom', 'm_uom.uom_id', '=', 't_opname_detail.uom')
        ->select('t_opname_header.*', 't_opname_detail.*', 'm_condition.condition_name', 'm_uom.uom_name')
        ->where('t_opname_header.is_active', '=', '1')
        ->get();
            // ->map(function ($moveout) {
            //     $moveout->relative_qr_code_path = str_replace('http://127.0.0.1:8000/', '', $moveout->qr_code_path);
            //     return $moveout;
            // });
    
        $perPage = 10;
        $currentPage = request()->get('page', 1);
        $paginatedMoveouts = new \Illuminate\Pagination\LengthAwarePaginator(
            $moveouts->forPage($currentPage, $perPage),
            $moveouts->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = $request->input('start_date') . ' 00:00:00'; 
            $endDate = $request->input('end_date') . ' 23:59:59'; 
            $moveoutsQuery->whereBetween('t_opname_header.create_date', [$startDate, $endDate]);
        }
    
        return view('Admin.adjuststock', [
            'locId' => $locId,
            'reasons' => $reasons,
            'approvals' => $approvals,
            'assets' => $assets,
            'conditions' => $conditions,
            'uoms' => $uoms,
            'moveouts' => $paginatedMoveouts
        ]);
    }

    public function showPutFormStockOpname($opnameId)
    {
        $moveout = MasterStockOpnameModel::where('opname_id', $opnameId)->first();
        
        if (!$moveout) {
            return response()->json(['message' => 'Moveout not found'], 404);
        }
        
        return response()->json($moveout);
    }

    public function showPutFormAdjustStock($opnameId)
    {
        $moveout = OpnameDetails::where('opname_id', $opnameId)->first();
        
        if (!$moveout) {
            return response()->json(['message' => 'Moveout not found'], 404);
        }
        
        return response()->json($moveout);
    }

    public function getStockOpname()
    {
        // Mengambil semua data dari tabel t_out
        $moveouts = MasterStockOpnameModel::all();
        return response()->json($moveouts); // Mengembalikan data dalam format JSON
    }


    public function getAdjustStock()
    {
        // Mengambil semua data dari tabel t_out
        $moveouts = MasterStockOpnameModel::all();
        return response()->json($moveouts); // Mengembalikan data dalam format JSON
    }

    public function getAssetDetails($id)
    {
        $asset = DB::table('table_registrasi_asset')
            ->select('qty', 'satuan', 'register_code')
            ->where('id', $id)
            ->first();

        return response()->json($asset);
    }

    public function getDetails($id)
    {
        // Fetch data from t_out and t_out_detail based on the out_id
        $moveOut = DB::table('t_opname_header')
            ->where('opname_id', $id)
            ->first();

        $moveOutDetails = DB::table('t_opname_detail')
            ->where('opname_id', $id)
            ->get(); // Assuming you want to retrieve all details related to this out_id

        // Combine the results (if necessary)
        $response = [
            'opname_id' => $moveOut->opname_id,
            'opname_no' => $moveOut->opname_no,
            'loc_id' => $moveOut->loc_id,
            'so_id' => $moveOut->so_id,
            'opname_desc' => $moveOut->opname_desc,
            'create_date' => $moveOut->create_date,
            // Assuming there's a single asset, or you need to modify this to handle multiple assets
            'asset_tag' => $moveOutDetails->first()->asset_tag ?? '',
            'qty_onhand' => $moveOutDetails->first()->qty_onhand ?? '',
            'qty_physical' => $moveOutDetails->first()->qty_physical ?? '',
            'qty_difference' => $moveOutDetails->first()->qty_difference ?? '',
            'condition_id' => $moveOutDetails->first()->condition_id ?? '',
            'uom' => $moveOutDetails->first()->uom ?? '',
        ];

        return response()->json($response);
    }
    

    public function getStockOpnameById($id)
    {
        $moveout = MasterStockOpnameModel::find($id); // Fetch the moveout entry by ID

        if ($moveout) {
            return response()->json($moveout); // Return the moveout data as JSON
        }

        return response()->json(['message' => 'MoveOut not found'], 404); // Handle not found case
    }

    public function getAdjustStockById($id)
    {
        $moveout = MasterStockOpnameModel::find($id); // Fetch the moveout entry by ID

        if ($moveout) {
            return response()->json($moveout); // Return the moveout data as JSON
        }

        return response()->json(['message' => 'MoveOut not found'], 404); // Handle not found case
    }




public function AddDataStockOpname(Request $request) 
{
    $request->validate([
        'asset_id' => 'required|array',
        'asset_id.*' => 'required',
        'opname_reason_id' => 'required',
        'loc_id' => 'required',
        'opname_date' => 'required|date',
        'register_code' => 'required|array',
        'register_code.*' => 'nullable',  // Allow individual register codes to be null
        'image.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        'qty_onhand.*' => 'required|numeric', // Add this validation
        'qty_physical.*' => 'required|numeric' // Add this validation
        
    ]);

    try {   
        // Get trx_code with null check
        $trx_code = DB::table('t_trx')
            ->where('trx_name', 'Stock Opname')
            ->value('trx_code');

        if (!$trx_code) {
            throw new \Exception('Transaction code not found for Stock Opname');
        }

        $today = Carbon::now()->format('ymd');
        $todayCount = MasterStockOpnameModel::whereDate('create_date', Carbon::now())->count() + 1;
        $transaction_number = str_pad($todayCount, 3, '0', STR_PAD_LEFT);

        $stock_opname_code = "{$trx_code}.{$today}.{$request->input('opname_reason_id')}.{$request->input('loc_id')}.{$transaction_number}";

        // Create new stock opname record
        $data_stock_opname = new MasterStockOpnameModel();
        $data_stock_opname->opname_id = $stock_opname_code;
        $data_stock_opname->opname_reason_id = $request->input('opname_reason_id');
        $data_stock_opname->verify = $request->input('verify') ?? '0';
        $data_stock_opname->loc_id = $request->input('loc_id');
        $data_stock_opname->opname_date = $request->input('opname_date');
        $data_stock_opname->opname_desc = $request->input('opname_desc');
        $data_stock_opname->create_date = Carbon::now();
        $data_stock_opname->create_by = Auth::user()->username;
        $data_stock_opname->is_verify = '0';
        $data_stock_opname->is_active = '1';

        $maxMoveoutId = MasterStockOpnameModel::max('opname_no');
        $out_no_base = $maxMoveoutId ? $maxMoveoutId + 1 : 1;
        $data_stock_opname->opname_no = $out_no_base;
        
        $data_stock_opname->save();

        if (!$data_stock_opname->opname_no) {
            throw new \Exception('Failed to generate opname number');
        }

        // Process each asset
        foreach ($request->input('asset_id') as $index => $assetId) {
            if (!$assetId) {
                continue; // Skip if asset ID is null
            }

            $imagePath = null;

            // Handle image upload
            if ($request->hasFile("image") && 
                isset($request->file("image")[$index]) && 
                $request->file("image")[$index]->isValid()) {
                $imagePath = $request->file("image")[$index]->store('stock_opname/images', 'public');
            }

            // Get input values with null coalescing
            $registerCode = $request->input('register_code.'.$index) ?? '';
            $qtyOnhand = intval($request->input('qty_onhand.'.$index, 0));
            $qtyPhysical = intval($request->input('qty_physical.'.$index, 0));
            $condition = $request->input('condition_id.'.$index) ?? '';
            $merk = $request->input('merk.'.$index) ?? '';
            $serialNumber = $request->input('serial_number.'.$index) ?? '';
            $uom = $request->input('satuan.'.$index) ?? '';

            // Insert detail record
            DB::table('t_opname_detail')->insert([
                'opname_det_id' => $out_no_base,
                'opname_id' => $stock_opname_code,
                'asset_id' => $assetId,
                'register_code' => $request->input('register_code.'.$index) ?? '',
                'qty_onhand' => $qtyOnhand,
                'qty_physical' => $qtyPhysical,
                'condition' => $request->input('condition_id.'.$index) ?? '',
                'merk' => $request->input('merk.'.$index) ?? '',
                'serial_number' => $request->input('serial_number.'.$index) ?? '',
                'image' => $imagePath,
                'uom' => $request->input('satuan.'.$index) ?? ''
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data stock opname berhasil ditambahkan',
            'redirect_url' => url('/admin/stockopname')
        ]);

    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error('Stock Opname Error: ' . $e->getMessage());
        \Log::error($e->getTraceAsString());

        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 422);
    }
}

    
    // public function AddDataStockOpname(Request $request)
    // {
    //     // Validasi data yang dikirimkan
    //     $request->validate([
    //         'opname_no' => 'required',
    //         'loc_id' => 'required|string|max:255',
    //         'opname_desc' => 'required|string|max:255',
    //         // 'so_id' => 'required|integer',
    //         'asset_id' => 'required|array',
    //         'register_code' => 'required|array',
    //         'qty' => 'required|array',
    //         'satuan' => 'required|array',
    //         'condition_id' => 'required|array',
    //         'qty_physical' => 'required|array',
    //         'image.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
    //     ]);

    //     try {
    //         // Buat instance dari model MasterStockOpnameModel
    //         $moveout = new MasterStockOpnameModel();
    //         $moveout->loc_id = $request->input('loc_id');
    //         $moveout->opname_desc = $request->input('opname_desc');
    //         $moveout->so_id = $request->input('so_id');
    //         $moveout->is_active = '1';
    //         $moveout->is_verify = '0';
    //         $moveout->create_by = Auth::user()->username;

    //         // Menghasilkan opname_no secara otomatis
    //         $maxMoveoutId = MasterStockOpnameModel::max('opname_no');
    //         $opname_no_base = $maxMoveoutId ? $maxMoveoutId + 1 : 1;
    //         $moveout->opname_no = $opname_no_base; // Set opname_no untuk pertama

    //         // Ambil trx_code dari tabel t_trx berdasarkan trx_name = 'STOCK OPNAME'
    //         $trx_code = DB::table('t_trx')->where('trx_name', 'Stock Opname')->value('trx_code');

    //         // Format yymmdd untuk tanggal hari ini
    //         $today = Carbon::now()->format('ymd');

    //         // Hitung urutan nomor transaksi untuk hari ini
    //         $todayDate = Carbon::now()->format('Y-m-d');
    //         $todayCount = MasterStockOpnameModel::whereDate('create_date', $todayDate)->count() + 1;
    //         $transaction_number = str_pad($todayCount, 3, '0', STR_PAD_LEFT); // Format as 001, 002, etc.

    //         // // Format opname_id
    //         // $moveout->opname_id = "{$trx_code}.{$today}.{$request->input('so_id')}.{$request->input('loc_id')}.{$transaction_number}";
    //         $moveout->save(); // Simpan moveout

    //         // // Handle file upload
    //         // $baseDir = public_path('assets/images/SO');
    //         // $locDir = $baseDir . '/' . $request->input('loc_id');

    //         // if (!file_exists($locDir)) {
    //         //     mkdir($locDir, 0777, true); // Create folder with permission
    //         // }

    //         // $fileIndex = 1;
            

    //         // // Loop through assets to save detail
    //         // foreach ($request->input('asset_id') as $index => $assetId) {
    //         //     $qty_onhand = $request->input('qty')[$index] ?? 0;
    //         //     $qty_physical = $request->input('qty_physical')[$index] ?? 0;
    //         //     $qty_difference = $qty_onhand - $qty_physical;
    //         //     $trx_code = DB::table('t_trx')->where('trx_name', 'Stock Opname')->value('trx_code');
            
    //         //     // Format yymmdd untuk tanggal hari ini
    //         //     $today = Carbon::now()->format('ymd');
            
    //         //     // Get the last transaction number used for today from opname_id
    //         //     $lastTransaction = DB::table('t_opname_detail')
    //         //         ->where('opname_id', 'like', "{$trx_code}.{$today}.%") // Filter by opname_id format
    //         //         ->orderBy('opname_id', 'desc')
    //         //         ->first();
            
    //         //     // Calculate the next transaction number
    //         //     if ($lastTransaction) {
    //         //         // Extract the last transaction number from the opname_id
    //         //         $lastOpnameId = $lastTransaction->opname_id;
    //         //         preg_match('/\.(\d{3})$/', $lastOpnameId, $matches);
    //         //         $transaction_number = isset($matches[1]) ? intval($matches[1]) + 1 : 1; // Increment the last number or start with 1
    //         //     } else {
    //         //         $transaction_number = 1; // Start with 1 if no transaction found
    //         //     }
                
    //         //     $transaction_number_str = str_pad($transaction_number, 3, '0', STR_PAD_LEFT); // Format as 001, 002, etc.
            
    //         //     // Format opname_id untuk setiap detail
    //         //     $opname = "{$trx_code}.{$today}.{$request->input('so_id')}.{$request->input('loc_id')}.{$transaction_number_str}";
            
    //         //     $filePath = null;

    //         //     if ($request->hasFile('image') && isset($request->file('image')[$index])) {
    //         //         $file = $request->file('image')[$index]->store('stock_opname/images');
                
    //         //         if ($file->isValid()) { // Check if f ile is valid
    //         //             $fileName = "{$opname}-{$transaction_number_str}." . $file->getClientOriginalExtension();
                
    //         //             try {
    //         //                 $file->move($locDir, $fileName);
    //         //                 $filePath = "storage/app/public/stock_opname/images/{$request->input('loc_id')}/" . $fileName;
    //         //             } catch (\Exception $e) {
    //         //                 return response()->json(['status' => 'error', 'message' => 'File move failed: ' . $e->getMessage()]);
    //         //             }
    //         //         } else {
    //         //             return response()->json(['status' => 'error', 'message' => 'Invalid file or upload failed.']);
    //         //         }
    //         //     }

    //         //     // Save asset detail data including file paths if applicable
    //         //     DB::table('t_opname_detail')->insert([
    //         //         'opname_det_id' => $moveout->opname_no, // Sequential ID
    //         //         'opname_id' => $opname, // Use the generated opname_id for each detail
    //         //         'asset_tag' => $request->input('register_code')[$index],
    //         //         'qty_onhand' => $qty_onhand,
    //         //         'qty_physical' => $qty_physical,
    //         //         'qty_difference' => $qty_difference,
    //         //         'uom' => $request->input('satuan')[$index],
    //         //         'condition_id' => $request->input('condition_id')[$index],
    //         //         'image' => $filePath, // Store file path in detail if available
    //         //     ]);

    //         //     DB::table('table_registrasi_asset')
    //         //     ->where('id', $assetId) // Match asset by ID
    //         //     ->update(['qty' => $qty_onhand]);

    //         //     $fileIndex++;
    //         // }

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Data moveout berhasil ditambahkan',
    //             'redirect_url' => route('Admin.stockopname')
    //         ]);

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Terjadi kesalahan: ' . $e->getMessage()
    //         ]);
    //     }
    // }

    
    public function AddDataAdjustStock(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'out_date' => 'required|date',
            'from_loc' => 'required|string|max:255',
            'dest_loc' => 'required|string|max:255',
            'out_desc' => 'required|string|max:255',
            'reason_id' => 'required|string|max:255',
            'asset_id' => 'required|array',
            'register_code' => 'required|array',
            'serial_number' => 'required|array',
            'merk' => 'required|array',
            'qty' => 'required|array',
            'satuan' => 'required|array',
            'condition_id' => 'required|array',
        ]);

        try {
            // Buat instance dari model MasterStockOpnameModel
            $moveout = new MasterStockOpnameModel();
            $moveout->out_date = $request->input('out_date');
            $moveout->from_loc = $request->input('from_loc');
            $moveout->dest_loc = $request->input('dest_loc');
            $moveout->out_desc = $request->input('out_desc');
            $moveout->reason_id = $request->input('reason_id');
            $moveout->appr_1 = '1';
            $moveout->is_active = '1';
            $moveout->is_verify = '1';
            $moveout->is_confirm = '1';
            $moveout->create_by = Auth::user()->username;

            // Menghasilkan out_no secara otomatis untuk setiap aset
            $maxMoveoutId = MasterStockOpnameModel::max('out_no');
            $out_no_base = $maxMoveoutId ? $maxMoveoutId + 1 : 1;

            // Menyimpan data moveout ke database
            $moveout->out_no = $out_no_base; // Set out_no untuk pertama
            // Menghasilkan out_id secara otomatis
            $moveout->out_id = str_pad($out_no_base, 2, '0', STR_PAD_LEFT) . '-01-' . Carbon::now()->format('mY'); // Misal, untuk out_id
            
            $moveout->save(); // Simpan moveout

            // Loop melalui aset untuk menyimpan detail
            foreach ($request->input('asset_id') as $index => $assetId) {
                // Menghasilkan out_det_id secara otomatis
                $out_det_id = str_pad($out_no_base, 2, '0', STR_PAD_LEFT) . '-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT) . '-' . Carbon::now()->format('mY');

                // Simpan data detail untuk aset
                DB::table('t_out_detail')->insert([
                    'out_det_id' => $out_det_id,  // Menggunakan out_det_id yang dihasilkan
                    'out_id' => $moveout->out_id,  // Menggunakan out_id yang dihasilkan
                    'asset_id' => $assetId,
                    'asset_tag' => $request->input('register_code')[$index],
                    'serial_number' => $request->input('serial_number')[$index],
                    'brand' => $request->input('merk')[$index],
                    'qty' => $request->input('qty')[$index],
                    'uom' => $request->input('satuan')[$index],
                    'condition' => $request->input('condition_id')[$index],
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Data moveout berhasil ditambahkan',
                'redirect_url' => route('Admin.stockopname')
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
            'data' => ['MoveOutId' => '12345']
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

    public function updateDataStockOpname(Request $request, $id)
    {
        // Temukan data yang akan diupdate
        $opnameDetail = OpnameDetails::where('opname_id', $id)->first();

        if (!$opnameDetail) {
            return response()->json(['message' => 'Data not found'], 404);
        }
    
        // Ambil qty_physical dari input
        $opnameDesc = $request->input('opname_desc');
        $soId = $request->input('so_id');
        $conditionId = $request->input('condition_id');
        $image = $request->input('image');
        
            $baseDir = public_path('assets/images/SO');
            $locDir = $baseDir . '/' . $request->input('loc_id');

            if (!file_exists($locDir)) {
                mkdir($locDir, 0777, true); // Create folder with permission
            }

            $filePaths = []; // Initialize an array to hold multiple file paths
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName(); // Add timestamp to filename
                    $file->move($locDir, $fileName); // Move the file to the location
                    $filePaths[] = "assets/images/SO/{$request->input('loc_id')}/" . $fileName; // Save path
                }
            }
    
        // Update data dengan opname_desc, qty_onhand tetap, dan qty_difference yang baru dihitung
        $opnameDetail->update([
            'condition_id' => $conditionId,
            'image' => $image
        ]);

        $opnameHeader = MasterStockOpnameModel::where('opname_id', $id)->first();

        if ($opnameHeader) {
            // Update kolom is_verify di tabel header
            $opnameHeader->update([
                'opname_desc' => $opnameDesc,
                'so_id' => $soId,
                'condition' => $conditionId
            ]);
        }
    
        return response()->json([
            'status' => 'success',
            'message' => 'Data moveout berhasil diubah',
            'redirect_url' => route('Admin.stockopname') // Pastikan ini sesuai dengan rute yang ada
        ]);
    }
    

    public function updateDataAdjustStock(Request $request, $id)
    {
        // Temukan data yang akan diupdate
        $opnameDetail = OpnameDetails::where('opname_id', $id)->first();

        if (!$opnameDetail) {
            return response()->json(['message' => 'Data not found'], 404);
        }
    
        // Ambil qty_physical dari input
        $qtyPhysical = $request->input('qty_physical');
        $qtyOnHand = $request->input('qty_physical');
    
        // Lakukan perhitungan untuk qty_difference
        $qtyDifference = $qtyOnHand - $qtyPhysical;
    
        // Update data dengan qty_physical, qty_onhand tetap, dan qty_difference yang baru dihitung
        $opnameDetail->update([
            'qty_physical' => $qtyPhysical,
            'qty_difference' => $qtyDifference,
            'qty_onhand' => $qtyOnHand,
        ]);

        $assetId = $opnameDetail->asset_id; // Assuming asset_id is in opname details
        DB::table('table_registrasi_asset')
        ->where('asset_id', $assetId)
        ->update(['qty' => $qtyOnHand]); // Update qty_onhand with the new quantity

        $opnameHeader = MasterStockOpnameModel::where('opname_id', $id)->first();

        if ($opnameHeader) {
            // Update kolom is_verify di tabel header
            $opnameHeader->update([
                'is_verify' => 1,
            ]);
        }
    
        return response()->json([
            'status' => 'success',
            'message' => 'Data moveout berhasil diubah',
            'redirect_url' => route('Admin.adjuststock') // Pastikan ini sesuai dengan rute yang ada
        ]);
    }

    public function edit($id)
    {
        $moveout = MasterStockOpnameModel::with('asset')->findOrFail($id); // Assuming MoveOut has a relationship with Asset
        return response()->json($moveout);
    }

    public function deleteDataStockOpname($id)
    {
        $moveout = MasterStockOpnameModel::find($id);

        if ($moveout) {
            // Set is_active to 0 instead of deleting the record
            $moveout->is_active = 0;
            $moveout->deleted_at = Carbon::now();
            $moveout->delete(); // Save the changes to the database

            return response()->json([
                'status' => 'success', 
                'message' => 'MoveOut deactivated successfully.', // Updated message for clarity
                'redirect_url' => url('/admin/stockopname'),
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Data MoveOut not found.'], 404);
        }
    }

    public function deleteDataAdjustStock($id)
    {
        $moveout = MasterStockOpnameModel::find($id);

        if ($moveout) {
            // Set is_active to 0 instead of deleting the record
            $moveout->is_active = 0;
            $moveout->deleted_at = Carbon::now(); 
            $moveout->delete(); // Save the changes to the database

            return response()->json([
                'status' => 'success', 
                'message' => 'MoveOut deactivated successfully.', // Updated message for clarity
                'redirect_url' => route('Admin.adjuststock')
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Data MoveOut not found.'], 404);
        }
    }


    public function details($MoveOutId)
    {
        $moveout = MasterStockOpnameModel::where('out_id', $MoveOutId)->first();

        if (!$moveout) {
            abort(404, 'move$moveout not found');
        }

        return view('move$moveout.details', ['asset' => $moveout]);
    }

    public function ImportDataStockOpname(Request $request) {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new class extends MasterStockOpnameImport {
                public function model(array $row){

                    $opnameId = $row['opname_id'];
                    $opnameNo = $row['opname_no'];
                    $barangOpname = $row['barang_opname'];
                    $locId = $row['loc_id'];
                    $soId = $row['so_id'];
                    $opnameDesc = $row['opname_desc'];
                    $createDate = $row['create_date'];
                    $createdBy = $row['created_by'];
                    $modifiedDate = $row['modified_date'];
                    $modifiedBy = $row['modified_by'];
                    $isVerify = $row['is_verify'];
                    $isActive = $row['is_active'];
                    $userVerify = $row['user_verify'];                
                }
            });
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
        return back()->withSuccess('File imported successfully.');
    }

    public function filter(Request $request)
{
    // Validate input dates
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    // Get input dates
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Convert the dates to Carbon instances and ensure they are in the correct format
    $startDate = \Carbon\Carbon::parse($startDate)->startOfDay();  // 2024-11-06 00:00:00
    $endDate = \Carbon\Carbon::parse($endDate)->endOfDay();        // 2024-11-06 23:59:59

    // Query to filter based on create_date
    $results = MasterStockOpnameModel::whereBetween('create_date', [$startDate, $endDate]);

    // Execute the query and get the results
    $results = $results->get();

    // Additional data for view
    $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
    $restos = DB::table('master_resto')->select('store_code', 'resto')->get();
    $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
    $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
    $username = auth()->user()->username;
    $locId = DB::table('m_people')->where('nip', $username)->value('loc_id');
    
    $registerLocation = DB::table('master_resto')
        ->where('store_code', $locId)
        ->value('resto');

    $assets = DB::table('table_registrasi_asset')
        ->select('id', 'asset_name')
        ->where('location_now', $registerLocation)
        ->where('qty', '>', 0) 
        ->get();

    // Paginated moveouts query
    $moveouts = DB::table('t_opname_header')
        ->leftjoin('t_opname_detail', 't_opname_header.opname_id', '=', 't_opname_detail.opname_id')
        ->leftjoin('m_condition', 'm_condition.condition_id', '=', 't_opname_detail.condition_id')
        ->leftjoin('m_uom', 'm_uom.uom_id', '=', 't_opname_detail.uom')
        ->select('t_opname_header.*', 't_opname_detail.*', 'm_condition.condition_name', 'm_uom.uom_name')
        ->where('t_opname_header.is_active', '=', '1')
        ->paginate(10);

    // Return the filtered results with additional data for the view
    return view('Admin.stockopname', [
        'results' => $results,
        'reasons' => $reasons,
        'conditions' => $conditions,
        'moveouts' => $moveouts,
        'locId' => $locId,
        'assets' => $assets
    ]);
}

    
    public function ExportPDFStockOpname($id) {
        $opnames = DB::table('t_opname_header')
            ->select(
                't_opname_header.*',
                't_opname_detail.*',
                'fromResto.store_code as origin_site',
                'table_registrasi_asset.asset_name',
                'table_registrasi_asset.register_code',
                'table_registrasi_asset.serial_number',
                'm_assets.asset_model',
                'm_category.cat_name',
                'm_reason.reason_name',
                'm_condition.condition_name'
                )
            ->join('t_opname_detail', 't_opname_header.opname_id', '=', 't_opname_detail.opname_id')
            ->leftJoin('master_resto_v2 as fromResto', 't_opname_header.loc_id', '=', 'fromResto.id')
            ->join('table_registrasi_asset', 't_opname_detail.asset_id', '=', 'table_registrasi_asset.id')
            ->join('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
            ->join('m_condition', 't_opname_detail.condition', '=', 'm_condition.condition_id')
            ->join('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
            ->leftJoin('m_reason', 't_opname_header.opname_reason_id', '=', 'm_reason.reason_id')
            ->where('t_opname_header.opname_id', $id)
            ->get();

            $firstRecord = $opnames->first();

            if (!$firstRecord) {

                abort(404, 'MoveOut not found');
    
            }
    
    
        $pdf = Pdf::loadView('Admin.export_pdf.stockopname_pdf', compact('opnames', 'firstRecord'));
    
        return $pdf->download('report-stockopname.pdf');
    }
    

    public function HalamanAddDataStockOpname() {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();

        $restos = DB::table('master_resto_v2')->select('id', 'store_code', 'name_store_street')->get();

        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();

        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();

        $reasons = DB::table('m_reason')->select('reason_id','reason_name')->get();

        $username = auth()->user()->username;

        $fromLoc = DB::table('m_user')

                ->where('username', $username)

                ->value('location_now');



        $registerLocation = DB::table('master_resto_v2')

                ->where('name_store_street', $fromLoc)

                ->value('name_store_street');

    

        // Filter assets based on the location_now matching the fetched resto

        $assets = DB::table('table_registrasi_asset')

            ->select('id', 'asset_name')

            // ->where('register_location', $registerLocation)

            ->where('qty', '>', 0) 

            ->get();        



        $moveoutsQuery = DB::table('t_out')

            ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')

            ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')

            ->where('t_out.is_active', 1)

            ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name');



        // // Apply date range filter if provided

        // if ($request->filled('start_date') && $request->filled('end_date')) {

        //     $startDate = $request->input('start_date') . ' 00:00:00'; // mulai dari awal hari

        //     $endDate = $request->input('end_date') . ' 23:59:59'; // sampai akhir hari

        //     $moveoutsQuery->whereBetween('t_out.out_date', [$startDate, $endDate]);

        // }

    

        // Paginate the results

        $moveouts = $moveoutsQuery->paginate(10);



        return view('Admin.stock_opname.add_data_stock_opname',[
            
            'fromLoc' => $fromLoc,

            'reasons' => $reasons,

            'assets' => $assets,
            
            'conditions' => $conditions,

            'moveouts' => $moveouts,

            'restos' => $restos
        ]);
    }

    public function HalamanEditDataStockOpname() {

        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();

        $restos = DB::table('master_resto_v2')->select('id', 'store_code', 'name_store_street')->get();

        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();

        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();

        

        $username = auth()->user()->username;

        $fromLoc = DB::table('m_user')

                ->where('username', $username)

                ->value('location_now');



        $registerLocation = DB::table('master_resto_v2')

                ->where('name_store_street', $fromLoc)

                ->value('name_store_street');

    

        // Filter assets based on the location_now matching the fetched resto

        $assets = DB::table('table_registrasi_asset')

            ->select('id', 'asset_name')

            // ->where('register_location', $registerLocation)

            ->where('qty', '>', 0) 

            ->get();        



        $moveoutsQuery = DB::table('t_out')

            ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')

            ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')

            ->where('t_out.is_active', 1)

            ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name');



        // // Apply date range filter if provided

        // if ($request->filled('start_date') && $request->filled('end_date')) {

        //     $startDate = $request->input('start_date') . ' 00:00:00'; // mulai dari awal hari

        //     $endDate = $request->input('end_date') . ' 23:59:59'; // sampai akhir hari

        //     $moveoutsQuery->whereBetween('t_out.out_date', [$startDate, $endDate]);

        // }

    

        // Paginate the results

        $moveouts = $moveoutsQuery->paginate(10);

        return view('Admin.stock_opname.edit_data_stock_opname', [
            'fromLoc' => $fromLoc,

            'reasons' => $reasons,

            'assets' => $assets,
            
            'conditions' => $conditions,

            'moveouts' => $moveouts,

            'restos' => $restos
        ]);
    }


    public function GetCodeStockOpname(Request $request) {
    
        $trx_code = DB::table('t_trx')->where('trx_name', 'Stock Opname')->value('trx_code');
        $today = Carbon::now()->format('ymd');
        $todayCount = MasterStockOpnameModel::whereDate('create_date', Carbon::now())->count() + 1;
        $random_number = rand(1, 999); 
        $random_number = str_pad($random_number, 3, '0', STR_PAD_LEFT);
        $stock_opname_code = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('loc_id')}.{$random_number}";
        

   
    return response()->json(['trx_code' => $stock_opname_code]);
    }
    

    public function getAjaxDataAssetsStockOpname() {
        $assets = DB::table('table_registrasi_asset')
        ->select(
            'table_registrasi_asset.id',
            'table_registrasi_asset.register_code',
            'table_registrasi_asset.serial_number',
            'table_registrasi_asset.register_date',
            'table_registrasi_asset.purchase_date',
            'table_registrasi_asset.approve_status',
            'table_registrasi_asset.serial_number',
            'm_assets.asset_model',
            'm_type.type_name',
            'm_category.cat_name',
            'm_priority.priority_name',
            'm_brand.brand_name',
            'm_brand.brand_id',
            'm_uom.uom_name',
            'm_uom.uom_id',
            'master_resto_v2.name_store_street',
            'm_layout.layout_name',
            'm_supplier.supplier_name',
            'm_condition.condition_name',
            'm_warranty.warranty_name',
            'm_periodic_mtc.periodic_mtc_name',
            'table_registrasi_asset.deleted_at',
            'table_registrasi_asset.qty as asset_qty',
            't_out_detail.qty as out_detail_qty',
            DB::raw('(table_registrasi_asset.qty + t_out_detail.qty) as total_qty')
        )
        ->leftJoin('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
        ->leftJoin('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
        ->leftJoin('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
        ->leftJoin('m_priority', 'table_registrasi_asset.prioritas', '=', 'm_priority.priority_code')
        ->leftJoin('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
        ->leftJoin('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
        ->leftJoin('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
        ->leftJoin('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
        ->leftJoin('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
        ->leftJoin('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
        ->leftJoin('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
        ->leftJoin('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
        ->leftJoin('t_out_detail', 'table_registrasi_asset.id', '=', 't_out_detail.asset_id')
        ->where('table_registrasi_asset.qty', '>', 0)
        ->get();
    
        
        return response()->json($assets);
        }


        public function getAjaxAssetDetailsStockOpname($id)
        {
            $asset = DB::table('table_registrasi_asset')
                ->select(
                    'table_registrasi_asset.id',
                    'table_registrasi_asset.register_code',
                    'table_registrasi_asset.serial_number',
                    'table_registrasi_asset.register_date',
                    'table_registrasi_asset.purchase_date',
                    'table_registrasi_asset.approve_status',
                    'table_registrasi_asset.serial_number',
                    'table_registrasi_asset.qty as asset_qty',
                    't_out_detail.qty as out_detail_qty',
                    DB::raw('(table_registrasi_asset.qty + t_out_detail.qty) as total_qty'),
                    'm_assets.asset_model',
                    'm_type.type_name',
                    'm_category.cat_name',
                    'm_priority.priority_name',
                    'm_brand.brand_name',
                    'm_brand.brand_id',
                    'm_uom.uom_name',
                    'm_uom.uom_id',
                    'master_resto_v2.name_store_street',
                    'm_layout.layout_name',
                    'm_supplier.supplier_name',
                    'm_condition.condition_name',
                    'm_condition.condition)id',
                    'm_warranty.warranty_name',
                    'm_periodic_mtc.periodic_mtc_name',
                    'table_registrasi_asset.deleted_at'
                )
                ->leftJoin('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
                ->leftJoin('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
                ->leftJoin('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
                ->leftJoin('m_priority', 'table_registrasi_asset.prioritas', '=', 'm_priority.priority_code')
                ->leftJoin('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
                ->leftJoin('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
                ->leftJoin('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
                ->leftJoin('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
                ->leftJoin('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
                ->leftJoin('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
                ->leftJoin('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
                ->leftJoin('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
                ->leftJoin('t_out_detail', 'table_registrasi_asset.id', '=', 't_out_detail.asset_id') // Join with t_out_detail
                ->where('table_registrasi_asset.qty', '>', 0)
                ->where('table_registrasi_asset.id', $id)
                ->first();
        
            if ($asset) {
                return response()->json($asset);
            } else {
                return response()->json(['error' => 'Asset not found'], 404);
            }
        }        

    public function GetDetailDataStockOpname($id) {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $uoms = DB::table('m_uom')->select('uom_id', 'uom_name')->get();
        $restos = DB::table('master_resto_v2')->select('id', 'store_code', 'name_store_street')->get();
        
        
        $username = auth()->user()->username;
        $locId = DB::table('m_people')->where('nip', $username)->value('loc_id');
    
        $moveout = DB::table('t_opname_header')
        ->select('t_opname_header.*', 'master_resto_v2.name_store_street AS location_now', 'master_resto_v2.id AS resto_id', 't_opname_detail.qty_onhand', 't_opname_detail.qty_physical', 't_opname_detail.register_code', 'm_uom.uom_name', 't_opname_header.deleted_at',
            'm_reason.reason_id','m_reason.reason_name'
        )
        ->join('master_resto_v2', 't_opname_header.loc_id', '=', 'master_resto_v2.id')
        ->join('t_opname_detail', 't_opname_header.opname_id', '=', 't_opname_detail.opname_id')
        ->join('m_reason', 't_opname_header.opname_reason_id', '=', 'm_reason.reason_id')
        ->join('m_uom', 't_opname_detail.uom', '=', 'm_uom.uom_id')
        ->where('t_opname_header.opname_id', $id)
        ->where('t_opname_header.is_active', '=', '1')
        ->first();

        return view('Admin.stock_opname.detail_data_stock_opname', compact('moveout', 'restos', 'reasons', 'conditions'));
    }

    public function GetDetailDataStockOpnameDetails($outId) {
        $details = DB::table('t_opname_header')
        ->select(
            't_opname_header.*',
            't_opname_detail.*',
            'table_registrasi_asset.register_code',
            'table_registrasi_asset.qty',
            'm_uom.uom_name',
            'm_condition.condition_name',
            'm_uom.uom_id',
            'm_uom.uom_name',
            'm_assets.asset_model',
            'm_brand.brand_id',
            'm_brand.brand_name',
            'table_registrasi_asset.serial_number'
        )

        ->join('t_opname_detail', 't_opname_header.opname_id', '=', 't_opname_detail.opname_id')
        ->join('table_registrasi_asset', 't_opname_detail.asset_id', '=', 'table_registrasi_asset.id')
        ->join('m_assets', 'table_registrasi_asset.id', '=', 'm_assets.asset_id')
        ->leftJoin('m_condition', 't_opname_detail.condition', '=', 'm_condition.condition_id')
        ->leftJoin('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
        ->leftJoin('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
        ->where('t_opname_header.opname_id', $outId)
        ->get();

        $transformedDetails = $details->map(function ($item) {
            $item->image = $item->image;
            return $item;
        });
        return response()->json($transformedDetails);
    }


    public function EditDetailDataStockOpname($id) {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $uoms = DB::table('m_uom')->select('uom_id', 'uom_name')->get();
        $restos = DB::table('master_resto_v2')->select('id', 'store_code', 'name_store_street')->get();
        
        
        $username = auth()->user()->username;
        $locId = DB::table('m_people')->where('nip', $username)->value('loc_id');
    
        $moveout = DB::table('t_opname_header')
        ->select('t_opname_header.*', 'master_resto_v2.name_store_street AS location_now', 'master_resto_v2.id AS resto_id', 't_opname_detail.qty_onhand', 't_opname_detail.qty_physical', 't_opname_detail.register_code', 'm_uom.uom_name', 't_opname_header.deleted_at',
            'm_reason.reason_id',
            'm_reason.reason_name',
            'm_condition.condition_id', // Add this line
            'm_condition.condition_name',
        )
        ->join('master_resto_v2', 't_opname_header.loc_id', '=', 'master_resto_v2.id')
        ->join('t_opname_detail', 't_opname_header.opname_id', '=', 't_opname_detail.opname_id')
        ->join('m_reason', 't_opname_header.opname_reason_id', '=', 'm_reason.reason_id')
        ->join('m_uom', 't_opname_detail.uom', '=', 'm_uom.uom_id')
        ->leftJoin('m_condition', 't_opname_detail.condition', '=', 'm_condition.condition_id')
        ->where('t_opname_header.opname_id', $id)
        ->where('t_opname_header.is_active', '=', '1')
        ->first();

        return view('Admin.stock_opname.edit_data_stock_opname', compact('moveout', 'restos', 'reasons', 'conditions'));
    }



    
    public function UpdateDetailDataStockOpname(Request $request, $id) {
        try {
            \Log::info('Request Data:', $request->all());
    
            $request->validate([
                'loc_id' => 'required',
                'opname_date' => 'required',
                'opname_reason_id' => 'required',
                'verify' => 'required',
                'opname_desc' => 'required',
                'asset_details' => 'required|json'
            ]);
    
            DB::beginTransaction();
    
            // Update header
            $updated = DB::table('t_opname_header')
                ->where('opname_id', '=', $id)
                ->update([
                    'loc_id' => $request->loc_id,
                    'opname_date' => $request->opname_date,
                    'opname_reason_id' => $request->opname_reason_id,
                    'verify' => $request->verify,
                    'opname_desc' => $request->opname_desc,
                    'updated_at' => now()
                ]);
    
            if (!$updated) {
                throw new \Exception('Failed to update stock opname header');
            }
    
            // Update asset details
            $assetDetails = json_decode($request->asset_details, true);
            foreach ($assetDetails as $detail) {
                $updatedDetail = DB::table('t_opname_detail')
                    ->where('opname_id', '=', $id)
                    ->where('asset_id', '=', $detail['asset_id'])
                    ->update([
                        'qty_onhand' => $detail['qty_onhand'],
                        'qty_physical' => $detail['qty_physical'],
                        'condition' => $detail['condition_id'] ? (int) $detail['condition_id'] : null,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
    
                if (!$updatedDetail) {
                    \Log::warning('Failed to update asset detail for asset_id: ' . $detail['asset_id']);
                }
            }
    
            DB::commit();
            return response()->json([
                'status' => 'success', 
                'message' => 'Stock opname updated successfully'
            ]);
    
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Stock Opname Update Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update stock opname: ' . $e->getMessage()
            ], 500);
        }
    }
//     public function UpdateDetailDataStockOpname(Request $request, $id)
//     {
//         $request->validate([
//             'loc_id' => 'required',
//             'opname_date' => 'required',
//             'opname_reason_id' => 'required',
//             'verify' => 'required',
//             'opname_desc' => 'required',
//         ]);
    
//         $stockopname = DB::table('t_opname_header')
//             ->where('opname_id', $id)
//             ->update([
//                 'loc_id' => $request->input('loc_id'),
//                 'opname_date' => $request->input('opname_date'),
//                 'opname_reason_id' => $request->input('opname_reason_id'),
//                 'verify' => $request->input('verify'),
//                 'opname_desc' => $request->input('opname_desc'),
//             ]);
    
//         if (!$stockopname) {
//             return response()->json(['status' => 'error', 'message' => 'No changes were made to the MoveOut record.'], 500);
//         }
    
//         foreach ($request->input('asset_id') as $index => $assetId) {
//             $imagePath = null;
    
//             if ($request->hasFile("image.$index") && $request->file("image.$index")->isValid()) {
//                 $imagePath = $request->file("image.$index")->store('stock_opname/images', 'public');
//             }
    
//             $moveoutQty = $request->input('qty')[$index];
    
//             $existingDetail = DB::table('t_opname_detail')
//                 ->where('opname_id', $id)
//                 ->where('asset_id', $assetId)
//                 ->first();
    
//             if ($existingDetail) {
//                 // Update the existing detail record
//                 DB::table('t_opname_detail')
//                     ->where('opname_det_id', $existingDetail->opname_det_id)
//                     ->update([
//                         'asset_id' => $assetId,
//                         'serial_number' => $request->input('serial_number')[$index],
//                         'brand' => $request->input('merk')[$index],
//                         'qty' => $moveoutQty,
//                         'uom' => $request->input('satuan')[$index],
//                         'condition' => $request->input('condition_id')[$index],
//                         'image' => $imagePath ?: $existingDetail->image,
//                         'updated_at' => now(),
//                     ]);
    
//                 // Decrement the quantity in the asset registration table
//                 // DB::table('table_registrasi_asset')
//                 //     ->where('id', $assetId)
//                 //     ->decrement('qty', $moveoutQty);
//             } else {
//                 // Insert a new detail record
//                 DB::table('t_opname_detail')->insert([
//                     'opname_det_id' => $request->input('opname_det_id')[$index],
//                     'opname_id' => $id,
//                     'asset_id' => $assetId,
//                     'serial_number' => $request->input('serial_number')[$index],
//                     'brand' => $request->input('merk')[$index],
//                     'qty' => $moveoutQty,
//                     'uom' => $request->input('satuan')[$index],
//                     'condition' => $request->input('condition_id')[$index],
//                     'image' => $imagePath,
//                     'created_at' => now(),
//                     'updated_at' => now(),
//                 ]);
    
//                 // Decrement the quantity in the asset registration table
//             //     DB::table('table_registrasi_asset')
//             //         ->where('id', $assetId)
//             //         ->decrement('qty', $moveoutQty);
//             // }
//         }
    
//         return redirect()->to('/admin/stockopname')->with('success', 'MoveOut record updated successfully.');
//     }
// }
    


    public function ImportDataExcelStockOpname(Request $request) 
    {
        ini_set('max_execution_time', 3600);

        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            // Import the Excel file and process each row
            Excel::import(new MasterStockOpnameImport, $request->file('file'));

            // If import is successful, return a success message
            return redirect()->back()->with('success', 'Data imported successfully.');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Import Data. Error: ' . $e->getMessage());
        }
    }


    public function LihatDataAdjusmentStock() {
        return view('Admin.adjustment_stock.lihat_data_adjustment_stock');
    }
}

