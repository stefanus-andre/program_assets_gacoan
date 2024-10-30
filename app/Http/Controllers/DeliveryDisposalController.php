<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterDeliveryDisposal;
use App\Models\Master\MasterDisIn;
use App\Models\Master\MasterDisOut;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeliveryDisposalController extends Controller
{
    public function Index()
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

        return view("Admin.deliverydis", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveins' => $moveins,
            'delivery' => $delivery
        ]);
    }

    public function HalamanDeliveryDisposal() 
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

        return view("Admin.deliverydis", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveins' => $moveins,
            'delivery' => $delivery
        ]);
    }

    public function IndexConfirmDis()
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
        ->whereIn('t_in.is_confirm', [6, 7, 3])
        ->paginate(10);

        return view("Admin.confirmdis", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveins' => $moveins,
            'delivery' => $delivery
        ]);
    }

    public function HalamanConfirmDis() 
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
        ->whereIn('t_in.is_confirm', [6, 7, 3])
        ->paginate(10);

        return view("Admin.confirmdis", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveins' => $moveins,
            'delivery' => $delivery
        ]);
    }

    public function showPutForm($id)
    {
    $moveout = MasterDeliveryDisposal::find($id); // Fetch the moveout record by ID

    if (!$moveout) {
        return response()->json(['status' => 'error', 'message' => 'Moveout not found.'], 404);
    }

    // Return the moveout data
    return response()->json(['status' => 'success', 'data' => $moveout]);
}


    public function getDeliveryDisposal()
    {
        // Mengambil semua data dari tabel t_in
        $moveins = MasterDeliveryDisposal::all();
        return response()->json($moveins); // Mengembalikan data dalam format JSON
    }

    public function getConfirmDis()
    {
        // Mengambil semua data dari tabel t_in
        $moveins = MasterDeliveryDisposal::all();
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

    public function updateDataDeliveryDisposal(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'is_confirm' => 'required|string|max:255',
        ]);

        // Cek apakah MoveOut dengan id yang benar ada
        $movein = MasterDisIn::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$movein) {
            return response()->json(['status' => 'error', 'message' => 'movein not found.'], 404);
        }

        // Update data movein
        $movein->is_confirm = $request->is_confirm;
            // Salin data dari t_out_detail ke t_in_detail
            $moveinDetails = DB::table('t_out')->where('in_id', $movein->in_id)->get();

            foreach ($moveinDetails as $detail) {
                DB::table('t_out')->update([
                    'in_id' => $movein->in_id,  // Menghubungkan dengan data baru di t_in
                    'is_confirm' => $detail->is_confirm,  // Menghubungkan dengan data baru di t_in
                ]);
            }

        if ($movein->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'moveout updated successfully.',
                'redirect_url' => route('Admin.deliverydis'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update moveout.'], 500);
        }
    }


    public function updateDataConfirmDis(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'is_confirm' => 'required|string|max:255',
        ]);

        // Cek apakah MoveOut dengan id yang benar ada
        $movein = MasterDisIn::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$movein) {
            return response()->json(['status' => 'error', 'message' => 'movein not found.'], 404);
        }

        // Update data movein
        $movein->is_confirm = $request->is_confirm;
         // Salin data dari t_out_detail ke t_in_detail
        $moveinDetails = DB::table('t_out')->where('in_id', $movein->in_id)->get();

        foreach ($moveinDetails as $detail) {
            // Pembaruan yang benar menggunakan where untuk membatasi update pada baris yang tepat
            DB::table('t_out')->where('in_id', $detail->in_id)->update([
                'in_id' => $movein->in_id,  // Menghubungkan dengan data baru di t_in
                'is_confirm' => $request->is_confirm,  // Mengupdate dengan status baru
            ]);
        }

        if ($movein->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'moveout updated successfully.',
                'redirect_url' => route('Admin.confirmdis'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update moveout.'], 500);
        }
    }


    public function edit($id)
    {
        $moveout = MasterDeliveryDisposal::with('asset')->findOrFail($id); // Assuming MoveOut has a relationship with Asset
        return response()->json($moveout);
    }

    public function deleteDataDeliveryDisposal($id)
    {
        $moveout = MasterDeliveryDisposal::find($id);

        if ($moveout) {
            $moveout->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'move$moveout deleted successfully.',
                'redirect_url' => route('Admin.deliverydis')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data move$moveout Gagal Terhapus'], 404);
        }
    }

    public function deleteDataConfirmDis($id)
    {
        $moveout = MasterDeliveryDisposal::find($id);

        if ($moveout) {
            $moveout->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'move$moveout deleted successfully.',
                'redirect_url' => route('Admin.confirmdis')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data move$moveout Gagal Terhapus'], 404);
        }
    }


    public function details($MoveOutId)
    {
        $moveout = MasterDeliveryDisposal::where('out_id', $MoveOutId)->first();

        if (!$moveout) {
            abort(404, 'moveout not found');
        }

        return view('moveout.details', ['asset' => $moveout]);
    }
}
