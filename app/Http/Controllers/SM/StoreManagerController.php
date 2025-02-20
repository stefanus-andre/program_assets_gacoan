<?php

namespace App\Http\Controllers\SM;

use App\Http\Controllers\Controller;

use App\Models\Master\MasterAsset;

use App\Models\Master\MasterMoveOut;

use App\Models\Master\MasterRegistrasiModel;

use App\Models\Master\TOutDetail;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

use App\Models\Master\MasterDisOut; 

use App\Models\Master\MasterDisIn; 

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;


class StoreManagerController extends Controller
{
    public function dashboard() {
        return view('SM.sm_dashboard');
    }


    public function HalamanRegistrasiAsset() {

        return view("SM.registrasi_asset.lihat_data_registrasi");

    }




    public function HalamanMovement(Request $request) {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $restos = DB::table('master_resto_v2')->select('id', 'store_code', 'name_store_street')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
    

        $username = auth()->user()->username;
        

        $user = DB::table('m_user')->where('username', $username)->first();
        $fromLoc = $user->location_now;
        $role = $user->role;
    

        $assets = DB::table('table_registrasi_asset')
            ->select('id', 'asset_name')
            ->where('qty', '>', 0)
            ->get();

            $moveoutsQuery = DB::table('t_out')
            ->select([
                't_out.out_id',
                't_out.in_id',
                't_out.out_date',
                't_out.reason_id',
                't_out.is_confirm',
                't_out.out_desc',
                't_out.from_loc',
                't_out.dest_loc',
                't_out.is_active',
                't_out.created_at',
                't_out.updated_at',
                't_out.appr_1',
                't_out.appr_2',
                't_out.appr_3',
                't_out.is_confirm',
                't_out.appr_1_date',
                't_out.appr_2_date',
                't_out.appr_3_date',
                't_out.appr_1_user',
                't_out.appr_2_user',
                't_out.appr_3_user',
                't_out.deleted_at',
                't_transaction_qty.qty',
                't_transaction_qty.from_loc',
                'm_reason.reason_name',
                'mc_approval.approval_name',
                'fromResto.name_store_street as from_location',
                'toResto.name_store_street as destination_location',
            ])
            ->join('t_transaction_qty', 't_out.out_id', '=', 't_transaction_qty.out_id')
            ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
            ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
            ->join('master_resto_v2 as fromResto', 't_out.from_loc', '=', 'fromResto.id')
            ->join('master_resto_v2 as toResto', 't_out.dest_loc', '=', 'toResto.id')
            ->join('m_user', 't_transaction_qty.from_loc', '=', 'm_user.location_now')
            ->where('m_user.role', $role)
            // ->where('m_user.location_now', $fromLoc)
            ;

            $moveouts = $moveoutsQuery->paginate(10);

            // dd($moveouts);
        
            return view("SM.movement.lihat_data_movement_sm", [
                'fromLoc' => $fromLoc,
                'reasons' => $reasons,
                'assets' => $assets,
                'conditions' => $conditions,
                'moveouts' => $moveouts,
                'restos' => $restos
            ]);
        }

    public function HalamanAddMoveout() {

        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();

        $restos = DB::table('master_resto_v2')->select('store_code', 'name_store_street')->get();

        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();

        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();

        

        $username = auth()->user()->username;

        $fromLoc = DB::table('m_user')

                ->where('username', $username)

                ->value('location_now');



        $registerLocation = DB::table('master_resto_v2')

                ->where('name_store_street', $fromLoc)

                ->value('name_store_street');


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



        $moveouts = $moveoutsQuery->paginate(10);



        return view('SM.movement.add_data_movement_sm',[
            
            'fromLoc' => $fromLoc,

            'reasons' => $reasons,

            'assets' => $assets,
            
            'conditions' => $conditions,

            'moveouts' => $moveouts,

            'restos' => $restos
        ]);
    }


    public function getLocationUser() {
        $username = auth()->user()->username;
    
        // Fetch the current location and its ID
        $userLocation = DB::table('m_user')
            ->select('master_resto_v2.id', 'master_resto_v2.name_store_street')
            ->join('master_resto_v2', 'master_resto_v2.id', '=', 'm_user.location_now')
            ->where('m_user.username', $username)
            ->first();
    
        // Return the location ID and name as JSON
        return response()->json($userLocation);
    }
    

    public function AddDataMoveOut(Request $request) {


     $request->validate([
        'out_date' => 'required|date',
        'from_loc_id' => 'required|string|max:255',
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
        'image' => 'required|array'
    ]);


    if ($request->input('from_loc_id') === $request->input('dest_loc')) {
        return redirect()->back()->with('error', 'Lokasi Asal dan Lokasi Tujuan tidak boleh sama!');
    }

 
    $trx_code = DB::table('t_trx')->where('trx_name', 'Asset Movement')->value('trx_code');
    $today = Carbon::now()->format('ymd');
    $todayCount = MasterMoveOut::whereDate('create_date', Carbon::now())->count() + 1;
    $transaction_number = str_pad($todayCount, 3, '0', STR_PAD_LEFT);
    $out_id = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('from_loc_id')}.{$transaction_number}";

   
    $moveout = new MasterMoveOut();
    $moveout->out_date = $request->input('out_date');
    $moveout->from_loc = $request->input('from_loc_id');
    $moveout->dest_loc = $request->input('dest_loc');
    $moveout->out_desc = $request->input('out_desc');
    $moveout->reason_id = $request->input('reason_id');
    $moveout->appr_1 = '1';
    $moveout->is_active = '1';
    $moveout->is_verify = '1';
    $moveout->is_confirm = '1';
    $moveout->create_by = Auth::user()->username;

 
    $maxMoveoutId = MasterMoveOut::max('out_no');
    $out_no_base = $maxMoveoutId ? $maxMoveoutId + 1 : 1;
    $moveout->out_no = $out_no_base;

 
    $moveout->out_id = $out_id;


