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
        ->leftjoin('mc_approval', 't_out.appr_1', '=', 'mc_approval.approval_id')
        ->leftjoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
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
        ->leftjoin('mc_approval', 't_out.appr_1', '=', 'mc_approval.approval_id')
        ->leftjoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')
        ->whereIn('appr_1', ['1', '2', '3'])
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
        ->leftjoin('mc_approval', 't_out.appr_1', '=', 'mc_approval.approval_id')
        ->leftjoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
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

    public function HalamanAmo1() 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->leftjoin('mc_approval', 't_out.appr_1', '=', 'mc_approval.approval_id')
        ->leftjoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')
        ->whereIn('appr_1', ['1', '2', '3'])
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
        ->leftjoin('mc_approval', 't_out.appr_2', '=', 'mc_approval.approval_id')
        ->leftjoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')
        ->whereIn('appr_1', ['1', '2', '3'])
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
        ->leftjoin('mc_approval', 't_out.appr_2', '=', 'mc_approval.approval_id')
        ->leftjoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')
        ->whereIn('appr_1', ['1', '2', '3'])
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
        ->leftjoin('mc_approval', 't_out.appr_3', '=', 'mc_approval.approval_id')
        ->leftjoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')
        ->whereIn('appr_1', ['1', '2', '3'])
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
        ->leftjoin('mc_approval', 't_out.appr_3', '=', 'mc_approval.approval_id')
        ->leftjoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')
        ->whereIn('appr_1', ['1', '2', '3'])
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
        ->leftjoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->leftjoin('t_in', 't_out.out_id', '=', 't_in.out_id')
        ->leftjoin('mc_approval', 't_in.is_confirm', '=', 'mc_approval.approval_id')
        ->leftjoin('t_in_detail', 't_in_detail.in_id', '=', 't_in.in_id')
        ->leftjoin('t_transit', 't_in_detail.in_det_id', '=', 't_transit.in_det_id')
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
        ->leftjoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->leftjoin('t_in', 't_out.out_id', '=', 't_in.out_id')
        ->leftjoin('mc_approval', 't_in.is_confirm', '=', 'mc_approval.approval_id')
        ->leftjoin('t_in_detail', 't_in_detail.in_id', '=', 't_in.in_id')
        ->leftjoin('t_transit', 't_in_detail.in_det_id', '=', 't_transit.in_det_id')
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
        ->leftjoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->leftjoin('t_in', 't_out.out_id', '=', 't_in.out_id')
        ->leftjoin('mc_approval', 't_in.is_confirm', '=', 'mc_approval.approval_id')
        ->leftjoin('t_in_detail', 't_in_detail.in_id', '=', 't_in.in_id')
        ->leftjoin('t_transit', 't_in_detail.in_det_id', '=', 't_transit.in_det_id')
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

    public function updateDataAmo1(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'appr_1' => 'required|string|max:255',
        ]);

        // Cek apakah MoveOut dengan id yang benar ada
        $moveout = MasterMoveOut::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$moveout) {
            return response()->json(['status' => 'error', 'message' => 'moveout not found.'], 404);
        }

        // Update data moveout
        $moveout->appr_1_date = Carbon::now();
        $moveout->appr_1 = $request->appr_1;
        if ($request->appr_1 == '2') {
            $moveout->appr_2 = '1';
        }
        
        if ($moveout->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'moveout updated successfully.',
                'redirect_url' => route('Admin.apprmoveout-am'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update moveout.'], 500);
        }
    }

    public function updateDataAmo2(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'appr_2' => 'required|string|max:255',
        ]);

        // Cek apakah MoveOut dengan id yang benar ada
        $moveout = MasterMoveOut::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$moveout) {
            return response()->json(['status' => 'error', 'message' => 'moveout not found.'], 404);
        }

        // Update data moveout
        $moveout->appr_2_date = Carbon::now();
        $moveout->appr_2 = $request->appr_2;
        if ($request->appr_2 == '2') {
            $moveout->appr_3 = '1';
        }
        
        if ($moveout->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'moveout updated successfully.',
                'redirect_url' => route('Admin.apprmoveout-rm'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update moveout.'], 500);
        }
    }

    public function updateDataAmo3(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'appr_3' => 'required|string|max:255',
        ]);

        // Cek apakah MoveOut dengan id yang benar ada
        $moveout = MasterMoveOut::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$moveout) {
            return response()->json(['status' => 'error', 'message' => 'moveout not found.'], 404);
        }
        $trx_code = DB::table('t_trx')->where('trx_name', 'Confirmation Movement')->value('trx_code');

            // Format yymmdd untuk tanggal hari ini
            $today = Carbon::now()->format('ymd');

            // Hitung urutan nomor transaksi untuk hari ini
            $todayDate = Carbon::now()->format('Y-m-d');
            $todayCount = MasterMoveOut::whereDate('create_date', $todayDate)->count() + 1;
            $transaction_number = str_pad($todayCount, 3, '0', STR_PAD_LEFT); // Format as 001, 002, etc.

            // Format opname_id
            $moveout->in_id = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('dest_loc')}.{$transaction_number}";

        // Update data moveout
        $moveout->appr_3_date = Carbon::now();
        $moveout->appr_3 = $request->appr_3;
        if ($request->appr_3 == '2') {
            $moveout->is_confirm = '4';
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
                $in = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('dest_loc')}.{$transaction_number_str}";

            $newInId = DB::table('t_in')->insertGetId([
                'in_id' => $in,  // Ambil dari out_id
                'out_id' => $moveout->out_id,  // Ambil dari out_id
                'in_date' => $moveout->out_date,  // Ambil dari out_id
                'from_loc' => $moveout->from_loc,  // Ambil dari out_id
                'dest_loc' => $moveout->dest_loc,  // Ambil dari out_id
                'out_desc' => $moveout->out_desc,  // Ambil dari out_id
                'reason_id' => $moveout->reason_id,  // Ambil dari out_id
                'appr_1' => 1, // Set appr_1 di tabel t_in menjadi 1
                // Tambahkan kolom lain yang perlu diambil dari $moveout jika ada
                'create_date' => now(),
                'modified_date' => now()
            ]);
            // Salin data dari t_out_detail ke t_in_detail
            $moveoutDetails = DB::table('t_out_detail')->where('out_id', $moveout->out_id)->get();

            foreach ($moveoutDetails as $detail) {
                DB::table('t_in_detail')->insert([
                    'in_id' => $in,  // Menghubungkan dengan data baru di t_in
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
        }
        
        if ($moveout->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'moveout updated successfully.',
                'redirect_url' => route('Admin.apprmoveout-sdgasset'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update moveout.'], 500);
        }
    }

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
