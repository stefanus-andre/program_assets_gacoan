<?php 

namespace App\Http\Controllers\SDG;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class SDGControllers extends Controller {

    public function Index()
    {
        $location = auth()->user()->location_now;

        $total_asset = DB::table('t_transaction_qty')
        ->where('from_loc', '=', $location, 'AND')
        ->sum('qty');

        $bad_asset = DB::table('t_transaction_qty')
        ->whereIn('condition', [2, 4])
        ->sum('qty');


        $good_asset = DB::table('t_transaction_qty')
        ->whereIn('condition', [1, 3])
        ->sum('qty');


        $total_resto = DB::table('master_resto_v2')
        ->count();
        
        return view("SDG.sdg_dashboard", [
            'totalAsset' => $total_asset,
            'badAsset' => $bad_asset,
            'goodAsset' => $good_asset,
            'totalResto' => $total_resto
        ]);
    }

    public function getDataResto(Request $request)
    {
        $dataQuery = DB::table('t_transaction_qty')
        
        ->join('m_assets', 't_transaction_qty.asset_id', '=', 'm_assets.asset_id')

        ->join('master_resto_v2', 't_transaction_qty.from_loc', '=', 'master_resto_v2.id')

        ->join('t_out', 't_transaction_qty.out_id', '=', 't_out.out_id')
        
        ->join('m_condition', 't_transaction_qty.condition', '=', 'm_condition.condition_id')

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

    public function HalamanAmd3() 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.appr_3', '=', 'mc_approval.approval_id')
        ->join('master_resto_v2 AS from_loc', 't_out.from_loc', '=', 'from_loc.id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name',
        'from_loc.name_store_street AS from_location'
        )
        ->where('t_out.out_id', 'like', 'DA%')
        ->whereIn('t_out.appr_3', ['1', '2', '3', '4'])
        ->whereNull('t_out.deleted_at')
        ->paginate(10);

        return view("SDG.disposal.apprdis-sdgasset", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveouts' => $moveouts
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

        return view('SDG.disposal.detail_data_disposal', compact('reasons', 'moveOutAssets', 'assets'));
    }
} 