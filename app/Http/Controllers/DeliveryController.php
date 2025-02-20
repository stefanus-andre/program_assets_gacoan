<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterDelivery;
use App\Models\Master\MasterMoveIn;
use App\Models\Master\MasterMoveOut;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeliveryController extends Controller
{
    public function Index()
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $delivery = DB::table('t_transit')->select('transit_id')->get();
        $moveins = DB::table('t_out')
        ->leftjoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->leftjoin('t_in', 't_out.out_id', '=', 't_in.out_id')
        ->leftjoin('mc_approval', 't_in.is_confirm', '=', 'mc_approval.approval_id')
        ->leftjoin('t_in_detail', 't_in_detail.in_id', '=', 't_in.in_id')
        ->leftjoin('t_transit', 't_in_detail.in_det_id', '=', 't_transit.in_det_id')
        ->select('t_out.*', 't_in.*', 't_in_detail.*', 't_transit.*', 'm_reason.reason_name', 'mc_approval.approval_name', 't_in.is_confirm')
        ->where('t_out.appr_3', '=', '2')
        ->paginate(10);

        return view("Admin.delivery", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveins' => $moveins,
            'delivery' => $delivery
        ]);
    }

    public function HalamanDelivery() 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $delivery = DB::table('t_transit')->select('transit_id')->get();
        $moveins = DB::table('t_out')
        ->leftjoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->leftjoin('t_in', 't_out.out_id', '=', 't_in.out_id')
        ->leftjoin('mc_approval', 't_in.is_confirm', '=', 'mc_approval.approval_id')
        ->leftjoin('t_in_detail', 't_in_detail.in_id', '=', 't_in.in_id')
        ->leftjoin('t_transit', 't_in_detail.in_det_id', '=', 't_transit.in_det_id')
        ->select('t_out.*', 't_in.*', 't_in_detail.*', 't_transit.*', 'm_reason.reason_name', 'mc_approval.approval_name', 't_in.is_confirm')
        ->where('t_out.appr_3', '=', '2')
        ->paginate(10);

        return view("Admin.delivery", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveins' => $moveins,
            'delivery' => $delivery
        ]);
    }

    public function IndexConfirm()
    {

        $moveins = DB::table('t_out')
        ->select('t_out.*',  
        'm_reason.reason_name',
        'mc_approval.approval_name',
        'master_resto_v2.name_store_street AS from_location')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
        ->join('master_resto_v2', 't_out.from_loc', '=', 'master_resto_v2.name_store_street')
        ->whereIn('t_out.is_confirm', [6, 7, 3, 'NULL'])
        ->paginate(10);

        // $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        // $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        // $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        // $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        // $delivery = DB::table('t_transit')->select('transit_id')->get();
        // $moveins = DB::table('t_out')
        // ->leftjoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        // ->leftjoin('t_in', 't_out.out_id', '=', 't_in.out_id')
        // ->leftjoin('mc_approval', 't_in.is_confirm', '=', 'mc_approval.approval_id')
        // ->leftjoin('t_in_detail', 't_in_detail.in_id', '=', 't_in.in_id')
        // ->leftjoin('t_transit', 't_in_detail.in_det_id', '=', 't_transit.in_det_id')
        // ->select('t_out.*', 't_in.*', 't_in_detail.*', 't_transit.*', 'm_reason.reason_name', 'mc_approval.approval_name', 't_in.is_confirm')
        // ->whereIn('t_in.is_confirm', [6, 7, 3, 'NULL'])
        // ->paginate(10);

        dd($moveins);

        // return view("Admin.confirm", [
        //     'reasons' => $reasons,
        //     'assets' => $assets,
        //     'conditions' => $conditions,
        //     'approvals' => $approvals,
        //     'moveins' => $moveins,
        //     // 'delivery' => $delivery
        // ]);
    }

    public function HalamanConfirm() 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
    
        // $user = auth()->user();
        // $user_location_now = $user->location_now;
        // $user_role = $user->role;
    
        $query = DB::table('t_out')
            ->distinct()
            ->select(
                't_out.*',
                't_out_detail.*',
                'm_reason.reason_name',
                'mc_approval.approval_name',
                'fromResto.name_store_street AS from_location',
                'toResto.name_store_street AS destination_location'
            )
            ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
            ->join('m_reason', DB::raw('t_out.reason_id COLLATE utf8mb4_unicode_ci'), '=', DB::raw('m_reason.reason_id COLLATE utf8mb4_unicode_ci'))
            ->join('mc_approval', DB::raw('t_out.is_confirm COLLATE utf8mb4_unicode_ci'), '=', DB::raw('mc_approval.approval_id COLLATE utf8mb4_unicode_ci'))
            ->join('master_resto_v2 AS fromResto', DB::raw('t_out.from_loc COLLATE utf8mb4_unicode_ci'), '=', DB::raw('fromResto.id COLLATE utf8mb4_unicode_ci'))
            ->join('master_resto_v2 AS toResto', DB::raw('t_out.dest_loc COLLATE utf8mb4_unicode_ci'), '=', DB::raw('toResto.id COLLATE utf8mb4_unicode_ci'))
            ->where('t_out.appr_1', '=', '2')
            ->where('t_out.appr_2', '=', '2')
            ->where('t_out.appr_3', '=', '2'); 
    
        // if ($user_role == 'am') {
        //     $query->where('t_out.dest_loc', $user_location_now);
        // } else {
        //     $query->where('t_out.from_loc', '!=', $user_location_now);
        // }
    
        $moveins = $query->paginate(10);
    
        return view("Admin.confirm", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveins' => $moveins,
        ]);
    }

    

    public function showPutForm($id)
    {
    $moveout = MasterDelivery::find($id); // Fetch the moveout record by ID

    if (!$moveout) {
        return response()->json(['status' => 'error', 'message' => 'Moveout not found.'], 404);
    }

    // Return the moveout data
    return response()->json(['status' => 'success', 'data' => $moveout]);
}


    public function getDelivery()
    {
        // Mengambil semua data dari tabel t_in
        $moveins = MasterDelivery::all();
        return response()->json($moveins); // Mengembalikan data dalam format JSON
    }

    public function getConfirm()
    {
        // Mengambil semua data dari tabel t_in
        $moveins = MasterDelivery::all();
        return response()->json($moveins); // Mengembalikan data dalam format JSON
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
        // Fetch data from t_in and t_in_detail based on the out_id
        $moveOut = DB::table('t_in')
            ->where('out_id', $id)
            ->first();

        $moveOutDetails = DB::table('t_in_detail')
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



    public function updateDataDelivery(Request $request, $id)
{

    $request->validate([
        'is_confirm' => 'required|string|max:255',
    ]);


    $moveout = MasterMoveOut::find($id); 

    if (!$moveout) {
        return response()->json(['status' => 'error', 'message' => 'MoveOut not found.'], 404);
    }


    $moveout->is_confirm = $request->is_confirm;


    $moveoutDetails = DB::table('t_out')->where('in_id', $moveout->in_id)->get();

    foreach ($moveoutDetails as $detail) {
        DB::table('t_out')->where('in_id', $detail->in_id)->update([
            'is_confirm' => $request->is_confirm,  
        ]);
    }


    if ($moveout->save()) {
        return response()->json([
            'status' => 'success',
            'message' => 'MoveOut updated successfully.',
            'redirect_url' => route('Admin.delivery'), 
        ]);
    } else {
        return response()->json(['status' => 'error', 'message' => 'Failed to update MoveOut.'], 500);
    }
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



    // public function updateDataDelivery(Request $request, $id)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'is_confirm' => 'required|string|max:255',
    //     ]);

    //     // Cek apakah MoveOut dengan id yang benar ada
    //     $movein = MasterMoveIn::find($id); // Langsung gunakan find jika ID adalah primary key

    //     if (!$movein) {
    //         return response()->json(['status' => 'error', 'message' => 'movein not found.'], 404);
    //     }

    //     // Update data movein
    //     $movein->is_confirm = $request->is_confirm;
    //         // Salin data dari t_out_detail ke t_in_detail
    //         $moveinDetails = DB::table('t_out')->where('in_id', $movein->in_id)->get();

    //         foreach ($moveinDetails as $detail) {
    //             DB::table('t_out')->update([
    //                 'in_id' => $movein->in_id,  // Menghubungkan dengan data baru di t_in
    //                 'is_confirm' => $detail->is_confirm,  // Menghubungkan dengan data baru di t_in
    //             ]);
    //         }

    //     if ($movein->save()) { // Menggunakan save() yang lebih aman daripada update()
    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'moveout updated successfully.',
    //             'redirect_url' => route('Admin.delivery'), // Sesuaikan dengan route index Anda
    //         ]);
    //     } else {
    //         return response()->json(['status' => 'error', 'message' => 'Failed to update moveout.'], 500);
    //     }
    // }


    // public function updateDataConfirm(Request $request, $id)
    // {
    //     $request->validate([
    //         'is_confirm' => 'required|in:1,2,3', // Allow specific values
    //     ]);
        
    //     // Correct model used here (MasterMoveIn)
    //     $movein = MasterMoveIn::find($id);
    
    //     if (!$movein) {
    //         return response()->json(['status' => 'error', 'message' => 'MoveIn not found.'], 404);
    //     }
    
    //     $movein->is_confirm = $request->is_confirm;
    
    //     // Get the first t_out record that matches the in_id
    //     $moveinDetails = DB::table('t_out')->where('in_id', $movein->in_id)->first();
    
    //     if ($moveinDetails) {
    //         // Directly update the t_out record by matching out_id
    //         DB::table('t_out')
    //             ->where('out_id', $moveinDetails->out_id)
    //             ->update([
    //                 'is_confirm' => $request->is_confirm,
    //             ]);
    //     } else {
    //         return response()->json(['status' => 'error', 'message' => 'No matching records found in t_out table.'], 404);
    //     }
    
    //     // Save the MoveIn record
    //     if ($movein->save()) {
    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'MoveIn updated successfully.',
    //             'redirect_url' => route('Admin.confirm'),
    //         ]);
    //     }
    
    //     return response()->json(['status' => 'error', 'message' => 'Failed to update MoveIn.'], 500);
    // }
    
    

    public function edit($id)
    {
        $moveout = MasterDelivery::with('asset')->findOrFail($id); // Assuming MoveOut has a relationship with Asset
        return response()->json($moveout);
    }

    public function deleteDataDelivery($id)
    {
        $moveout = MasterDelivery::find($id);

        if ($moveout) {
            $moveout->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'move$moveout deleted successfully.',
                'redirect_url' => route('Admin.delivery')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data move$moveout Gagal Terhapus'], 404);
        }
    }

    public function deleteDataConfirm($id)
    {
        $moveout = MasterDelivery::find($id);

        if ($moveout) {
            $moveout->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'move$moveout deleted successfully.',
                'redirect_url' => route('Admin.confirm')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data move$moveout Gagal Terhapus'], 404);
        }
    }


    public function details($MoveOutId)
    {
        $moveout = MasterDelivery::where('out_id', $MoveOutId)->first();

        if (!$moveout) {
            abort(404, 'moveout not found');
        }

        return view('moveout.details', ['asset' => $moveout]);
    }
}
