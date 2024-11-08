<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterDisOut;
use App\Models\Master\TOutDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DisposalOutController extends Controller
{
    public function Index(Request $request)
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $restos = DB::table('master_resto')->select('store_code', 'resto')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        
        $username = auth()->user()->username;
        $fromLoc = DB::table('m_people')
                ->where('nip', $username)
                ->value('loc_id');

        $registerLocation = DB::table('master_resto')
                ->where('store_code', $fromLoc)
                ->value('resto');
    
        // Filter assets based on the location_now matching the fetched resto
        $assets = DB::table('table_registrasi_asset')
            ->select('id', 'asset_name')
            ->where('location_now', $registerLocation)
            ->where('qty', '>', 0) 
            ->get();   

        // Get start and end dates from the request, or use null if not provided
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $moveouts = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')
        ->where('t_out.out_id', 'like', 'DA%')// Only include active records
        ->when($startDate, function ($query, $startDate) {
            return $query->where('t_out.create_date', '>=', $startDate); // Filter by start date
        })
        ->when($endDate, function ($query, $endDate) {
            return $query->where('t_out.create_date', '<=', $endDate); // Filter by end date
        })
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')
        ->paginate(10);

        return view("Admin.disout", [
            'fromLoc' => $fromLoc,
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveouts' => $moveouts,
            'restos' => $restos
        ]);
    }

    public function HalamanDisOut(Request $request) 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $restos = DB::table('master_resto')->select('store_code', 'resto')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        
        $username = auth()->user()->username;
        $fromLoc = DB::table('m_people')
                ->where('nip', $username)
                ->value('loc_id');

        $registerLocation = DB::table('master_resto')
                ->where('store_code', $fromLoc)
                ->value('resto');
    
        // Filter assets based on the location_now matching the fetched resto
        $assets = DB::table('table_registrasi_asset')
            ->select('id', 'asset_name')
            ->where('location_now', $registerLocation)
            ->where('qty', '>', 0) 
            ->get();      

        $moveoutsQuery = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')
        ->where('t_out.out_id', 'like', 'DA%');

        // Apply date range filter if provided
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = $request->input('start_date') . ' 00:00:00'; // mulai dari awal hari
            $endDate = $request->input('end_date') . ' 23:59:59'; // sampai akhir hari
            $moveoutsQuery->whereBetween('t_out.out_date', [$startDate, $endDate]);
        }
    
        // Paginate the results
        $moveouts = $moveoutsQuery->paginate(10);

        return view("Admin.disout", [
            'fromLoc' => $fromLoc,
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveouts' => $moveouts,
            'restos' => $restos
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
        $results = MasterDisOut::whereBetween('create_date', [$startDate, $endDate]);
    
        // Eksekusi query dan ambil hasilnya
        $results = $results->get();

        // Ambil data lain yang dibutuhkan untuk tampilan
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $restos = DB::table('master_resto')->select('store_code', 'resto')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $username = auth()->user()->username;
        $fromLoc = DB::table('m_people')
            ->where('nip', $username)
            ->value('loc_id');
        
        $registerLocation = DB::table('master_resto')
            ->where('store_code', $fromLoc)
            ->value('resto');

        $assets = DB::table('table_registrasi_asset')
            ->select('id', 'asset_name')
            ->where('location_now', $registerLocation)
            ->where('qty', '>', 0) 
            ->get();

        $moveouts = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')
        ->where('t_out.out_id', 'like', 'DA%')
        ->paginate(10);

        // Kembalikan hasil filter dan data lainnya ke tampilan Blade
        return view('admin.disout', [
            'results' => $results,
            'fromLoc' => $fromLoc,
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'moveouts' => $moveouts,
            'restos' => $restos
        ]);
    }

    public function previewPDF($out_id)
    {
        // Ambil data berdasarkan out_id
        $data = DB::table('t_out')
            ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
            ->leftJoin('master_resto as origin', 't_out.from_loc', '=', 'origin.store_code')
            ->leftJoin('master_resto as destination', 't_out.dest_loc', '=', 'destination.store_code')
            ->leftJoin('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
            ->leftJoin('m_condition', 't_out_detail.condition', '=', 'm_condition.condition_id')
            ->leftJoin('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_id')
            ->leftJoin('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_id')
            ->where('t_out.out_id', $out_id)
            ->select(
                't_out.*', 
                't_out_detail.*', 
                'origin.resto as origin_store_code', 
                'destination.resto as destination_store_code',
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
        $pdf = Pdf::loadView('Admin.pdf-disposal', compact('data'));

        return response($pdf->output(), 200)->header('Content-Type', 'application/pdf');
    }

    public function showPutForm($id)
    {
        $moveout = MasterDisOut::find($id); // Fetch the moveout record by ID

        if (!$moveout) {
            return response()->json(['status' => 'error', 'message' => 'Moveout not found.'], 404);
        }

        // Return the moveout data
        return response()->json(['status' => 'success', 'data' => $moveout]);
    }

    public function showPutFormDisout($outId)
    {
        $moveout = MasterDisOut::find('out_id', $outId)->first();
        
        if (!$moveout) {
            return response()->json(['message' => 'Moveout not found'], 404);
        }
        
        return response()->json($moveout);
    }

    public function showPutFormDisoutDetail($outId)
    {
        Log::info("showPutFormMoveoutDetail called with out_id: $outId");

        $moveout = TOutDetail::where('out_id', $outId)->first();
        
        if (!$moveout) {
            Log::info("No details found for out_id: $outId");
            return response()->json(['message' => 'Moveout not found'], 404);
        }
        
        return response()->json($moveout);
    }

    public function getDisOut()
    {
        // Mengambil semua data dari tabel t_out
        $moveouts = MasterDisOut::all();
        return response()->json($moveouts); // Mengembalikan data dalam format JSON
    }

    public function getAssetDetails($id)
    {
        $asset = DB::table('table_registrasi_asset')
            ->select('merk', 'qty', 'satuan', 'serial_number', 'register_code')
            ->where('id', $id)
            ->first();

        return response()->json($asset);
    }

    public function getDetails($id)
    {
        // Fetch data from t_out and t_out_detail based on the out_id
        $moveOut = DB::table('t_out')
            ->where('out_id', $id)
            ->first();

        $moveOutDetails = DB::table('t_out_detail')
            ->where('out_id', $id)
            ->get(); // Assuming you want to retrieve all details related to this out_id

        // Combine the results (if necessary)
        $response = [
            'out_id' => $moveOut->out_id,
            'out_no' => $moveOut->out_no,
            'out_date' => $moveOut->out_date,
            'from_loc' => $moveOut->from_loc,
            'dest_loc' => $moveOut->dest_loc,
            'in_id' => $moveOut->in_id,
            'out_desc' => $moveOut->out_desc,
            // Assuming there's a single asset, or you need to modify this to handle multiple assets
            'asset_id' => $moveOutDetails->first()->asset_id ?? '',
            'asset_name' => $moveOutDetails->first()->asset_name ?? '',
            'asset_tag' => $moveOutDetails->first()->asset_tag ?? '',
            'serial_number' => $moveOutDetails->first()->serial_number ?? '',
            'brand' => $moveOutDetails->first()->brand ?? '',
            'qty' => $moveOutDetails->first()->qty ?? '',
            'uom' => $moveOutDetails->first()->uom ?? '',
            'condition' => $moveOutDetails->first()->condition ?? '',
            'image' => $moveOutDetails->first()->image ?? '',
        ];

        return response()->json($response);
    }

    public function getMoveOutById($id)
    {
        $moveout = MasterDisOut::find($id); // Fetch the moveout entry by ID

        if ($moveout) {
            return response()->json($moveout); // Return the moveout data as JSON
        }

        return response()->json(['message' => 'MoveOut not found'], 404); // Handle not found case
    }


    public function AddDataDisOut(Request $request)
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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Buat instance dari model MasterDisOut
            $moveout = new MasterDisOut();
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
            $maxMoveoutId = MasterDisOut::max('out_no');
            $out_no_base = $maxMoveoutId ? $maxMoveoutId + 1 : 1;

            // Menyimpan data moveout ke database
            $moveout->out_no = $out_no_base; // Set out_no untuk pertama
            // Menghasilkan out_id secara otomatis
            $trx_code = DB::table('t_trx')->where('trx_name', 'Disposal Asset')->value('trx_code');

            // Format yymmdd untuk tanggal hari ini
            $today = Carbon::now()->format('ymd');

            // Hitung urutan nomor transaksi untuk hari ini
            $todayDate = Carbon::now()->format('Y-m-d');
            $todayCount = MasterDisOut::whereDate('create_date', $todayDate)->count() + 1;
            $transaction_number = str_pad($todayCount, 3, '0', STR_PAD_LEFT); // Format as 001, 002, etc.

            // Format opname_id
            $moveout->out_id = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('from_loc')}.{$transaction_number}";
            
            $moveout->save(); // Simpan moveout

            // Loop melalui aset untuk menyimpan detail
            foreach ($request->input('asset_id') as $index => $assetId) {
                // Menghasilkan out_det_id secara otomatis
                $trx_code = DB::table('t_trx')->where('trx_name', 'Asset Movement')->value('trx_code');
            
                // Format yymmdd untuk tanggal hari ini
                $today = Carbon::now()->format('ymd');
            
                // Get the last transaction number used for today from opname_id
                $lastTransaction = DB::table('t_out_detail')
                    ->where('out_id', 'like', "{$trx_code}.{$today}.%") // Filter by out_id format
                    ->orderBy('out_id', 'desc')
                    ->first();
            
                // Calculate the next transaction number
                if ($lastTransaction) {
                    // Extract the last transaction number from the out_id
                    $lastOpnameId = $lastTransaction->out_id;
                    preg_match('/\.(\d{3})$/', $lastOpnameId, $matches);
                    $transaction_number = isset($matches[1]) ? intval($matches[1]) + 1 : 1; // Increment the last number or start with 1
                } else {
                    $transaction_number = 1; // Start with 1 if no transaction found
                }
                
                $transaction_number_str = str_pad($transaction_number, 3, '0', STR_PAD_LEFT); // Format as 001, 002, etc.
            
                // Format opname_id untuk setiap detail
                $out = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('from_loc')}.{$transaction_number_str}";
                // Process the image for each asset if available
                $imagePath = null;
                if ($request->hasFile("images.$index")) { // Access the image by index
                    $image = $request->file("images.$index");
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads/image'), $imageName);
                    $imagePath = 'uploads/image/' . $imageName;
                }
                // Simpan data detail untuk aset
                DB::table('t_out_detail')->insert([
                    'out_det_id' => $moveout->out_no,  // Menggunakan out_det_id yang dihasilkan
                    'out_id' => $out,  // Menggunakan out_id yang dihasilkan
                    'asset_id' => $assetId,
                    'asset_tag' => $request->input('register_code')[$index],
                    'serial_number' => $request->input('serial_number')[$index],
                    'brand' => $request->input('merk')[$index],
                    'qty' => $request->input('qty')[$index],
                    'uom' => $request->input('satuan')[$index],
                    'condition' => $request->input('condition_id')[$index],
                    'image' => $imagePath, // Store image path for this asset
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Data moveout berhasil ditambahkan',
                'redirect_url' => route('Admin.disout')
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

    public function updateDataDisOut(Request $request, $id)
    {
        
        
        // Temukan data yang akan diupdate
        $moveout = MasterMoveOut::where('out_id', $id)->first();

        if (!$moveout) {
            return response()->json(['message' => 'Data not found'], 404);
        }
    
        $destLoc = $request->input('dest_loc');
        $outDesc = $request->input('out_desc');
        $reasonId = $request->input('reason_id');
        $conditionId = $request->input('condition_id');
        // Update data dengan opname_desc, qty_onhand tetap, dan qty_difference yang baru dihitung
        $moveout->update([
            'dest_loc' => $destLoc,
            'out_desc' => $outDesc,
            'reason_id' => $reasonId
        ]);

        $moveoutDetail = TOutDetail::where('out_id', $id)->first();

        if ($moveoutDetail) {
            // Update kolom is_verify di tabel header
            $moveoutDetail->update([
                'condition' => $conditionId
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Data disout berhasil diubah',
            'redirect_url' => route('Admin.disout') // Pastikan ini sesuai dengan rute yang ada
        ]);
    }

    public function edit($id)
    {
        $moveout = MasterDisOut::with('asset')->findOrFail($id); // Assuming MoveOut has a relationship with Asset
        return response()->json($moveout);
    }

    public function deleteDataDisOut($id)
    {
        $moveout = MasterDisOut::find($id);

        if ($moveout) {
            $moveout->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'move$moveout deleted successfully.',
                'redirect_url' => route('Admin.disout')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data move$moveout Gagal Terhapus'], 404);
        }
    }


    public function details($MoveOutId)
    {
        $moveout = MasterDisOut::where('out_id', $MoveOutId)->first();

        if (!$moveout) {
            abort(404, 'move$moveout not found');
        }

        return view('move$moveout.details', ['asset' => $moveout]);
    }
}
