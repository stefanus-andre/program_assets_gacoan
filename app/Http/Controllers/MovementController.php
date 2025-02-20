<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterMoveOut;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovementController extends Controller
{
    public function Index()
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->join('mc_approval', 't_out.appr_1', '=', 'mc_approval.approval_id')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')
        ->paginate(10);

        return view("Admin.movement", [
            'reasons' => $reasons,
            'approvals' => $approvals,
            'assets' => $assets,
            'conditions' => $conditions,
            'moveouts' => $moveouts
        ]);
    }

    public function Index1()
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->join('mc_approval', 't_out.appr_1', '=', 'mc_approval.approval_id')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('master_resto_v2 as fromResto', 't_out.from_loc', '=', 'fromResto.id') // Alias for from_loc
            ->join('master_resto_v2 as toResto', 't_out.dest_loc', '=', 'toResto.id')   // Alias for dest_loc
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name',
                'fromResto.name_store_street as from_location', 
                'toResto.name_store_street as dest_location'
        )
        ->whereIn('appr_1', ['1', '2', '3', '4'])
        ->whereNull('t_out.deleted_at')
        ->paginate(10);

        return view("Admin.apprmoveout-am", [
            'reasons' => $reasons,
            'approvals' => $approvals,
            'assets' => $assets,
            'conditions' => $conditions,
            'moveouts' => $moveouts
        ]);
    }

    public function HalamanMove() 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->join('mc_approval', 't_out.appr_1', '=', 'mc_approval.approval_id')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')
        ->whereNull('t_out.deleted_at')
        ->paginate(10);

        return view("Admin.movement", [
            'reasons' => $reasons,
            'approvals' => $approvals,
            'assets' => $assets,
            'conditions' => $conditions,
            'moveouts' => $moveouts
        ]);
    }

    public function HalamanAmo1() 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->join('mc_approval', 't_out.appr_1', '=', 'mc_approval.approval_id')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('master_resto_v2 as fromResto', 't_out.from_loc', '=', 'fromResto.id') // Alias for from_loc
        ->join('master_resto_v2 as toResto', 't_out.dest_loc', '=', 'toResto.id')   // Alias for dest_loc
        ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id') 
        ->select('t_out.*', 't_out_detail.*', 'm_reason.reason_name', 'mc_approval.approval_name', 
                'fromResto.name_store_street as from_location', 
                'toResto.name_store_street as dest_location',
        )
        ->whereIn('appr_1', ['1', '2', '3', '4'])
        ->whereNull('t_out.deleted_at')
        ->paginate(10);

        return view("Admin.apprmoveout-am", [
            'reasons' => $reasons,
            'approvals' => $approvals,
            'assets' => $assets,
            'conditions' => $conditions,
            'moveouts' => $moveouts
        ]);
    }
    
    public function Index2()
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->join('mc_approval', 't_out.appr_2', '=', 'mc_approval.approval_id')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('master_resto_v2 as fromResto', 't_out.from_loc', '=', 'fromResto.id') // Alias for from_loc
        ->join('master_resto_v2 as toResto', 't_out.dest_loc', '=', 'toResto.id')   // Alias for dest_loc
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name', 
                'fromResto.name_store_street as from_location', 
                'toResto.name_store_street as dest_location',
        )
        ->whereIn('appr_1', ['1', '2', '3', '4'])
        ->paginate(10);

        return view("Admin.apprmoveout-rm", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveouts' => $moveouts
        ]);
    }

    public function HalamanAmo2() 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->join('mc_approval', 't_out.appr_2', '=', 'mc_approval.approval_id')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('master_resto_v2 as fromResto', 't_out.from_loc', '=', 'fromResto.id') // Alias for from_loc
        ->join('master_resto_v2 as toResto', 't_out.dest_loc', '=', 'toResto.id')   // Alias for dest_loc
        ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id') 
        ->select('t_out.*', 't_out_detail.*', 'm_reason.reason_name', 'mc_approval.approval_name', 
                'fromResto.name_store_street as from_location', 
                'toResto.name_store_street as dest_location',
        )
        ->whereIn('appr_1', ['1', '2', '3', '4'])
        ->paginate(10);

        return view("Admin.apprmoveout-rm", [
            'reasons' => $reasons, 
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveouts' => $moveouts
        ]);
    }
    
    public function Index3()
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->join('mc_approval', 't_out.appr_3', '=', 'mc_approval.approval_id')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('master_resto_v2 as fromResto', 't_out.from_loc', '=', 'fromResto.id') // Alias for from_loc
        ->join('master_resto_v2 as toResto', 't_out.dest_loc', '=', 'toResto.id')   // Alias for dest_loc
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name',
                'fromResto.name_store_street as from_location', 
                'toResto.name_store_street as dest_location'
        )
        ->whereIn('appr_1', ['1', '2', '3', '4'])
        ->paginate(10);

        return view("Admin.apprmoveout-sdgasset", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveouts' => $moveouts
        ]);
    }

    public function HalamanAmo3() 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->join('mc_approval', 't_out.appr_3', '=', 'mc_approval.approval_id')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('master_resto_v2 as fromResto', 't_out.from_loc', '=', 'fromResto.id') // Alias for from_loc
        ->join('master_resto_v2 as toResto', 't_out.dest_loc', '=', 'toResto.id')   // Alias for dest_loc
        ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id') 
        ->select('t_out.*', 't_out_detail.*', 'm_reason.reason_name', 'mc_approval.approval_name', 
                'fromResto.name_store_street as from_location', 
                'toResto.name_store_street as dest_location',
        )
        ->whereIn('appr_1', ['1', '2', '3', '4'])
        ->paginate(10);

        return view("Admin.apprmoveout-sdgasset", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveouts' => $moveouts
        ]);
    }
    
    public function HalamanHead() 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $delivery = DB::table('t_transit')->select('transit_id')->get();
        $moveins = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('t_in', 't_out.out_id', '=', 't_in.out_id')
        ->join('mc_approval', 't_in.is_confirm', '=', 'mc_approval.approval_id')
        ->join('t_in_detail', 't_in_detail.in_id', '=', 't_in.in_id')
        ->join('t_transit', 't_in_detail.in_det_id', '=', 't_transit.in_det_id')
        ->select('t_out.*', 't_in.*', 't_in_detail.*', 't_transit.*', 'm_reason.reason_name', 'mc_approval.approval_name', 't_in.is_confirm')
        ->where('t_out.appr_3', '=', '2')
        ->paginate(10);

        return view("Admin.rev-head", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveins' => $moveins,
            'delivery' => $delivery
        ]);
    }
    
    public function HalamanMnr() 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $delivery = DB::table('t_transit')->select('transit_id')->get();
        $moveins = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('t_in', 't_out.out_id', '=', 't_in.out_id')
        ->join('mc_approval', 't_in.is_confirm', '=', 'mc_approval.approval_id')
        ->join('t_in_detail', 't_in_detail.in_id', '=', 't_in.in_id')
        ->join('t_transit', 't_in_detail.in_det_id', '=', 't_transit.in_det_id')
        ->select('t_out.*', 't_in.*', 't_in_detail.*', 't_transit.*', 'm_reason.reason_name', 'mc_approval.approval_name', 't_in.is_confirm')
        ->where('t_out.appr_3', '=', '2')
        ->paginate(10);

        return view("Admin.rev-mnr", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveins' => $moveins,
            'delivery' => $delivery
        ]);
    }
    
    public function HalamanTaf() 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $delivery = DB::table('t_transit')->select('transit_id')->get();
        $moveins = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('t_in', 't_out.out_id', '=', 't_in.out_id')
        ->join('mc_approval', 't_in.is_confirm', '=', 'mc_approval.approval_id')
        ->join('t_in_detail', 't_in_detail.in_id', '=', 't_in.in_id')
        ->join('t_transit', 't_in_detail.in_det_id', '=', 't_transit.in_det_id')
        ->select('t_out.*', 't_in.*', 't_in_detail.*', 't_transit.*', 'm_reason.reason_name', 'mc_approval.approval_name', 't_in.is_confirm')
        ->where('t_out.appr_3', '=', '2')
        ->paginate(10);

        return view("Admin.rev-taf", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveins' => $moveins,
            'delivery' => $delivery
        ]);
    }

    public function getAmo1()
    {
        // Mengambil semua data dari tabel t_out
        $moveouts = MasterMoveOut::all();
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

    public function updateDataAmo1(Request $request, $id) {
    $moveout = MasterMoveOut::find($id);

    if (!$moveout) {
        return response()->json(['status' => 'error', 'message' => 'Moveout not found.'], 404);
    }


    $moveout->appr_1_date = Carbon::now();
    $moveout->appr_1 = $request->appr_1;
    $moveout->appr_1_user = auth()->user()->username;

    if ($request->appr_1 == '2') {
        $moveout->appr_2 = '1';
    } elseif ($request->appr_1 == '4') {
        $moveout->is_confirm = '4';


        DB::table('t_out_detail')
            ->where('out_id', $id)
            ->update(['status' => 4]);

        // Fetch details
        $details = DB::table('t_out_detail')
            ->where('out_id', $id)
            ->get();

        foreach ($details as $detail) {
            if (!isset($detail->id)) {
                continue;
            }

            // Reduce qty and store in qty_final
            $newQty = max(0, $detail->qty - 1);
            DB::table('t_out_detail')
                ->where('id', $detail->id)
                ->update([
                    'qty' => $newQty,
                    'qty_final' => $detail->qty,
                ]);

            // Increment qty in table_registrasi_asset
            DB::table('table_registrasi_asset')
                ->where('id', $detail->asset_id)
                ->increment('qty', 1);
        }

        // Update t_transaction_qty
        $transactions = DB::table('t_transaction_qty')
            ->where('out_id', $id)
            ->get();

        foreach ($transactions as $transaction) {
            // If appr_1 is 4, move qty_continue back to qty
            if ($request->appr_1 == '4') {
                DB::table('t_transaction_qty')
                    ->where('id', $transaction->id)
                    ->update([
                        'qty' => $transaction->qty_continue,
                        'qty_continue' => 0,
                        'qty_disposal' => 0
                    ]);
            }
        }
    } elseif ($request->appr_1 == '2') {
        
    }

    if ($moveout->save()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Moveout updated successfully.',
            'redirect_url' => url('/admin/apprmoveout-am'),
        ]);
    } else {
        return response()->json(['status' => 'error', 'message' => 'Failed to update moveout.'], 500);
    }
}


    
    
    


    

    public function updateDataAmo2(Request $request, $id)
    {
        $moveout = MasterMoveOut::find($id); 

        if (!$moveout) {
            return response()->json(['status' => 'error', 'message' => 'moveout not found.'], 404);
        }

        // Update data moveout
        $moveout->appr_2_date = Carbon::now();
        $moveout->appr_2 = $request->appr_2;
        $moveout->appr_2_user = auth()->user()->username;

        if ($request->appr_2 == '2') {
            $moveout->appr_3 = '1'; 
        } elseif ($request->appr_2 == '4') {
            $moveout->is_confirm = '4';
    
            DB::table('t_out_detail')
            ->where('out_id', $id)
            ->update(['status' => 4]);

        // Fetch details
        $details = DB::table('t_out_detail')
            ->where('out_id', $id)
            ->get();

        foreach ($details as $detail) {
            if (!isset($detail->id)) {
                continue;
            }

            // Reduce qty and store in qty_final
            $newQty = max(0, $detail->qty - 1);
            DB::table('t_out_detail')
                ->where('id', $detail->id)
                ->update([
                    'qty' => $newQty,
                    'qty_final' => $detail->qty,
                ]);

            // Increment qty in table_registrasi_asset
            DB::table('table_registrasi_asset')
                ->where('id', $detail->asset_id)
                ->increment('qty', 1);
        }

        // Update t_transaction_qty
        $transactions = DB::table('t_transaction_qty')
            ->where('out_id', $id)
            ->get();

        foreach ($transactions as $transaction) {
            // If appr_1 is 4, move qty_continue back to qty
            if ($request->appr_2 == '4') {
                DB::table('t_transaction_qty')
                    ->where('id', $transaction->id)
                    ->update([
                        'qty' => $transaction->qty_continue,
                        'qty_continue' => 0,
                        'qty_disposal' => 0
                    ]);
            }
        }
    } elseif ($request->appr_2 == '2') {

    }
        
        if ($moveout->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'moveout updated successfully.',
                'redirect_url' => url('/admin/apprmoveout-rm'),
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update moveout.'], 500);
        }
    }


    public function updateDataAmo3(Request $request, $id)
    {
        try {
            // Validate request input
            $request->validate([
                'appr_3' => 'required|string|max:255',
            ]);
    
            // Find the MasterMoveOut record
            $moveout = MasterMoveOut::find($id);
    
            if (!$moveout) {
                return response()->json(['status' => 'error', 'message' => 'MoveOut not found.'], 404);
            }
    
            // Get transaction codes
            $trx_code = DB::table('t_trx')->where('trx_name', 'Confirmation Movement')->value('trx_code');
            $trx_code_1 = DB::table('t_trx')->where('trx_name', 'Transfer')->value('trx_code');
            $today = Carbon::now()->format('ymd');
            $transaction_number = 1;
    
            // Update the moveout data
            $moveout->appr_3_date = Carbon::now();
            $moveout->appr_3 = $request->appr_3;
            $moveout->appr_3_user = auth()->user()->username;
    
            // Generate new in_id and tf_code
            $new_in_id = null;
            $new_tf_code = null;
            do {
                $transaction_number_str = str_pad($transaction_number, 3, '0', STR_PAD_LEFT);
                $new_in_id = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('from_loc_id')}.{$transaction_number_str}";
                $new_tf_code = "{$trx_code_1}.{$today}.{$request->input('reason_id')}.{$request->input('from_loc_id')}.{$transaction_number_str}";
    
                $existing_in_id = DB::table('t_in')->where('in_id', $new_in_id)->exists();
                $existing_tf_code = DB::table('t_out')->where('tf_code', $new_tf_code)->exists();
    
                if ($existing_in_id && $existing_tf_code) {
                    $transaction_number++;
                }
            } while ($existing_in_id && $existing_tf_code);
    
            $moveout->in_id = $new_in_id;
            $moveout->tf_code = $new_tf_code;
    
            // Check approval and process accordingly
            if ($request->appr_3 == '2' && $moveout->appr_2 == '2') {
                // Insert into t_in
                DB::table('t_in')->insert([
                    'in_id' => $new_in_id,
                    'out_id' => $moveout->out_id,
                    'in_date' => $moveout->out_date,
                    'from_loc' => $moveout->dest_loc,
                    'out_desc' => $moveout->out_desc,
                    'reason_id' => $moveout->reason_id,
                    'appr_1' => 1,
                    'create_date' => now(),
                    'modified_date' => now()
                ]);
    
                // Get the moveout details
                $moveoutDetails = DB::table('t_out_detail')->where('out_id', $moveout->out_id)->get();
    
                $previous_asset_tag = null;
                foreach ($moveoutDetails as $index => $detail) {
                    if ($previous_asset_tag !== $detail->asset_tag) {
                        $transaction_number++;
                        $transaction_number_str = str_pad($transaction_number, 3, '0', STR_PAD_LEFT);
                        $new_in_id = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('from_loc_id')}.{$transaction_number_str}";
                        $previous_asset_tag = $detail->asset_tag;
                    }
    
                    $existing_detail = DB::table('t_in_detail')
                        ->where('in_id', $new_in_id)
                        ->where('asset_tag', $detail->asset_tag)
                        ->exists();
    
                    if (!$existing_detail) {
                        DB::table('t_in_detail')->insert([
                            'in_id' => $new_in_id,
                            'in_det_id' => $detail->out_det_id,
                            'asset_tag' => $detail->asset_tag,
                            'asset_id' => $detail->asset_id,
                            'serial_number' => $detail->serial_number,
                            'brand' => $detail->brand,
                            'qty' => $detail->qty,
                            'uom' => $detail->uom,
                            'condition' => $detail->condition,
                            'image' => $detail->image,
                        ]);
                    }
                }
            } elseif ($request->appr_3 == '4') {
                $moveout->is_confirm = '4';
                $moveout->in_id = null;
    
                DB::table('t_out_detail')
                    ->where('out_id', $id)
                    ->update(['status' => 4]);
    
                $details = DB::table('t_out_detail')
                    ->where('out_id', $id)
                    ->get();
    
                foreach ($details as $detail) {
                    if (!isset($detail->id)) {
                        continue;
                    }
    
                    $newQty = max(0, $detail->qty - 1);
                    DB::table('t_out_detail')
                        ->where('id', $detail->id)
                        ->update([
                            'qty' => $newQty,
                            'qty_final' => $detail->qty,
                        ]);
    
                    DB::table('table_registrasi_asset')
                        ->where('id', $detail->asset_id)
                        ->increment('qty', 1);
                }
    
                $transactions = DB::table('t_transaction_qty')
                    ->where('out_id', $id)
                    ->get();
    
                foreach ($transactions as $transaction) {
                    DB::table('t_transaction_qty')
                        ->where('id', $transaction->id)
                        ->update([
                            'qty' => $transaction->qty_continue,
                            'qty_continue' => 0,
                            'qty_disposal' => 0
                        ]);
                }
            }
    
            if ($moveout->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'MoveOut updated successfully.',
                    'redirect_url' => url('/admin/apprmoveout-sdgasset'),
                ]);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Failed to update MoveOut.'], 500);
            }
        } catch (\Exception $e) {
            \Log::error('Error updating MoveOut: ' . $e->getMessage());
    
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating MoveOut.',
                'error_details' => $e->getMessage(),
            ], 500);
        }
    }
    

    
    

    


    // public function updateDataAmo3(Request $request, $id)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'appr_3' => 'required|string|max:255',
    //     ]);
    
    //     // Cek apakah MoveOut dengan id yang benar ada
    //     $moveout = MasterMoveOut::find($id); // Langsung gunakan find jika ID adalah primary key
    
    //     if (!$moveout) {
    //         return response()->json(['status' => 'error', 'message' => 'MoveOut not found.'], 404);
    //     }
    
    //     $trx_code = DB::table('t_trx')->where('trx_name', 'Confirmation Movement')->value('trx_code');
    
    //     // Update data moveout
    //     $moveout->appr_3_date = Carbon::now();
    //     $moveout->appr_3 = $request->appr_3;


    //     $today = Carbon::now()->format('ymd');
    //     $todayCount = MasterMoveOut::whereDate('create_date', Carbon::now())->count() + 1;
    //     $transaction_number = str_pad($todayCount, 3, '0', STR_PAD_LEFT);
    //     $moveout->in_id = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('from_loc_id')}.{$transaction_number}";
    
    
    //     if ($request->appr_3 == '2' && $moveout->appr_2 == '2') {
    //         // $moveout->is_confirm = '3';
    
    //         // $trx_code = DB::table('t_trx')->where('trx_name', 'Asset Movement')->value('trx_code');
    //         // $lastTransaction = DB::table('t_out')
    //         //     ->where('out_id', 'like', "{$trx_code}.{$today}.%")
    //         //     ->orderBy('out_id', 'desc')
    //         //     ->value('out_id');
    
    //         // $transaction_number = $lastTransaction ? intval(substr($lastTransaction, -3)) + 1 : 1;
    //         // $transaction_number_str = str_pad($transaction_number, 3, '0', STR_PAD_LEFT);

    //         $today = Carbon::now()->format('ymd');
    //         $todayCount = MasterMoveOut::whereDate('create_date', Carbon::now())->count() + 1;
    //         $transaction_number = str_pad($todayCount, 3, '0', STR_PAD_LEFT);
    //         $moveout->in_id = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('from_loc_id')}.{$transaction_number}";
        
    
    //         // $in_id = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('from_loc_id')}.{$transaction_number}";
    
    //         $newInId = DB::table('t_in')->insertGetId([
    //             'in_id' => $moveout->in_id,
    //             'out_id' => $moveout->out_id,
    //             'in_date' => $moveout->out_date,
    //             'from_loc' => $moveout->from_loc,
    //             'dest_loc' => $moveout->dest_loc,
    //             'out_desc' => $moveout->out_desc,
    //             'reason_id' => $moveout->reason_id,
    //             'appr_1' => 1,
    //             'create_date' => now(),
    //             'modified_date' => now()
    //         ]);
    
    //         $moveoutDetails = DB::table('t_out_detail')->where('out_id', $moveout->out_id)->get();
    
    //         foreach ($moveoutDetails as $detail) {
    //             DB::table('t_in_detail')->insert([
    //                 'in_id' =>  $moveout->in_id,
    //                 'in_det_id' => $detail->out_det_id,
    //                 'asset_tag' => $detail->asset_tag,
    //                 'asset_id' => $detail->asset_id,
    //                 'serial_number' => $detail->serial_number,
    //                 'brand' => $detail->brand,
    //                 'qty' => $detail->qty,
    //                 'uom' => $detail->uom,
    //                 'condition' => $detail->condition,
    //             ]);
    //         }
    //     } elseif ($request->appr_3 == '4' && $moveout->appr_2 == '4') {
    //         $moveout->is_confirm = '4';
    
    //         // Update t_out_detail and adjust qty in table_registrasi_asset
    //         $details = DB::table('t_out_detail')->where('out_id', $id)->get();
    
    //         foreach ($details as $detail) {
    //             DB::table('t_out_detail')
    //                 ->where('out_id', $id)
    //                 ->where('asset_id', $detail->asset_id)
    //                 ->update(['status' => 4]);
    
    //             DB::table('table_registrasi_asset')
    //                 ->where('id', $detail->asset_id)
    //                 ->increment('qty', $detail->qty);
    //         }
    //     }
    
    //     if ($moveout->save()) {
    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'MoveOut updated successfully.',
    //             'redirect_url' => route('Admin.apprmoveout-sdgasset'),
    //         ]);
    //     } else {
    //         return response()->json(['status' => 'error', 'message' => 'Failed to update MoveOut.'], 500);
    //     }
    // }
    


    public function deleteDataAmo1($id)
    {
        $moveout = MasterMoveOut::find($id);

        if ($moveout) {
            $moveout->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'moveout deleted successfully.',
                'redirect_url' => route('Admin.apprmoveout-am')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data moveout Gagal Terhapus'], 404);
        }
    }


    public function details1($MoveOutId)
    {
        $moveout = MasterMoveOut::where('out_id', $MoveOutId)->first();

        if (!$moveout) {
            abort(404, 'moveout not found');
        }

        return view('moveout.details', ['asset' => $moveout]);
    }


    

}