    $moveout->save();


foreach ($request->input('asset_id') as $index => $assetId) {
    $imagePath = null;

    if ($request->hasFile("image.$index") && $request->file("image.$index")->isValid()) {
        $imagePath = $request->file("image.$index")->store('moveout_item/images', 'public');
    }

    $moveoutQty = $request->input('qty')[$index];
    $registerCode = $request->input('register_code')[$index];


    $currentQty = DB::table('table_registrasi_asset')
        ->where('register_code', $registerCode)
        ->value('qty');

    if ($currentQty === null || $currentQty < $moveoutQty) {
        return redirect()->back()->with('error', "Insufficient stock for asset with register code: $registerCode");
    }


    $newQty = $currentQty - $moveoutQty;


    DB::table('table_registrasi_asset')
        ->where('register_code', $registerCode)
        ->update(['qty' => $newQty]);


    $existingDetail = DB::table('t_out_detail')->where('asset_tag', $registerCode)->first();

    if ($existingDetail) {

        $newQtyContinue = $existingDetail->qty_continue + $moveoutQty;

        DB::table('t_out_detail')
            ->where('asset_tag', $registerCode)
            ->update([
                'qty' => $existingDetail->qty + $moveoutQty,
                'qty_continue' => $newQtyContinue,
                'updated_at' => Carbon::now(),
            ]);
    } else {
        // Insert a new detail record into `t_out_detail`
        DB::table('t_out_detail')->insert([
            'out_det_id' => $moveout->out_no,
            'out_id' => $out_id,
            'asset_id' => $assetId,
            'asset_tag' => $registerCode,
            'serial_number' => $request->input('serial_number')[$index],
            'brand' => $request->input('merk')[$index],
            'qty' => $moveoutQty,
            'qty_continue' => 0, 
            'qty_total' => 0,
            'uom' => $request->input('satuan')[$index],
            'condition' => $request->input('condition_id')[$index],
            'image' => $imagePath,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }


    $moveoutData = DB::table('t_out')->where('out_id', $out_id)->first();

    DB::table('t_transaction_qty')->insert([
        'out_id' => $out_id, 
        'asset_tag' => $registerCode,
        'asset_id' => $assetId,
        'from_loc' => $moveoutData->dest_loc,
        'dest_loc' => $moveoutData->from_loc, 
        'qty' => $moveoutQty,
        'qty_continue' => 0,
        'qty_total' => DB::table('t_transaction_qty')
            ->where('asset_tag', $registerCode)
            ->sum('qty_total') + $moveoutQty,
        'qty_disposal' => 0,
        'qty_difference' => DB::table('t_transaction_qty')
            ->where('asset_tag', $registerCode)
            ->sum('qty_total') - $moveoutQty, 
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ]);
    
}

    

    return redirect()->back()->with('success', 'Asset Movement recorded successfully');
}


    public function filter(Request $request) {
    // Validate input
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    // Extract and format dates
    $startDate = \Carbon\Carbon::parse($request->input('start_date'))->startOfDay();
    $endDate = \Carbon\Carbon::parse($request->input('end_date'))->endOfDay();

    // Filter query
    $moveoutsQuery = DB::table('t_out')
    ->select(
        't_out.*', 
        'm_reason.reason_name', 
        'mc_approval.approval_name', 
        'fromResto.name_store_street as from_location', 
        'toResto.name_store_street as dest_location'
    )
    ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
    ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
    ->join('master_resto_v2 as fromResto', 't_out.from_loc', '=', 'fromResto.id') // Alias for from_loc
    ->join('master_resto_v2 as toResto', 't_out.dest_loc', '=', 'toResto.id')   // Alias for dest_loc
    ->whereBetween('t_out.out_date', [$startDate, $endDate]);

    $moveouts = $moveoutsQuery->paginate(10);

    // Other necessary data
    $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
    $username = auth()->user()->username;
    $fromLoc = DB::table('m_user')->where('username', $username)->value('location_now');
    $restos = DB::table('master_resto_v2')->select('store_code', 'name_store_street')->get();
    $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
    $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->where('qty', '>', 0)->get();

    // Return view with data
    return view('SM.movement.lihat_data_movement', compact('moveouts', 'reasons', 'restos', 'conditions', 'assets', 'fromLoc', 'username'));
}



public function ajaxGetAssetMovement(Request $request) {

    if (!Auth::check()) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $user = Auth::user();

    $user_role = $user->role ?? null;
    $user_location = $user->location_now ?? null;

    if (!$user_role || !$user_location) {
        return response()->json(['error' => 'User data missing'], 400);
    }


    $dataGetMovement = DB::table('table_registrasi_asset')
    ->select(
        'table_registrasi_asset.*',
        'm_user.username',
        'm_assets.*',
        'm_user.*',
        'm_type.*',
        'm_category.*',
        'm_condition.*',
        'm_brand.*',
        'm_uom.*',
    )
    ->join('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
    ->join('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
    ->join('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
    ->join('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
    ->join('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
    ->join('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
    ->join('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
    ->join('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
    ->join('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
    ->join('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
    ->join('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
    ->join('m_user', 'table_registrasi_asset.register_location', '=', 'm_user.location_now')
    ->where('m_user.location_now', $user_location)
    ->where('m_user.role', $user_role)
    ->where('table_registrasi_asset.qty', '>', 0)
    ->distinct() // Only distinct for selected columns
    ->get();



    // $dataGetMovement = DB::table('t_out')
    //     ->select(
    //         't_out.*',
    //         't_out_detail.*',
    //         'table_registrasi_asset.*',
    //         'm_assets.*',
    //         'm_user.*',
    //         'm_type.*',
    //         'm_category.*',
    //         'm_condition.*',
    //         'm_brand.*',
    //         'm_uom.*',
    //         'm_assets.*'
    //     )
    //     ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
    //     ->join('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
    //     ->join('m_user', 't_out.dest_loc', '=', 'm_user.location_now')
    //     ->join('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
    //     ->join('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
    //     ->join('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
    //     ->join('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
    //     ->join('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
    //     ->join('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
    //     ->join('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
    //     ->join('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
    //     ->join('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
    //     ->join('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
    //     ->join('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
    //     ->where('t_out_detail.qty', '>', 0)
    //     ->where('m_user.location_now', $user_location)
    //     ->where('m_user.role', $user_role)
    //     ->get(); 

        $data = []; 
        foreach ($dataGetMovement as $item) {
            $data[] = [
                'id' => $item->id,
                'register_code' => $item->register_code,
                'asset_name' => $item->asset_name,
                'merk' => $item->brand_name,
                'qty' => $item->qty,
                'satuan' => $item->uom_name,
                'serial_number' => $item->serial_number,
                'register_code' => $item->register_code,
                'condition' => $item->condition_name,
                'type_asset' => $item->type_name,
                'category_asset' => $item->cat_name,
                'condition' => $item->condition_name,
                'width' => $item->width,
                'height' => $item->height,
                'depth' => $item->depth,
                'brand_id' => $item->brand_id,
                'uom_id' => $item->uom_id,

            ];
        }

        return response()->json([
            'data' => $data,
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
        ]);
}


    // public function ajaxGetAssetMovement() {
    //     $assets =  DB::table('t_out')
    //     ->select('table_registrasi_asset.id'
    //             ,'table_registrasi_asset.register_code'    
    //             ,'table_registrasi_asset.serial_number'
    //             ,'table_registrasi_asset.register_date'
    //             ,'table_registrasi_asset.purchase_date'
    //             ,'table_registrasi_asset.approve_status'
    //             ,'table_registrasi_asset.serial_number'
    //             ,'table_registrasi_asset.width'
    //             ,'table_registrasi_asset.height'
    //             ,'table_registrasi_asset.depth'
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
    //             ,'t_out_detail.image'
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
    //     ->leftJoin('t_out_detail', 'table_registrasi_asset.id', '=', 't_out_detail.asset_id')
    //     ->where('table_registrasi_asset.qty', '>', 0) 
    //     ->get();

    //     $data = [];
    //     foreach ($assets as $asset) {
    //         $data[] = [
    //             'id' => $asset->id,
    //             'register_code' => $asset->register_code,
    //             'asset_name' => $asset->asset_model,
    //             'merk' => $asset->brand_name,
    //             'qty' => $asset->qty,
    //             'satuan' => $asset->uom_name,
    //             'serial_number' => $asset->serial_number,
    //             'register_code' => $asset->register_code,
    //             'condition' => $asset->condition_name,
    //             'type_asset' => $asset->type_name,
    //             'category_asset' => $asset->cat_name,
    //             'condition' => $asset->condition_name,
    //             'width' => $asset->width,
    //             'height' => $asset->height,
    //             'depth' => $asset->depth,
    //             'brand_id' => $asset->brand_id,
    //             'uom_id' => $asset->uom_id,

    //             // 'serial_number' => $asset->serial_number,
    //         ];
    //     }
    
    //     return response()->json([
    //         'data' => $data,
    //         'recordsTotal' => count($data),
    //         'recordsFiltered' => count($data),
    //     ]);
    // }


    public function getAjaxDataMovement() {

        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $user = Auth::user();
    
        $user_role = $user->role ?? null;
        $user_location = $user->location_now ?? null;
    
        if (!$user_role || !$user_location) {
            return response()->json(['error' => 'User data missing'], 400);
        }

        $dataMovementResto = DB::table('t_out')
    ->select(
        't_out.*',
        't_out_detail.*',
        'table_registrasi_asset.*',
        'm_assets.*',
        'm_user.*',
        'm_type.*',
        'm_category.*',
        'm_condition.*',
        'm_brand.*',
        'm_uom.*',
        'master_resto_v2.*',
        'm_layout.*',
        'm_supplier.*',
        'm_warranty.*',
        'm_periodic_mtc.*'
    )
    ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
    ->join('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
    ->join('m_user', 't_out.dest_loc', '=', 'm_user.location_now')
    ->join('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
    ->join('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
    ->join('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
    ->join('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
    ->join('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
    ->join('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
    ->join('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
    ->join('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
    ->join('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
    ->join('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
    ->join('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id') // Changed to left join
    ->where('m_user.location_now', $user_location)
    ->where('m_user.role', $user_role)
    ->get();


        // $dataMovementResto = DB::table('t_out')
        // ->select(
        //     't_out.*',
        //     't_out_detail.*',
        //     'm_user.*',
        //     'table_registrasi_asset.*',
        //     'm_assets.*'
        // )
        // ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
        // ->join('m_user', 't_out.dest_loc', '=', 'm_user.location_now')
        // ->join('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
        // ->join('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
        // ->where('t_out_detail.qty', '>', 0)
        // ->where('t_out.dest_loc', $locationUser)
        // ->where('m_user.role', '=', 'sm')
        // ->get();  


        // $dataMovementResto = DB::table('table_registrasi_asset')
        // ->select('table_registrasi_asset.id'
        //         ,'table_registrasi_asset.register_code'    
        //         ,'table_registrasi_asset.serial_number'
        //         ,'table_registrasi_asset.register_date'
        //         ,'table_registrasi_asset.purchase_date'
        //         ,'table_registrasi_asset.approve_status'
        //         ,'table_registrasi_asset.serial_number'
        //         ,'m_assets.asset_model'
        //         ,'m_type.type_name'
        //         ,'m_category.cat_name'
        //         ,'m_priority.priority_name'
        //         ,'m_brand.brand_name'
        //         ,'m_brand.brand_id'
        //         ,'m_uom.uom_name'
        //         ,'m_uom.uom_id'
        //         ,'master_resto_v2.name_store_street'
        //         ,'m_layout.layout_name'
        //         ,'m_supplier.supplier_name'
        //         ,'m_condition.condition_name'
        //         ,'m_warranty.warranty_name'
        //         ,'m_periodic_mtc.periodic_mtc_name'
        //         ,'table_registrasi_asset.deleted_at')
        // ->leftJoin('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
        // ->leftJoin('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
        // ->leftJoin('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
        // ->leftJoin('m_priority', 'table_registrasi_asset.prioritas', '=', 'm_priority.priority_code')
        // ->leftJoin('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
        // ->leftJoin('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
        // ->leftJoin('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
        // ->leftJoin('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
        // ->leftJoin('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
        // ->leftJoin('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
        // ->leftJoin('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
        // ->leftJoin('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
        // ->where('table_registrasi_asset.qty', '>', 0) 
        // ->get();
        
        
            return response()->json($dataMovementResto);
        }


    public function DataConfirmationSM() {
        
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
    
        $user = auth()->user();
        $user_location_now = $user->location_now;
        $user_role = $user->role;
    
        $query = DB::table('t_out')
    ->distinct()
    ->select(
        't_out.*',
        'm_reason.reason_name',
        'mc_approval.approval_name',
        'fromResto.name_store_street AS from_location',
        'toResto.name_store_street AS destination_location'
    )
    ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
    ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
    ->join('master_resto_v2 AS fromResto', 't_out.from_loc', '=', 'fromResto.id')
    ->join('master_resto_v2 AS toResto', 't_out.dest_loc', '=', 'toResto.id')
    ->join('m_user', 't_out.dest_loc', '=', 'm_user.location_now')
    ->where('t_out.appr_1', '=', '2')
    ->where('t_out.appr_2', '=', '2')
    ->where('t_out.appr_3', '=', '2')
    ->where('t_out.dest_loc', '=', $user_location_now);

    $moveins = $query->paginate(10);


        // dd($moveins);
    
        return view("SM.movement.confirm_data_movement_sm", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveins' => $moveins,
        ]);
    }


    public function updateDataConfirm(Request $request, $id)
{
    $request->validate([ 
        'is_confirm' => 'required|in:1,2,3',
    ]);

    $moveout = MasterMoveOut::find($id);

    if (!$moveout) {
        return response()->json(['status' => 'error', 'message' => 'MoveOut not found.'], 404);
    }

    $moveout->is_confirm = $request->is_confirm;

    // Update `t_out_detail` quantities based on confirmation
    if ($request->is_confirm == 3) {
        $details = DB::table('t_out_detail')->where('out_id', $moveout->out_id)->get();

        foreach ($details as $detail) {
            $newQtyContinue = max(0, $detail->qty_continue - $detail->qty_continue);
            $newQtyFinal = $detail->qty_total + $detail->qty_continue;

            DB::table('t_out_detail')
                ->where('out_det_id', $detail->out_det_id)
                ->update([
                    'qty_continue' => $newQtyContinue,
                    'qty_total' => $newQtyFinal,
                    'updated_at' => Carbon::now(),
                ]);
        }
    }

    if ($moveout->save()) {
        return response()->json([
            'status' => 'success',
            'message' => 'MoveOut updated successfully.',
            'redirect_url' => route('Admin.confirm'),
        ]);
    }

    return response()->json(['status' => 'error', 'message' => 'Failed to update MoveOut.'], 500);
}


    public function getAjaxMovementSMDetails($id) {
        
        $user = Auth::user();

        $user_role = $user->role ?? null;
        $user_location = $user->location_now ?? null;
    
        if (!$user_role || !$user_location) {
            return response()->json(['error' => 'User data missing'], 400);
        }

        $movementSM = DB::table('t_out')
        ->select(
            't_out.*',
            't_out_detail.*',
            'table_registrasi_asset.*',
            'm_assets.*',
            'm_user.*',
            'm_type.*',
            'm_category.*',
            'm_condition.*',
            'm_brand.*',
            'm_uom.*',
            'master_resto_v2.*',
            'm_layout.*',
            'm_supplier.*',
            'm_warranty.*',
            'm_periodic_mtc.*'
        )
        ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
        ->join('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
        ->join('m_user', 't_out.dest_loc', '=', 'm_user.location_now')
        ->leftJoin('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id') // Left join for assets
        ->leftJoin('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
        ->leftJoin('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
        ->leftJoin('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
        ->leftJoin('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
        ->leftJoin('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
        ->leftJoin('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
        ->leftJoin('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
        ->leftJoin('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
        ->leftJoin('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
        ->leftJoin('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
        ->where('table_registrasi_asset.id', $id) // Fetch data for specific asset
        ->where('m_user.location_now', $user_location)
        ->where('m_user.role', $user_role)
        ->first();
    

        // $movementSM = DB::table('t_out')
        // ->select(
        //         'table_registrasi_asset.register_code'    
        //         ,'table_registrasi_asset.serial_number'
        //         ,'table_registrasi_asset.register_date'
        //         ,'table_registrasi_asset.purchase_date'
        //         ,'table_registrasi_asset.approve_status'
        //         ,'table_registrasi_asset.serial_number'
        //         ,'table_registrasi_asset.qty'
        //         ,'m_assets.asset_model'
        //         ,'m_type.type_name'
        //         ,'m_category.cat_name'
        //         ,'m_priority.priority_name'
        //         ,'m_brand.brand_name'
        //         ,'m_brand.brand_id'
        //         ,'m_uom.uom_name'
        //         ,'m_uom.uom_id'
        //         ,'master_resto_v2.name_store_street'
        //         ,'m_layout.layout_name'
        //         ,'m_supplier.supplier_name'
        //         ,'m_condition.condition_name'
        //         ,'m_warranty.warranty_name'
        //         ,'m_periodic_mtc.periodic_mtc_name'
        //         ,'table_registrasi_asset.deleted_at'
        //         ,'m_user.role'
        //         ,'m_user.location_now'
        //         ,'t_out_detail.*'
        //         )
        //         ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
        //         ->join('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
        //         ->join('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
        //         ->join('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
        //         ->join('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
        //         ->join('m_priority', 'table_registrasi_asset.prioritas', '=', 'm_priority.priority_code')
        //         ->join('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
        //         ->join('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
        //         ->join('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
        //         ->join('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
        //         ->join('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
        //         ->join('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
        //         ->join('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
        //         ->join('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
        //         ->join('m_user', 't_out.dest_loc', '=', 'm_user.location_now')
        //         ->where('t_out_detail.qty', '>', 0)
        //         ->where('table_registrasi_asset.id',$id)
        //         ->where('m_user.role',$user_role)
        //         ->where('m_user.location_now',$user_location)
        //         ->first();

                if ($movementSM) {
                    return response()->json($movementSM);
                } else {
                    return response()->json(['Error' => 'Data Movement Not Found']);
                }
            }


    //disposal controller

    public function HalamanDisposalSM() {
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

            $moveouts = DB::table('t_out')
            ->distinct()
            ->select(
                't_out.*',
                't_transaction_qty.*',
                'm_reason.reason_name',
                'mc_approval.approval_name',
                'master_resto_v2.*',
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
            ->join('t_transaction_qty', 't_out.out_id', '=', 't_transaction_qty.out_id')
            ->join('m_uom', 't_transaction_qty.uom', '=', 'm_uom.uom_id')
            ->join('m_brand', 't_transaction_qty.brand', '=', 'm_brand.brand_id')
            ->join(
                'm_user',
                DB::raw('CONVERT(t_out.from_loc USING utf8mb4) COLLATE utf8mb4_unicode_ci'),
                '=',
                DB::raw('CONVERT(m_user.location_now USING utf8mb4) COLLATE utf8mb4_unicode_ci')
            )
            ->where('t_out.out_id', 'like', 'DA%')
            ->where(
                DB::raw('CONVERT(m_user.location_now USING utf8mb4) COLLATE utf8mb4_unicode_ci'),
                '=',
                $user_loc
            )
            ->paginate(10);
        

                // dd($moveouts);


return view("SM.disposal.lihat_data_disposal", [
    'fromLoc' => $fromLoc,
    'reasons' => $reasons,
    'assets' => $assets,
    'conditions' => $conditions,
    'approvals' => $approvals,
    'moveouts' => $moveouts,
    'restos' => $restos
]);
    }   


    public function HalamanAddDataDisposal() {

        $userLocation = auth()->user()->location_now;

        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name','fromResto.name_store_street as from_location', 
        'toResto.name_store_street as dest_location')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
        ->join('master_resto_v2 as fromResto', 't_out.from_loc', '=', 'fromResto.id') 
        ->join('master_resto_v2 as toResto', 't_out.dest_loc', '=', 'toResto.id') 
        ->get();

        return view('SM.disposal.add_data_disposal', [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'moveouts' => $moveouts,
        ]);
    }




    public function AddDataDisOut(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'out_date' => 'required|date',
            'from_loc' => 'required|string|max:255',
            'out_desc' => 'required|string|max:255',
            'reason_id' => 'required|string|max:255',
            'asset_id' => 'required|array',
            'register_code' => 'required|array',
            'serial_number' => 'required|array',
            'merk' => 'required|array',
            'qty' => 'required|array',
            'qty_disposal' => 'required|array', // Added validation for qty_disposal
            'satuan' => 'required|array',
            'condition_id' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        DB::beginTransaction();
    
        try {
            // Create MasterDisOut record
            $moveout = new MasterDisOut();
            $moveout->out_date = $request->input('out_date');
            $moveout->from_loc = $request->input('from_loc');
            $moveout->out_desc = $request->input('out_desc');
            $moveout->reason_id = $request->input('reason_id');
            $moveout->appr_1 = '1';
            $moveout->is_active = '1';
            $moveout->is_verify = '1';
            $moveout->is_confirm = '1';
            $moveout->create_by = Auth::user()->username;
    
            // Generate out_no
            $maxMoveoutId = MasterDisOut::max('out_no');
            $moveout->out_no = $maxMoveoutId ? $maxMoveoutId + 1 : 1;
    
            // Generate out_id with trx_code prefix
            $trx_code = DB::table('t_trx')->where('trx_name', 'Disposal Asset')->value('trx_code');
            $today = Carbon::now()->format('ymd');
            $todayDate = Carbon::now()->format('Y-m-d');
            $todayCount = MasterDisOut::whereDate('create_date', $todayDate)->count() + 1;
            $transaction_number = str_pad($todayCount, 3, '0', STR_PAD_LEFT);
            $out_id = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('from_loc')}.{$transaction_number}";
    
            $moveout->out_id = $out_id;
            $moveout->save();
    
            // Process each asset
            foreach ($request->input('asset_id') as $index => $assetId) {
                // Handle image upload if exists
                $imagePath = null;
                if ($request->hasFile("images.$index")) {
                    $image = $request->file("images.$index");
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads/image'), $imageName);
                    $imagePath = 'uploads/image/' . $imageName;
                }
    
                $qty = $request->input('qty')[$index];
                $qty_disposal = $request->input('qty_disposal')[$index];
    
                // Calculate quantities
                $qty_continue = $qty; // Original quantity becomes continue quantity
                $qty_total = $qty; // Total quantity is the original quantity
                $qty_difference = $qty - $qty_disposal; // Calculate difference
    
                // Insert into t_transaction_qty
                DB::table('t_transaction_qty')->insert([
                    'out_det_id' => $moveout->out_no,
                    'out_id' => $out_id,
                    'asset_id' => $assetId,
                    'asset_tag' => $request->input('register_code')[$index],
                    'serial_number' => $request->input('serial_number')[$index],
                    'from_loc' => $request->input('from_loc'),
                    'brand' => $request->input('merk')[$index],
                    'qty' => 0, // Set to 0 as it's being disposed
                    'qty_continue' => $qty_continue,
                    'qty_total' => 0,
                    'qty_disposal' => $qty_disposal,
                    'qty_difference' => 0,
                    'uom' => $request->input('satuan')[$index],
                    'condition' => $request->input('condition_id')[$index],
                    'image' => $imagePath,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
    
            DB::commit();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Data moveout berhasil ditambahkan',
                'redirect_url' => route('Admin.disout')
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
    
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }


    public function detailPageDataDisposalOut($id) {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();

        $moveOutAssets = DB::table('t_out')
        ->select(
            't_out.*',
            't_out.out_id',
            't_out_detail.out_id AS detail_out_id',
            't_out_detail.qty',
            'm_reason.reason_name',
            'master_resto_v2.name_store_street AS from_location'
        )
        ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('master_resto_v2', 't_out.from_loc', '=', 'master_resto_v2.id')
        ->where('t_out.out_id', '=', $id) 
        ->where('t_out.out_id', 'like', 'DA%')
        ->first();

        // dd($moveOutAssets);

        return view('SM.disposal.detail_data_disposal', compact('reasons', 'moveOutAssets'));
    }



    public function getAjaxDataDisposal() {
        $user = Auth::user();
    
        $user_role = $user->role ?? null;
        $user_location = $user->location_now ?? null;
    
        if (!$user_role || !$user_location) {
            return response()->json(['error' => 'User data missing'], 400);
        }
    
        $isConfirmExists = DB::table('t_out')
            ->where('is_confirm', 3)
            ->exists();
    
        if ($isConfirmExists) {
            // New query if t_out.is_confirm = 4

            $dataDisposalResto = DB::table('table_registrasi_asset')
            ->select(
                'table_registrasi_asset.*',
                'm_user.username',
                'm_assets.*',
                'm_user.*',
                'm_type.*',
                'm_category.*',
                'm_condition.*',
                'm_brand.*',
                'm_uom.*',
            )
            ->join('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
            ->join('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
            ->join('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
            ->join('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
            ->join('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
            ->join('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
            ->join('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
            ->join('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
            ->join('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
            ->join('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
            ->join('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
            ->join('m_user', 'table_registrasi_asset.register_location', '=', 'm_user.location_now')
            ->where('m_user.location_now', $user_location)
            ->where('m_user.role', $user_role)
            ->distinct() // Only distinct for selected columns
            ->get();
            
            // $dataDisposalResto = DB::table('t_out')
            //     ->select(
            //         't_out.*',
            //         't_out_detail.*',
            //         'table_registrasi_asset.*',
            //         'm_assets.*',
            //         'm_user.*',
            //         'm_type.*',
            //         'm_category.*',
            //         'm_condition.*',
            //         'm_brand.*',
            //         'm_uom.*',
            //         'master_resto_v2.*',
            //         'm_layout.*',
            //         'm_supplier.*',
            //         'm_warranty.*',
            //         'm_periodic_mtc.*'
            //     )
            //     ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
            //     ->join('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
            //     ->join('m_user', 't_out.dest_loc', '=', 'm_user.location_now')
            //     ->join('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
            //     ->join('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
            //     ->join('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
            //     ->join('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
            //     ->join('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
            //     ->join('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
            //     ->join('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
            //     ->join('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
            //     ->join('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
            //     ->join('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
            //     ->leftJoin('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
            //     ->where('t_out.is_confirm', 3) // Apply condition to only fetch confirmed records
            //     ->where('m_user.location_now', $user_location)
            //     ->where('m_user.role', $user_role)
            //     ->get();
        } else {
            $dataDisposalResto = DB::table('table_registrasi_asset')
            ->select(
                'table_registrasi_asset.*',
                'm_user.username',
                'm_assets.*',
                'm_user.*',
                'm_type.*',
                'm_category.*',
                'm_condition.*',
                'm_brand.*',
                'm_uom.*',
            )
            ->join('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
            ->join('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
            ->join('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
            ->join('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
            ->join('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
            ->join('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
            ->join('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
            ->join('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
            ->join('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
            ->join('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
            ->join('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
            ->join('m_user', 'table_registrasi_asset.register_location', '=', 'm_user.location_now')
            ->where('m_user.location_now', $user_location)
            ->where('m_user.role', $user_role)
            ->distinct() // Only distinct for selected columns
            ->get();
        }
    
        return response()->json($dataDisposalResto);
    }
    



        public function getAjaxDisposalSMDetails($id) {
        
            $user = Auth::user();
    
            $user_role = $user->role ?? null;
            $user_location = $user->location_now ?? null;
        
            if (!$user_role || !$user_location) {
                return response()->json(['error' => 'User data missing'], 400);
            }
    
            $movementSM = DB::table('t_out')
            ->select(
                't_out.*',
                't_out_detail.*',
                'table_registrasi_asset.*',
                'm_assets.*',
                'm_user.*',
                'm_type.*',
                'm_category.*',
                'm_condition.*',
                'm_brand.*',
                'm_uom.*',
                'master_resto_v2.*',
                'm_layout.*',
                'm_supplier.*',
                'm_warranty.*',
                'm_periodic_mtc.*'
            )
            ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
            ->join('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
            ->join('m_user', 't_out.dest_loc', '=', 'm_user.location_now')
            ->leftJoin('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id') // Left join for assets
            ->leftJoin('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
            ->leftJoin('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
            ->leftJoin('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
            ->leftJoin('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
            ->leftJoin('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
            ->leftJoin('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
            ->leftJoin('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
            ->leftJoin('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
            ->leftJoin('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
            ->leftJoin('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
            ->where('table_registrasi_asset.id', $id) // Fetch data for specific asset
            ->where('m_user.location_now', $user_location)
            ->where('m_user.role', $user_role)
            ->first();
    
                    if ($movementSM) {
                        return response()->json($movementSM);
                    } else {
                        return response()->json(['Error' => 'Data Movement Not Found']);
                    }
                }
                
                public function ajaxGetAssetDisposal(Request $request) {

                    if (!Auth::check()) {
                        return response()->json(['error' => 'Unauthorized'], 401);
                    }
                
                    $user = Auth::user();
                
                    $user_role = $user->role ?? null;
                    $user_location = $user->location_now ?? null;
                
                    if (!$user_role || !$user_location) {
                        return response()->json(['error' => 'User data missing'], 400);
                    }

                    $dataGetMovement = DB::table('table_registrasi_asset')
                    ->select(
                        'table_registrasi_asset.*',
                        'm_user.username',
                        'm_assets.*',
                        'm_user.*',
                        'm_type.*',
                        'm_category.*',
                        'm_condition.*',
                        'm_brand.*',
                        'm_uom.*',
                    )
                    ->join('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
                    ->join('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
                    ->join('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
                    ->join('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
                    ->join('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
                    ->join('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
                    ->join('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
                    ->join('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
                    ->join('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
                    ->join('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
                    ->join('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
                    ->join('m_user', 'table_registrasi_asset.register_location', '=', 'm_user.location_now')
                    ->where('m_user.location_now', $user_location)
                    ->where('m_user.role', $user_role)
                    ->distinct() // Only distinct for selected columns
                    ->get();

                    // $dataGetMovement =DB::table('t_out')
                    // ->select(
                    //     't_out.*',
                    //     't_out_detail.*',
                    //     'table_registrasi_asset.*',
                    //     'm_assets.*',
                    //     'm_user.*',
                    //     'm_type.*',
                    //     'm_category.*',
                    //     'm_condition.*',
                    //     'm_brand.*',
                    //     'm_uom.*',
                    //     'master_resto_v2.*',
                    //     'm_layout.*',
                    //     'm_supplier.*',
                    //     'm_warranty.*',
                    //     'm_periodic_mtc.*'
                    // )
                    // ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
                    // ->join('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
                    // ->join('m_user', 't_out.dest_loc', '=', 'm_user.location_now')
                    // ->join('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
                    // ->join('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
                    // ->join('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
                    // ->join('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
                    // ->join('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
                    // ->join('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
                    // ->join('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
                    // ->join('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
                    // ->join('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
                    // ->join('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
                    // ->leftJoin('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
                    // ->where('m_user.location_now', $user_location)
                    // ->where('m_user.role', $user_role)
                    // ->get();
                
                    // $dataGetMovement = DB::table('t_out')
                    //     ->select(
                    //         't_out.*',
                    //         't_out_detail.*',
                    //         'table_registrasi_asset.*',
                    //         'm_assets.*',
                    //         'm_user.*',
                    //         'm_type.*',
                    //         'm_category.*',
                    //         'm_condition.*',
                    //         'm_brand.*',
                    //         'm_uom.*',
                    //         'm_assets.*'
                    //     )
                    //     ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
                    //     ->join('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
                    //     ->join('m_user', 't_out.dest_loc', '=', 'm_user.location_now')
                    //     ->join('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
                    //     ->join('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
                    //     ->join('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
                    //     ->join('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
                    //     ->join('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
                    //     ->join('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
                    //     ->join('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
                    //     ->join('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
                    //     ->join('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
                    //     ->join('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
                    //     ->join('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
                    //     ->where('t_out_detail.qty', '>', 0)
                    //     ->where('m_user.location_now', $user_location)
                    //     ->where('m_user.role', $user_role)
                    //     ->get(); 
                
                        $data = []; 
                        foreach ($dataGetMovement as $item) {
                            $data[] = [
                                'id' => $item->id,
                                'register_code' => $item->register_code,
                                'asset_name' => $item->asset_model,
                                'merk' => $item->brand_name,
                                'qty' => $item->qty,
                                'satuan' => $item->uom_name,
                                'serial_number' => $item->serial_number,
                                'register_code' => $item->register_code,
                                'condition' => $item->condition_name,
                                'type_asset' => $item->type_name,
                                'category_asset' => $item->cat_name,
                                'condition' => $item->condition_name,
                                'width' => $item->width,
                                'height' => $item->height,
                                'depth' => $item->depth,
                                'brand_id' => $item->brand_id,
                                'uom_id' => $item->uom_id,
                
                            ];
                        }
                
                        return response()->json([
                            'data' => $data,
                            'recordsTotal' => count($data),
                            'recordsFiltered' => count($data),
                        ]);
                }


    public function HalamanConfirmDis() {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
    
        $user = auth()->user();
        $user_location_now = $user->location_now;
        $user_role = $user->role;

        $query = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
        ->join('master_resto_v2 AS fromResto', DB::raw('CONVERT(t_out.from_loc USING utf8mb4) COLLATE utf8mb4_unicode_ci'), '=', DB::raw('CONVERT(fromResto.id USING utf8mb4) COLLATE utf8mb4_unicode_ci'))
        ->join('t_transaction_qty', 't_out.out_id', '=', 't_transaction_qty.out_id')
        ->join('m_user', DB::raw('CONVERT(t_out.from_loc USING utf8mb4) COLLATE utf8mb4_unicode_ci'), '=', DB::raw('CONVERT(m_user.location_now USING utf8mb4) COLLATE utf8mb4_unicode_ci'))
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name', 'fromResto.name_store_street AS from_location', 'm_user.*', 't_transaction_qty.*')
        ->where('t_out.out_id', 'like', 'DA%')
        ->where('t_out.appr_1', '=', '2')
        ->where('t_out.appr_2', '=', '2')
        ->where('t_out.appr_3', '=', '2')
        ->where('m_user.location_now', $user_location_now)
        ->where('m_user.role', $user_role)
        ->whereNull('t_out.deleted_at');
    
    
        // $query = DB::table('t_out')
        //     ->distinct()
        //     ->select(
        //         't_out.*',
        //         't_transaction_qty.*',
        //         'm_reason.reason_name',
        //         'mc_approval.approval_name',
        //         'fromResto.name_store_street AS from_location',
        //         'toResto.name_store_street AS destination_location',
        //         'm_user.*',
        //     )
        //     ->join('t_transaction_qty', 't_out.out_id', '=', 't_transaction_qty.out_id')
        //     ->join('m_reason', DB::raw('t_out.reason_id COLLATE utf8mb4_unicode_ci'), '=', DB::raw('m_reason.reason_id COLLATE utf8mb4_unicode_ci'))
        //     ->join('mc_approval', DB::raw('t_out.is_confirm COLLATE utf8mb4_unicode_ci'), '=', DB::raw('mc_approval.approval_id COLLATE utf8mb4_unicode_ci'))
        //     ->join('master_resto_v2 AS fromResto', DB::raw('t_out.from_loc COLLATE utf8mb4_unicode_ci'), '=', DB::raw('fromResto.id COLLATE utf8mb4_unicode_ci'))
        //     ->join('master_resto_v2 AS toResto', DB::raw('t_out.dest_loc COLLATE utf8mb4_unicode_ci'), '=', DB::raw('toResto.id COLLATE utf8mb4_unicode_ci'))
        //     ->join('m_user', 't_out.dest_loc', '=', 'm_user.location_now')
        //     ->where('t_out.appr_1', '=', '2')
        //     ->where('t_out.appr_2', '=', '2')
        //     ->where('t_out.appr_3', '=', '2')
        //     ->where('t_out.out_id', 'like', 'DA%')
        //     ->where('m_user.location_now', $user_location_now)
        //     ->where('m_user.role', $user_role);
    
        // if ($user_role == 'am') {
        //     $query->where('t_out.dest_loc', $user_location_now);
        // } else {
        //     $query->where('t_out.from_loc', '!=', $user_location_now);
        // }
    
        $moveins = $query->paginate(10);

        // dd($moveins);
    
        return view("SM.disposal.confirmdis", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveins' => $moveins,
        ]);
    }


    public function updateDataConfirmDis(Request $request, $id)
{
    // Validate input
    $request->validate([
        'is_confirm' => 'required|string|max:255',
    ]);

    // Check if the record exists
    $movein = MasterDisOut::find($id);
    if (!$movein) {
        return response()->json(['status' => 'error', 'message' => 'movein not found.'], 404);
    }

    // Update is_confirm field in t_out
    $moveoutDetails = DB::table('t_out')->where('in_id', $movein->in_id)->get();

    foreach ($moveoutDetails as $detail) {
        DB::table('t_out')->where('in_id', $detail->in_id)->update([
            'is_confirm' => $request->is_confirm,  
        ]);
    }

    // Get related out_id from t_out table
    $outId = DB::table('t_out')
               ->where('in_id', $movein->in_id)
               ->value('out_id');

    if ($outId) {
        if ($request->is_confirm == '3') {
            // First get the transaction record to check values
            $transaction = DB::table('t_transaction_qty')
                ->where('out_id', $outId)
                ->first();

            if ($transaction) {
                $qty_continue = $transaction->qty_continue;
                $qty_disposal = $transaction->qty_disposal;

                // Only update if either qty_continue or qty_disposal has a value
                if ($qty_continue > 0 || $qty_disposal > 0) {
                    DB::table('t_transaction_qty')
                        ->where('out_id', $outId)
                        ->update([
                            'qty_total' => $qty_continue - $qty_disposal,
                            'qty_continue' => 0
                        ]);
                }
            }
        } elseif ($request->is_confirm == '4') {
            $transaction = DB::table('t_transaction_qty')
                ->where('out_id', $outId)
                ->first();

            if ($transaction && $transaction->qty_continue > 0) {
                DB::table('t_transaction_qty')
                    ->where('out_id', $outId)
                    ->update([
                        'qty' => $transaction->qty_continue,
                        'qty_continue' => 0,
                        'qty_disposal' => 0
                    ]);
            }
        }
    } else {
        return response()->json(['status' => 'error', 'message' => 'No related out_id found.'], 404);
    }

    // Save and return response
    if ($movein->save()) {
        return response()->json([
            'status' => 'success',
            'message' => 'moveout updated successfully.',
            'redirect_url' => url('/sm/confirmdis'),
        ]);
    } else {
        return response()->json(['status' => 'error', 'message' => 'Failed to update moveout.'], 500);
    }
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
        ->select('t_opname_header.*', 'master_resto_v2.name_store_street AS location_now', 't_opname_detail.qty_onhand', 't_opname_detail.qty_physical', 't_opname_detail.register_code', 'm_uom.uom_name', 't_opname_header.deleted_at')
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
        return view('SM.stockopname.laman_stock_opname', [
            'locId' => $locId,
            'reasons' => $reasons,
            'approvals' => $approvals,
            'assets' => $assets,
            'conditions' => $conditions,
            'uoms' => $uoms,
            'moveouts' => $paginatedMoveouts
        ]);
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



        return view('SM.stockopname.add_data_stockopname',[
            
            'fromLoc' => $fromLoc,

            'reasons' => $reasons,

            'assets' => $assets,
            
            'conditions' => $conditions,

            'moveouts' => $moveouts,

            'restos' => $restos
        ]);
    }

}
