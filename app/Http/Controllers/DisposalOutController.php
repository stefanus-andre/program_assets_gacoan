<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterDisOut;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade\Pdf;

class DisposalOutController extends Controller
{
    public function Index()
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();

        $restos = DB::table('master_resto_v2')->select('store_code', 'name_store_street')->get();

        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();

        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();

        

        $username = auth()->user()->username;

        $fromLoc = DB::table('m_people')

                ->where('nip', $username)

                ->value('loc_id');



        $registerLocation = DB::table('master_resto')

                ->where('store_code', $fromLoc)

                ->value('resto');

    

        // Filter assets based on the register_location matching the fetched resto

        $assets = DB::table('table_registrasi_asset')

            ->select('id', 'asset_name')

            // ->where('location_now', $registerLocation)

            ->where('qty', '>', 0) 

            ->get();       



            $moveouts = DB::table('t_out')
        
            ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name', 'master_resto_v2.*', 't_out_detail.*')
    
            ->leftjoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
    
            ->leftjoin('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
    
            ->leftjoin('master_resto_v2', 't_out.from_loc', '=' , 'master_resto_v2.id')
    
            ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
    
            ->join('m_uom', 't_out_detail.uom', '=' , 'm_uom.uom_id')
    
            ->where('t_out.out_id', 'like', 'DA%')
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

    public function HalamanDisOut() 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();

        $restos = DB::table('master_resto_v2')->select('store_code', 'name_store_street')->get();

        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();

        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();

        

        $username = auth()->user()->username;

        $fromLoc = DB::table('m_people')

                ->where('nip', $username)

                ->value('loc_id'); 



        $registerLocation = DB::table('master_resto')

                ->where('store_code', $fromLoc)

                ->value('resto');

    

        // Filter assets based on the register_location matching the fetched resto

        $assets = DB::table('table_registrasi_asset')

        ->select('id', 'asset_name')

        // ->where('location_now', $registerLocation)

        ->where('qty', '>', 0) 

        ->get();       

        $user_loc = auth()->user()->location_now;
        $username = auth()->user()->username;

        // Mulai query builder
        $query = DB::table('t_out')
            ->distinct()
            ->select(
                't_out.*',
                't_out_detail.*',
                'm_reason.reason_name',
                'mc_approval.approval_name',
                'master_resto_v2.*',
                't_out_detail.*',
                'm_uom.uom_name',
                'm_brand.brand_name'
            )
            ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
            ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
            ->join(
                'master_resto_v2',
                DB::raw('CONVERT(t_out.from_loc USING utf8mb4) COLLATE utf8mb4_unicode_ci'),
                '=',
                DB::raw('CONVERT(master_resto_v2.id USING utf8mb4) COLLATE utf8mb4_unicode_ci')
            )
            ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
            ->join('m_uom', 't_out_detail.uom', '=', 'm_uom.uom_id')
            ->join('m_brand', 't_out_detail.brand', '=', 'm_brand.brand_id')
            ->join(
                'm_user',
                DB::raw('CONVERT(t_out.from_loc USING utf8mb4) COLLATE utf8mb4_unicode_ci'),
                '=',
                DB::raw('CONVERT(m_user.location_now USING utf8mb4) COLLATE utf8mb4_unicode_ci')
            );

            // Jika yang login bukan admin, tambahkan filter berdasarkan `user_loc`
            if ($username !== 'admin') {
                $query->where(
                DB::raw('CONVERT(m_user.location_now USING utf8mb4) COLLATE utf8mb4_unicode_ci'),
                '=', $user_loc);
            }

            $moveouts = $query->where('t_out.out_id', 'like', 'DA%')
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

    public function showPutForm($id)
    {
        $moveout = MasterDisOut::find($id); // Fetch the moveout record by ID

        if (!$moveout) {
            return response()->json(['status' => 'error', 'message' => 'Moveout not found.'], 404);
        }

        // Return the moveout data
        return response()->json(['status' => 'success', 'data' => $moveout]);
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
        $data = $request->validate([
            'out_date' => 'required|date',
            'from_loc_id' => 'required|string|max:255',
            'out_desc' => 'required|string|max:255',
            'reason_id' => 'required|string|max:255',
            'asset_id' => 'required|array',
            'register_code' => 'required|array',
            'serial_number' => 'required|array',
            'merk' => 'required|array',
            'qty' => 'required|array',
            'satuan' => 'required|array',
            'condition_id' => 'required|array',
            'image' => 'required|array'
        ]);
    
        try {
            $trx_code = DB::table('t_trx')->where('trx_name', 'Disposal Asset')->value('trx_code');
            $today = Carbon::now()->format('ymd');
            $todayCount = MasterDisOut::whereDate('create_date', Carbon::now())->count() + 1;
            $transaction_number = str_pad($todayCount, 3, '0', STR_PAD_LEFT);
            $out_id = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('from_loc_id')}.{$transaction_number}";
    
            $moveout = new MasterDisOut();
            $moveout->out_date = $request->input('out_date');
            $moveout->from_loc = $request->input('from_loc_id');
            $moveout->out_desc = $request->input('out_desc');
            $moveout->reason_id = $request->input('reason_id');
            $moveout->appr_1 = '1';
            $moveout->is_active = '1';
            $moveout->is_verify = '1';
            $moveout->is_confirm = '1';
            $moveout->create_by = Auth::user()->username;
    
            $maxMoveoutId = MasterDisOut::max('out_no');
            $out_no_base = $maxMoveoutId ? $maxMoveoutId + 1 : 1;
            $moveout->out_no = $out_no_base;
    
            $moveout->out_id = $out_id;
            $moveout->save();
    
            foreach ($request->input('asset_id') as $index => $assetId) {
                $transaction_number_str = str_pad($transaction_number, 3, '0', STR_PAD_LEFT);
                $out = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('from_loc')}.{$transaction_number_str}";
    
                $imagePath = null;
                if ($request->hasFile("image.$index") && $request->file("image.$index")->isValid()) {
                    // Store the uploaded file and get its path
                    $imagePath = $request->file("image.$index")->store('moveout_item/images', 'public');
                }
    
                $currentQty = DB::table('table_registrasi_asset')
                    ->where('id', $assetId)
                    ->value('qty');
                $moveoutQty = $request->input('qty')[$index];
                
                if ($currentQty === null) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Asset ID {$assetId} not found."
                    ], 404);
                }
    
                $newQty = max(0, $currentQty - $moveoutQty);
                DB::table('table_registrasi_asset')
                    ->where('id', $assetId)
                    ->update(['qty' => $newQty]);
    
                DB::table('t_out_detail')->insert([
                    'out_det_id' => $moveout->out_no,
                    'out_id' => $out_id,
                    'asset_id' => $assetId,
                    'asset_tag' => $request->input('register_code')[$index],
                    'serial_number' => $request->input('serial_number')[$index],
                    'brand' => $request->input('merk')[$index],
                    'qty' => $moveoutQty,
                    'uom' => $request->input('satuan')[$index],
                    'condition' => $request->input('condition_id')[$index],
                    'image' => $imagePath,
                ]);

                DB::table('t_transaction_qty')->insert([
                    'out_det_id' => $moveout->out_no,
                    'out_id' => $out_id, 
                    'asset_tag' => $request->input('register_code')[$index],
                    'asset_id' => $assetId,
                    'from_loc' => $request->input('from_loc_id')[$index],
                    'qty' => $moveoutQty,
                    'qty_continue' => 1,
                    'qty_total' => 0,
                    'qty_disposal' => 0,
                    'qty_difference' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
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
    


    // // Example push notification function
    // private function sendPushNotification($expoPushToken, $title, $body)
    // {
    //     $url = 'https://exp.host/--/api/v2/push/send';
    //     $data = [
    //         'to' => $expoPushToken,
    //         'sound' => 'default',
    //         'title' => $title,
    //         'body' => $body,
    //         'data' => ['MoveOutId' => '12345']
    //     ];

    //     $options = [
    //         'http' => [
    //             'header' => "Content-type: application/json\r\n",
    //             'method' => 'POST',
    //             'content' => json_encode($data)
    //         ]
    //     ];

    //     $context = stream_context_create($options);
    //     $result = file_get_contents($url, false, $context);

    //     return $result;
    // }

    public function updateDataDisOut(Request $request, $out_id)
    {
         // Validate input
    $request->validate([
        'out_date' => 'required|date',
        'from_loc_id' => 'required|integer',
        'out_desc' => 'required|string',
        'reason_id' => 'required|integer',
        // 'uom' => 'required|interger',
        // 'brand' => 'required|integer',
        'asset_id.*' => 'required|integer',
        'qty.*' => 'required|integer',
        'condition_id.*' => 'required|integer|exists:m_condition,condition_id',
        // Add other validation rules as necessary
    ]);

    // Check if the MoveOut entry exists
    $moveout = DB::table('t_out')->where('out_id', $out_id)->first();

    if (!$moveout) {
        return response()->json(['status' => 'error', 'message' => 'MoveOut record not found.'], 404);
    }

    // Update the main MoveOut record
    $updated = DB::table('t_out')->where('out_id', $out_id)->update([
        'out_date' => $request->input('out_date'),
        'from_loc' => $request->input('from_loc_id'),
        'out_desc' => $request->input('out_desc'),
        'reason_id' => $request->input('reason_id'),
        'updated_at' => Carbon::now(),
    ]);

    if ($updated == 0) {
        return response()->json(['status' => 'error', 'message' => 'No changes were made to the MoveOut record.'], 500);
    }

    // Update the detail records based on the relation between out_no and out_det_id
    foreach ($request->input('asset_id') as $index => $assetId) {
        $imagePath = null;

        if ($request->hasFile("image.$index") && $request->file("image.$index")->isValid()) {
            $imagePath = $request->file("image.$index")->store('moveout_item/images', 'public');
        }

        $moveoutQty = $request->input('qty')[$index];

        $asset = DB::table('table_registrasi_asset')->where('id', $assetId)->first();

        // if (!$asset || $asset->qty < $moveoutQty) {
        //     return response()->json(['status' => 'error', 'message' => 'Not enough quantity available for asset ID ' . $assetId . '.'], 400);
        // }


        DB::table('table_registrasi_asset')
        ->where('id', $assetId) 
        ->decrement('qty', $moveoutQty);
        

        // Check if the detail record exists based on out_no and out_det_id
        $existingDetail = DB::table('t_out_detail')
            ->where('out_det_id', $moveout->out_no)
            ->where('asset_id', $assetId) // Ensure we check the asset_id in the detail record as well
            ->first();

        if ($existingDetail) {
            // Update the existing detail record
            DB::table('t_out_detail')
                ->where('out_det_id', $existingDetail->out_det_id) // Use the correct primary key
                ->update([
                    'asset_id' => $assetId,
                    'serial_number' => $request->input('serial_number')[$index],
                    'asset_tag' => $request->input('register_code')[$index],
                    'brand' => $request->input('merk')[$index],
                    'qty' => $moveoutQty,
                    'uom' => $request->input('satuan')[$index],
                    'condition' => $request->input('condition_id')[$index],
                    'image' => $imagePath ?: $existingDetail->image, // Use existing image if no new image is provided
                    'updated_at' => Carbon::now(),
                ]);
        } else {
            DB::table('t_out_detail')->insert([
                'out_det_id' => $moveout->out_no,
                'out_id' => $moveout->out_id,
                'asset_id' => $assetId,
                'serial_number' => $request->input('serial_number')[$index],
                'asset_tag' => $request->input('register_code')[$index],
                'brand' => $request->input('merk')[$index],
                'qty' => $moveoutQty,
                'uom' => $request->input('satuan')[$index],
                'condition' => $request->input('condition_id')[$index],
                'image' => $imagePath,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),  
            ]);
        }
    }

    return redirect()->to('/admin/disout')->with('success', 'MoveOut record updated successfully.');
    }

    public function edit($id)
    {
        $moveout = MasterDisOut::with('asset')->findOrFail($id); 
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



    public function addPageDataDisposalOut() {

        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name','fromResto.name_store_street as from_location', 
        'toResto.name_store_street as dest_location')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
        ->join('master_resto_v2 as fromResto', 't_out.from_loc', '=', 'fromResto.id') // Alias for from_loc
        ->join('master_resto_v2 as toResto', 't_out.dest_loc', '=', 'toResto.id')   // Alias for dest_loc
        ->get();

        return view('Admin.disposal.add_data_disposal', [
            'reasons' => $reasons,
            'assets' => $assets, 
            'conditions' => $conditions,
            'moveouts' => $moveouts,
        ]);
    }

    public function detailPageDataDisposalOut($id) 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();

        $moveOutAssets = DB::table('t_out')
        ->select(
            't_out.*',
            't_out_detail.out_id AS detail_out_id',
            't_out_detail.qty',
            'm_reason.reason_name',
            'master_resto_v2.name_store_street AS from_location'
        )
        ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('master_resto_v2', 't_out.from_loc', '=', 'master_resto_v2.id')
        ->where('t_out.out_id', '=', $id) // Ensure specific match
        ->where('t_out.out_id', 'like', 'DA%')
        ->first();

        $assets = DB::table('table_registrasi_asset')
        ->leftjoin('t_out_detail', 'table_registrasi_asset.register_code', 't_out_detail.asset_tag')
        ->leftjoin('t_transaction_qty', 't_out_detail.out_id', '=', 't_transaction_qty.out_id')
        ->leftjoin('t_out', 't_transaction_qty.out_id', 't_out.out_id')
        ->leftjoin('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
        ->leftjoin('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
        ->leftjoin('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
        ->leftjoin('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
        ->select('m_assets.asset_model', 'm_brand.brand_name', 't_transaction_qty.qty', 'm_uom.uom_name', 'table_registrasi_asset.serial_number', 'table_registrasi_asset.register_code', 'm_condition.condition_name', 't_out_detail.image')
        ->where('t_out.out_id', 'like', 'DA%')
        ->get();

        // dd($moveOutAssets);

        return view('Admin.disposal.detail_data_disposal', compact('reasons', 'moveOutAssets', 'assets'));
    }


    public function filter(Request $request)
    {
        $startDate = $request->input('start_date');

        $endDate = $request->input('end_date');

    
        // Validate the date inputs
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);


        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();

        $restos = DB::table('master_resto_v2')->select('store_code', 'name_store_street')->get();

        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();

        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();

        

        $username = auth()->user()->username;

        $fromLoc = DB::table('m_people')

                ->where('nip', $username)

                ->value('loc_id');



        $registerLocation = DB::table('master_resto')

                ->where('store_code', $fromLoc)

                ->value('resto');

    

        // Filter assets based on the register_location matching the fetched resto

        $assets = DB::table('table_registrasi_asset')

            ->select('id', 'asset_name')

            // ->where('location_now', $registerLocation)

            ->where('qty', '>', 0) 

            ->get();       

        
    
        $moveouts = DB::table('t_out')
        ->distinct()
        ->select(
            't_out.*',
            'm_reason.reason_name',
            'mc_approval.approval_name',
            'master_resto_v2.*',
            't_out_detail.*',
            'm_uom.uom_name',
            'm_brand.brand_name'
        )

        ->leftJoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->leftJoin('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
        ->leftJoin(
            'master_resto_v2',
            DB::raw('CONVERT(t_out.from_loc USING utf8mb4) COLLATE utf8mb4_unicode_ci'),
            '=',
            DB::raw('CONVERT(master_resto_v2.id USING utf8mb4) COLLATE utf8mb4_unicode_ci')
        )
        ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
        ->join('m_uom', 't_out_detail.uom', '=', 'm_uom.uom_id')
        ->join('m_brand', 't_out_detail.brand', '=', 'm_brand.brand_id')
        ->join(
            'm_user',
            DB::raw('CONVERT(t_out.from_loc USING utf8mb4) COLLATE utf8mb4_unicode_ci'),
            '=',
            DB::raw('CONVERT(m_user.location_now USING utf8mb4) COLLATE utf8mb4_unicode_ci')
        )
        
        ->when($startDate, function ($query, $startDate) {
            return $query->whereDate('out_date', '>=', $startDate);
            })
        ->when($endDate, function ($query, $endDate) {
                return $query->whereDate('out_date', '<=', $endDate);
            })
            
            
            ->where('t_out.out_id', 'like', 'DA%')// Only include active records
            
        ->paginate(10);


        return view("Admin.disout", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveouts' => $moveouts,
            'restos' => $restos
        ]);

        // Query to filter the data
        // $moveouts = DB::table('t_out')
        //     ->when($startDate, function ($query, $startDate) {
        //         return $query->whereDate('out_date', '>=', $startDate);
        //     })
        //     ->when($endDate, function ($query, $endDate) {
        //         return $query->whereDate('out_date', '<=', $endDate);
        //     })
        //     ->where('t_out.out_id', 'like', 'DA%')
        //     ->paginate(10); 
    
    }

    
    public function printPDF($id)

    {

        // Ambil data dari tabel t_out dan t_out_detail berdasarkan ID

        $moveout = MasterMoveOut::with('details')->findOrFail($id);



        // Generate PDF

        $pdf = Pdf::loadView('Admin.disposal.pdf_disposal_out', compact('moveout'));



        // Return PDF response untuk di-download atau dilihat

        return $pdf->download('moveout_' . $moveout->out_id . '.pdf');

    }



    public function previewPDF($out_id)

    {

        // Ambil data berdasarkan out_id

        $data = DB::table('t_out')
        ->select(
            't_out.*',
            't_out_detail.*',
            'fromResto.store_code as origin_site',
            'table_registrasi_asset.asset_name',
            'table_registrasi_asset.register_code',
            'm_assets.asset_model',
            'm_category.cat_name',
            'm_reason.reason_name',
            'm_condition.condition_name'
        )
        ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
        ->leftJoin('master_resto_v2 as fromResto', 't_out.from_loc', '=', 'fromResto.id')
        ->join('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
        ->join('m_assets','table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
        // ->leftJoin('master_resto_v2 as toResto', 't_out.dest_loc', '=', 'toResto.id')
        // ->leftJoin('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
        ->join('m_condition','t_out_detail.condition', '=', 'm_condition.condition_id')
        ->join('m_category','table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
        // ->leftJoin('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_id')
        ->leftJoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        
        ->where('t_out.out_id', $out_id)
        ->where('t_out.out_id', 'like', 'DA%')
        ->get();

        $firstRecord = $data->first();

        // foreach ($data as $record) {
        //     echo $record->register_code; 
        //     echo $record->asset_name; 
        //     echo $record->category_asset; 
        //     echo $record->serial_number; 
        //     echo $record->type_name; 
        //     echo $record->condition_name; 
        // }


                // $data = DB::table('t_out')
                // ->select(
                //     't_out.*',
                //     't_out_detail.*',
                //     'fromResto.store_code as origin_site', 
                //     'toResto.store_code as destination_site',
                //     'table_registrasi_asset.asset_name',
                //     'table_registrasi_asset.category_asset',
                //     'table_registrasi_asset.serial_number',
                //     'table_registrasi_asset.type_asset',
                //     'm_condition.condition_name',
                //     'm_type.type_name',
                //     'm_category.cat_name'
                // )
                // ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
                // ->leftJoin('master_resto_v2 as fromResto', 't_out.from_loc', '=', 'fromResto.id')
                // ->leftJoin('master_resto_v2 as toResto', 't_out.dest_loc', '=', 'toResto.id')
                // ->leftJoin('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
                // ->leftJoin('m_condition', 't_out_detail.condition', '=', 'm_condition.condition_id')
                // ->leftJoin('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_id')
                // ->leftJoin('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_id')
                // ->where('t_out.out_id', $out_id)
                // ->first();
            

        // dd($firstRecord);

        // Jika data tidak ditemukan, tampilkan halaman 404

        if (!$firstRecord) {

            abort(404, 'MoveOut not found');

        }



        // Buat PDF menggunakan data yang ditemukan

        $pdf = PDF::loadView('Admin.disposal.pdf_disposal_out', compact('data', 'firstRecord'));



        return response($pdf->output(), 200)->header('Content-Type', 'application/pdf');

    }

    public function editDetailDataDisout($id) {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        
        $assets = DB::table('table_registrasi_asset')
        ->select('table_registrasi_asset.id'
                ,'table_registrasi_asset.register_code'    
                ,'table_registrasi_asset.serial_number'
                ,'table_registrasi_asset.register_date'
                ,'table_registrasi_asset.purchase_date'
                ,'table_registrasi_asset.approve_status'
                ,'table_registrasi_asset.serial_number'
                ,'table_registrasi_asset.width'
                ,'table_registrasi_asset.height'
                ,'table_registrasi_asset.depth'
                ,'table_registrasi_asset.qty'
                ,'m_assets.asset_model'
                ,'m_type.type_name'
                ,'m_category.cat_name'
                ,'m_priority.priority_name'
                ,'m_brand.brand_name'
                ,'m_brand.brand_id'
                ,'m_uom.uom_name'
                ,'m_uom.uom_id'
                ,'master_resto_v2.name_store_street'
                ,'m_layout.layout_name'
                ,'m_supplier.supplier_name'
                ,'m_condition.condition_name'
                ,'m_condition.condition_id'
                ,'m_warranty.warranty_name'
                ,'m_periodic_mtc.periodic_mtc_name'
                ,'table_registrasi_asset.deleted_at')
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
        ->where('table_registrasi_asset.qty', '>', 0) 
        ->get();

        $moveOutAssets = DB::table('t_out')
        ->select(
            't_out.*',
            't_out_detail.*',
            't_out.out_id',
            't_out_detail.out_id AS detail_out_id',
            't_out_detail.qty',
            'm_reason.reason_name',
            'master_resto_v2.name_store_street'
        )
        ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('master_resto_v2', 't_out.from_loc', '=', 'master_resto_v2.id')
        ->where('t_out.out_id', '=', $id) // Ensure specific match
        ->where('t_out.out_id', 'like', 'DA%')
        ->first();



        // dd($moveOutAssets);

            return view('Admin.disposal.edit_data_disposal', compact('moveOutAssets','reasons','conditions','assets'));
    }


    public function getAjaxDataDisposal() 
    {
        try {
            $userLocationNow = auth()->user()->location_now;
    
            $result = DB::table('t_out')
            ->select('t_out.*', 't_out_detail.*', 'm_user.*')
            ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
            ->join('m_user', 't_out.dest_loc', '=', 'm_user.location_now')
            ->where('m_user.location_now', $userLocationNow)
            ->where('t_out.is_confirm', 3)
            ->where('m_user.role', 'user')
            ->get();
    
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    // public function getAjaxDataDisposal() {
    //     $asset =  DB::table('table_registrasi_asset')
    //     ->select('table_registrasi_asset.id'
    //             ,'table_registrasi_asset.register_code'    
    //             ,'table_registrasi_asset.serial_number'
    //             ,'table_registrasi_asset.register_date'
    //             ,'table_registrasi_asset.purchase_date'
    //             ,'table_registrasi_asset.approve_status'
    //             ,'table_registrasi_asset.serial_number'
    //             ,'table_registrasi_asset.qty'
    //             ,'m_assets.asset_model'
    //             ,'m_type.type_name'
    //             ,'m_category.cat_name'
    //             ,'m_priority.priority_name'
    //             ,'m_brand.brand_name'
    //             ,'m_brand.brand_id'
    //             ,'m_uom.uom_name'
    //             ,'m_uom.uom_id'
    //             ,'master_resto_v2.name_store_street'
    //             ,'m_layout.layout_name'
    //             ,'m_supplier.supplier_name'
    //             ,'m_condition.condition_name'
    //             ,'m_warranty.warranty_name'
    //             ,'m_periodic_mtc.periodic_mtc_name'
    //             ,'table_registrasi_asset.deleted_at')
    //     ->leftJoin('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
    //     ->leftJoin('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
    //     ->leftJoin('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
    //     ->leftJoin('m_priority', 'table_registrasi_asset.prioritas', '=', 'm_priority.priority_code')
    //     ->leftJoin('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
    //     ->leftJoin('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
    //     ->leftJoin('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
    //     ->leftJoin('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
    //     ->leftJoin('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
    //     ->leftJoin('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
    //     ->leftJoin('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
    //     ->leftJoin('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
    //     ->get();

    //     return response()->json($asset);
    // }



    // public function getAjaxAssetDisposalDetails($id) {
    //     $asset =  DB::table('table_registrasi_asset')
    //     ->select('table_registrasi_asset.id'
    //             ,'table_registrasi_asset.register_code'    
    //             ,'table_registrasi_asset.serial_number'
    //             ,'table_registrasi_asset.register_date'
    //             ,'table_registrasi_asset.purchase_date'
    //             ,'table_registrasi_asset.approve_status'
    //             ,'table_registrasi_asset.serial_number'
    //             ,'table_registrasi_asset.qty'
    //             ,'m_assets.asset_model'
    //             ,'m_type.type_name'
    //             ,'m_category.cat_name'
    //             ,'m_priority.priority_name'
    //             ,'m_brand.brand_name'
    //             ,'m_brand.brand_id'
    //             ,'m_uom.uom_name'
    //             ,'m_uom.uom_id'
    //             ,'master_resto_v2.name_store_street'
    //             ,'m_layout.layout_name'
    //             ,'m_supplier.supplier_name'
    //             ,'m_condition.condition_name'
    //             ,'m_warranty.warranty_name'
    //             ,'m_periodic_mtc.periodic_mtc_name'
    //             ,'table_registrasi_asset.deleted_at')
    //     ->leftJoin('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
    //     ->leftJoin('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
    //     ->leftJoin('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
    //     ->leftJoin('m_priority', 'table_registrasi_asset.prioritas', '=', 'm_priority.priority_code')
    //     ->leftJoin('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
    //     ->leftJoin('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
    //     ->leftJoin('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
    //     ->leftJoin('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
    //     ->leftJoin('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
    //     ->leftJoin('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
    //     ->leftJoin('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
    //     ->leftJoin('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
    //     ->where('table_registrasi_asset.id', $id)
    //     ->first();
    //     if ($asset) {
    //         return response()->json($asset);
    //     } else {
    //         return response()->json(['error' => 'Asset not found'], 404);
    //     }
    // }

    public function getAjaxAssetDisposalDetails($id) {
        $datadisout = DB::table('t_out');
    }
}
