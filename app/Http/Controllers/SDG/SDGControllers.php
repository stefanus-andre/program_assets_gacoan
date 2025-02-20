<?php 



namespace App\Http\Controllers\SDG;



use App\Http\Controllers\Controller;

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

use App\Models\Master\MasterDisOut;




class SDGControllers extends Controller {



    public function DashboardSDG() {

        return view('SDG.sdg_dashboard');

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

        return view("SDG.apprdisout-sdgasset", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveouts' => $moveouts
        ]);
    }


    public function updateDataAmd3(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'appr_3' => 'required|string|max:255',
    ]);

    // Cek apakah MoveOut dengan id yang benar ada
    $moveout = MasterDisOut::find($id);

    if (!$moveout) {
        return response()->json(['status' => 'error', 'message' => 'moveout not found.'], 404);
    }

    // Update data moveout
    $moveout->appr_3 = $request->appr_3;

    if ($request->appr_3 == '2') {
        $moveout->is_confirm = '4';

        // Insert into t_in and get the new ID
        $newInId = DB::table('t_in')->insertGetId([
            'out_id' => $moveout->out_id,
            'in_date' => $moveout->out_date,
            'from_loc' => $moveout->from_loc,
            'dest_loc' => $moveout->dest_loc,
            'out_desc' => $moveout->out_desc,
            'reason_id' => $moveout->reason_id,
            'appr_1' => 1, // Set appr_1 di tabel t_in menjadi 1
            'create_date' => now(),
            'modified_date' => now()
        ]);

        // Fetch all details from t_out_detail
        $moveoutDetails = DB::table('t_out_detail')->where('out_id', $moveout->out_id)->get();

        foreach ($moveoutDetails as $detail) {
            DB::table('t_in_detail')->insert([
                'in_id' => $newInId,  // Use new ID instead of moveout->in_id
                'in_det_id' => $detail->out_det_id,
                'asset_tag' => $detail->asset_tag,
                'asset_id' => $detail->asset_id,
                'serial_number' => $detail->serial_number,
                'brand' => $detail->brand,
                'qty' => $detail->qty,
                'uom' => $detail->uom,
                'condition' => $detail->condition,
            ]);
        }
    } elseif ($request->appr_3 == '4' && $moveout->appr_2 == '4') {
        $moveout->is_confirm = '4';

        // Update t_out_detail and adjust qty in table_registrasi_asset
        $details = DB::table('t_out_detail')->where('out_id', $id)->get();

        foreach ($details as $detail) {
            DB::table('t_out_detail')
                ->where('out_id', $id)
                ->where('asset_id', $detail->asset_id)
                ->update(['status' => 4]);

            DB::table('table_registrasi_asset')
                ->where('id', $detail->asset_id)
                ->increment('qty', $detail->qty);
        }
    }

    if ($moveout->save()) {
        return response()->json([
            'status' => 'success',
            'message' => 'moveout updated successfully.',
            'redirect_url' => route('Admin.apprdis-sdgasset'),
        ]);
    } else {
        return response()->json(['status' => 'error', 'message' => 'Failed to update moveout.'], 500);
    }
}

} 