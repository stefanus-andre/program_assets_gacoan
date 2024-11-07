<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterStockOpnameModel;
use App\Models\Master\OpnameDetails;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockOpnameController extends Controller
{
    public function Index(Request $request)
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $uoms = DB::table('m_uom')->select('uom_id', 'uom_name')->get();
        // Get current user's location
        $username = auth()->user()->username;
        $locId = DB::table('m_people')
                ->where('nip', $username)
                ->value('loc_id');

        $registerLocation = DB::table('master_resto')
                ->where('store_code', $locId)
                ->value('resto');
        
        // Filter assets based on the register_location matching the fetched resto
        $assets = DB::table('table_registrasi_asset')
            ->select('id', 'asset_name')
            ->where('location_now', $registerLocation)
            ->where('qty', '>', 0)
            ->get();

        // Get start and end dates from the request, or use null if not provided
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        // Query moveouts, applying date filters if provided
        $moveouts = DB::table('t_opname_header')
        ->leftjoin('t_opname_detail', 't_opname_header.opname_id', '=', 't_opname_detail.opname_id')
        ->leftjoin('m_condition', 'm_condition.condition_id', '=', 't_opname_detail.condition_id')
        ->leftjoin('m_uom', 'm_uom.uom_id', '=', 't_opname_detail.uom')
        ->where('t_opname_header.is_active', '=', '1')// Only include active records
        ->when($startDate, function ($query, $startDate) {
            return $query->where('t_opname_header.create_date', '>=', $startDate); // Filter by start date
        })
        ->when($endDate, function ($query, $endDate) {
            return $query->where('t_opname_header.create_date', '<=', $endDate); // Filter by end date
        })
        ->select('t_opname_header.*', 't_opname_detail.*', 'm_condition.condition_name', 'm_uom.uom_name')
        ->get();

        $perPage = 10;
        $currentPage = request()->get('page', 1);
        $paginatedMoveouts = new \Illuminate\Pagination\LengthAwarePaginator(
            $moveouts->forPage($currentPage, $perPage),
            $moveouts->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    
        return view('admin.stockopname', [
            'locId' => $locId,
            'reasons' => $reasons,
            'approvals' => $approvals,
            'assets' => $assets,
            'conditions' => $conditions,
            'uoms' => $uoms,
            'moveouts' => $paginatedMoveouts
        ]);
    }

    public function IndexA(Request $request)
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $uoms = DB::table('m_uom')->select('uom_id', 'uom_name')->get();
    
        // Get current user's location
        $username = auth()->user()->username;
        $locId = DB::table('m_people')
                ->where('nip', $username)
                ->value('loc_id');

        $registerLocation = DB::table('master_resto')
                ->where('store_code', $locId)
                ->value('resto');
        
        // Filter assets based on the register_location matching the fetched resto
        $assets = DB::table('table_registrasi_asset')
            ->select('id', 'asset_name')
            ->where('location_now', $registerLocation)
            ->where('qty', '>', 0)
            ->get();

        // Get start and end dates from the request, or use null if not provided
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        // Query moveouts, applying date filters if provided
        $moveouts = DB::table('t_opname_header')
        ->leftjoin('t_opname_detail', 't_opname_header.opname_id', '=', 't_opname_detail.opname_id')
        ->leftjoin('m_condition', 'm_condition.condition_id', '=', 't_opname_detail.condition_id')
        ->leftjoin('m_uom', 'm_uom.uom_id', '=', 't_opname_detail.uom')
        ->select('t_opname_header.*', 't_opname_detail.*', 'm_condition.condition_name', 'm_uom.uom_name')
        ->where('t_opname_header.is_active', '=', '1')
        ->when($startDate, function ($query, $startDate) {
            return $query->where('t_opname_header.create_date', '>=', $startDate); // Filter by start date
        })
        ->when($endDate, function ($query, $endDate) {
            return $query->where('t_opname_header.create_date', '<=', $endDate); // Filter by end date
        })
        ->select('t_opname_header.*', 't_opname_detail.*', 'm_condition.condition_name', 'm_uom.uom_name')
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
    
        return view('admin.adjuststock', [
            'locId' => $locId,
            'reasons' => $reasons,
            'approvals' => $approvals,
            'assets' => $assets,
            'conditions' => $conditions,
            'uoms' => $uoms,
            'moveouts' => $paginatedMoveouts
        ]);
    }

    public function HalamanStockOpname() 
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
                
        $registerLocation = DB::table('master_resto')
                ->where('store_code', $locId)
                ->value('resto');
    
        // Filter assets based on the location_now matching the fetched resto
        $assets = DB::table('table_registrasi_asset')
            ->select('id', 'asset_name')
            ->where('location_now', $registerLocation)
            ->where('qty', '>', 0) 
            ->get();       
    
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
    
        return view('admin.stockopname', [
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
                
        $registerLocation = DB::table('master_resto')
                ->where('store_code', $locId)
                ->value('resto');
    
        // Filter assets based on the location_now matching the fetched resto
        $assets = DB::table('table_registrasi_asset')
            ->select('id', 'asset_name')
            ->where('location_now', $registerLocation)
            ->where('qty', '>', 0) 
            ->get();       
    
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
    
        return view('admin.adjuststock', [
            'locId' => $locId,
            'reasons' => $reasons,
            'approvals' => $approvals,
            'assets' => $assets,
            'conditions' => $conditions,
            'uoms' => $uoms,
            'moveouts' => $paginatedMoveouts
        ]);
    }
    
    public function filter(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
    
        // Ambil input tanggal dari request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Ubah tanggal menjadi waktu mulai (00:00:00) dan akhir (23:59:59)
        $startDate = \Carbon\Carbon::parse($startDate)->startOfDay();  // 2024-11-06 00:00:00
        $endDate = \Carbon\Carbon::parse($endDate)->endOfDay();        // 2024-11-06 23:59:59
    
        // Query untuk filter berdasarkan create_date
        $results = MasterStockOpnameModel::whereBetween('create_date', [$startDate, $endDate]);
        
        // Eksekusi query dan ambil hasilnya
        $results = $results->get();

        // Ambil data lain yang dibutuhkan untuk tampilan
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $restos = DB::table('master_resto')->select('store_code', 'resto')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $username = auth()->user()->username;
        $locId = DB::table('m_people')
            ->where('nip', $username)
            ->value('loc_id');
        
        $registerLocation = DB::table('master_resto')
            ->where('store_code', $locId)
            ->value('resto');

        $assets = DB::table('table_registrasi_asset')
            ->select('id', 'asset_name')
            ->where('location_now', $registerLocation)
            ->where('qty', '>', 0) 
            ->get();

        // Ambil data lain yang dibutuhkan untuk tampilan
        
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();

        $moveouts = DB::table('t_opname_header')
        ->leftjoin('t_opname_detail', 't_opname_header.opname_id', '=', 't_opname_detail.opname_id')
        ->leftjoin('m_condition', 'm_condition.condition_id', '=', 't_opname_detail.condition_id')
        ->leftjoin('m_uom', 'm_uom.uom_id', '=', 't_opname_detail.uom')
        ->select('t_opname_header.*', 't_opname_detail.*', 'm_condition.condition_name', 'm_uom.uom_name')
        ->where('t_opname_header.is_active', '=', '1')
        ->paginate(10);
        
        // Paginate the results

        // Kembalikan hasil filter dan data lainnya ke tampilan Blade
        return view('admin.stockopname', [
            'results' => $results,
            'reasons' => $reasons,
            'conditions' => $conditions,
            'moveouts' => $moveouts,
            'locId' => $locId,
            'assets' => $assets
        ]);
    }

    public function filterA(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
    
        // Ambil input tanggal dari request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Ubah tanggal menjadi waktu mulai (00:00:00) dan akhir (23:59:59)
        $startDate = \Carbon\Carbon::parse($startDate)->startOfDay();  // 2024-11-06 00:00:00
        $endDate = \Carbon\Carbon::parse($endDate)->endOfDay();        // 2024-11-06 23:59:59
    
        // Query untuk filter berdasarkan create_date
        $results = MasterStockOpnameModel::whereBetween('create_date', [$startDate, $endDate]);
        
        // Eksekusi query dan ambil hasilnya
        $results = $results->get();

        // Ambil data lain yang dibutuhkan untuk tampilan
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $restos = DB::table('master_resto')->select('store_code', 'resto')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $username = auth()->user()->username;
        $locId = DB::table('m_people')
            ->where('nip', $username)
            ->value('loc_id');
        
        $registerLocation = DB::table('master_resto')
            ->where('store_code', $locId)
            ->value('resto');

        $assets = DB::table('table_registrasi_asset')
            ->select('id', 'asset_name')
            ->where('location_now', $registerLocation)
            ->where('qty', '>', 0) 
            ->get();

        // Ambil data lain yang dibutuhkan untuk tampilan
        
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();

        $moveouts = DB::table('t_opname_header')
        ->leftjoin('t_opname_detail', 't_opname_header.opname_id', '=', 't_opname_detail.opname_id')
        ->leftjoin('m_condition', 'm_condition.condition_id', '=', 't_opname_detail.condition_id')
        ->leftjoin('m_uom', 'm_uom.uom_id', '=', 't_opname_detail.uom')
        ->select('t_opname_header.*', 't_opname_detail.*', 'm_condition.condition_name', 'm_uom.uom_name')
        ->where('t_opname_header.is_active', '=', '1')
        ->paginate(10);
        
        // Paginate the results

        // Kembalikan hasil filter dan data lainnya ke tampilan Blade
        return view('admin.adjuststock', [
            'results' => $results,
            'reasons' => $reasons,
            'conditions' => $conditions,
            'moveouts' => $moveouts,
            'locId' => $locId,
            'assets' => $assets
        ]);
    }

    public function previewPDF($opname_id)
    {
        // Ambil data berdasarkan out_id
        $data = DB::table('t_opname_header')
            ->join('t_opname_detail', 't_opname_header.opname_id', '=', 't_opname_detail.opname_id')
            ->leftJoin('master_resto as origin', 't_opname_header.loc_id', '=', 'origin.store_code')
            ->leftJoin('table_registrasi_asset', 't_opname_detail.asset_id', '=', 'table_registrasi_asset.id')
            ->leftJoin('m_condition', 't_opname_detail.condition_id', '=', 'm_condition.condition_id')
            ->leftJoin('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_id')
            ->leftJoin('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_id')
            ->where('t_opname_header.opname_id', $opname_id)
            ->select(
                't_opname_header.*', 
                't_opname_detail.*', 
                'origin.resto as origin_store_code', 
                'table_registrasi_asset.asset_name', 
                'table_registrasi_asset.category_asset', 
                'table_registrasi_asset.serial_number', 
                'table_registrasi_asset.type_asset',
                'm_condition.condition_name',
                'm_type.type_name',
                'm_category.cat_name'
            )
            ->first();

        // Jika data tidak ditemukan, tampilkan halaman 404
        if (!$data) {
            abort(404, 'MoveOut not found');
        }

        // Buat PDF menggunakan data yang ditemukan
        $pdf = Pdf::loadView('Admin.pdf-moveout', compact('data'));

        return response($pdf->output(), 200)->header('Content-Type', 'application/pdf');
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
        // Validasi data yang dikirimkan
        $request->validate([
            'loc_id' => 'required|string|max:255',
            'opname_desc' => 'required|string|max:255',
            'so_id' => 'required|integer',
            'asset_id' => 'required|array',
            'register_code' => 'required|array',
            'qty' => 'required|array',
            'satuan' => 'required|array',
            'condition_id' => 'required|array',
            'qty_physical' => 'required|array',
            'image.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        try {
            // Buat instance dari model MasterStockOpnameModel
            $moveout = new MasterStockOpnameModel();
            $moveout->loc_id = $request->input('loc_id');
            $moveout->opname_desc = $request->input('opname_desc');
            $moveout->so_id = $request->input('so_id');
            $moveout->is_active = '1';
            $moveout->is_verify = '0';
            $moveout->create_by = Auth::user()->username;

            // Menghasilkan opname_no secara otomatis
            $maxMoveoutId = MasterStockOpnameModel::max('opname_no');
            $opname_no_base = $maxMoveoutId ? $maxMoveoutId + 1 : 1;
            $moveout->opname_no = $opname_no_base; // Set opname_no untuk pertama

            // Ambil trx_code dari tabel t_trx berdasarkan trx_name = 'STOCK OPNAME'
            $trx_code = DB::table('t_trx')->where('trx_name', 'Stock Opname')->value('trx_code');

            // Format yymmdd untuk tanggal hari ini
            $today = Carbon::now()->format('ymd');

            // Hitung urutan nomor transaksi untuk hari ini
            $todayDate = Carbon::now()->format('Y-m-d');
            $todayCount = MasterStockOpnameModel::whereDate('create_date', $todayDate)->count() + 1;
            $transaction_number = str_pad($todayCount, 3, '0', STR_PAD_LEFT); // Format as 001, 002, etc.

            // Format opname_id
            $moveout->opname_id = "{$trx_code}.{$today}.{$request->input('so_id')}.{$request->input('loc_id')}.{$transaction_number}";
            $moveout->save(); // Simpan moveout

            // Handle file upload
            $baseDir = public_path('assets/images/SO');
            $locDir = $baseDir . '/' . $request->input('loc_id');

            if (!file_exists($locDir)) {
                mkdir($locDir, 0777, true); // Create folder with permission
            }

            $fileIndex = 1;
            

            // Loop through assets to save detail
            foreach ($request->input('asset_id') as $index => $assetId) {
                $qty_onhand = $request->input('qty')[$index] ?? 0;
                $qty_physical = $request->input('qty_physical')[$index] ?? 0;
                $qty_difference = $qty_onhand - $qty_physical;
                $trx_code = DB::table('t_trx')->where('trx_name', 'Stock Opname')->value('trx_code');
            
                // Format yymmdd untuk tanggal hari ini
                $today = Carbon::now()->format('ymd');
            
                // Get the last transaction number used for today from opname_id
                $lastTransaction = DB::table('t_opname_detail')
                    ->where('opname_id', 'like', "{$trx_code}.{$today}.%") // Filter by opname_id format
                    ->orderBy('opname_id', 'desc')
                    ->first();
            
                // Calculate the next transaction number
                if ($lastTransaction) {
                    // Extract the last transaction number from the opname_id
                    $lastOpnameId = $lastTransaction->opname_id;
                    preg_match('/\.(\d{3})$/', $lastOpnameId, $matches);
                    $transaction_number = isset($matches[1]) ? intval($matches[1]) + 1 : 1; // Increment the last number or start with 1
                } else {
                    $transaction_number = 1; // Start with 1 if no transaction found
                }
                
                $transaction_number_str = str_pad($transaction_number, 3, '0', STR_PAD_LEFT); // Format as 001, 002, etc.
            
                // Format opname_id untuk setiap detail
                $opname = "{$trx_code}.{$today}.{$request->input('so_id')}.{$request->input('loc_id')}.{$transaction_number_str}";
            
                $filePath = null;

                if ($request->hasFile('image') && isset($request->file('image')[$index])) {
                    $file = $request->file('image')[$index];
                
                    if ($file->isValid()) { // Check if f ile is valid
                        $fileName = "{$opname}-{$transaction_number_str}." . $file->getClientOriginalExtension();
                
                        try {
                            $file->move($locDir, $fileName);
                            $filePath = "assets/images/SO/{$request->input('loc_id')}/" . $fileName;
                        } catch (\Exception $e) {
                            return response()->json(['status' => 'error', 'message' => 'File move failed: ' . $e->getMessage()]);
                        }
                    } else {
                        return response()->json(['status' => 'error', 'message' => 'Invalid file or upload failed.']);
                    }
                }

                // Save asset detail data including file paths if applicable
                DB::table('t_opname_detail')->insert([
                    'opname_det_id' => $moveout->opname_no, // Sequential ID
                    'opname_id' => $opname, // Use the generated opname_id for each detail
                    'asset_tag' => $request->input('register_code')[$index],
                    'qty_onhand' => $qty_onhand,
                    'qty_physical' => $qty_physical,
                    'qty_difference' => $qty_difference,
                    'uom' => $request->input('satuan')[$index],
                    'condition_id' => $request->input('condition_id')[$index],
                    'image' => $filePath, // Store file path in detail if available
                ]);

                DB::table('table_registrasi_asset')
                ->where('id', $assetId) // Match asset by ID
                ->update(['qty' => $qty_onhand]);

                $fileIndex++;
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
                'so_id' => $soId
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
            $moveout->save(); // Save the changes to the database

            return response()->json([
                'status' => 'success', 
                'message' => 'MoveOut deactivated successfully.', // Updated message for clarity
                'redirect_url' => route('Admin.stockopname')
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
            $moveout->save(); // Save the changes to the database

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
}
