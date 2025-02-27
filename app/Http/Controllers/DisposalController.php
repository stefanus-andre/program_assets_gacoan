<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterDisOut;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DisposalController extends Controller
{
    public function Index1()
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.appr_1', '=', 'mc_approval.approval_id')
        ->join('master_resto_v2 AS from_loc', 't_out.from_loc', '=', 'from_loc.id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name',
        'from_loc.name_store_street AS from_location'
        )
        ->where('t_out.out_id', 'like', 'DA%')
        ->whereIn('t_out.appr_1', ['1', '2', '3', '4'])
        ->whereNull('t_out.deleted_at')
        ->paginate(10);

        return view("Admin.apprdis-am", [
            'reasons' => $reasons,
            'approvals' => $approvals,
            'assets' => $assets,
            'conditions' => $conditions,
            'moveouts' => $moveouts
        ]);
    }

    public function HalamanAmd1() 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.appr_1', '=', 'mc_approval.approval_id')
        ->join('master_resto_v2 AS from_loc', 't_out.from_loc', '=', 'from_loc.id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name',
        'from_loc.name_store_street AS from_location'
        )
        ->where('t_out.out_id', 'like', 'DA%')
        ->whereIn('t_out.appr_1', ['1', '2', '3', '4'])
        ->whereNull('t_out.deleted_at')
        ->paginate(10);


        $user = Auth::user();

        return view("Admin.apprdis-am", [
            'reasons' => $reasons,
            'approvals' => $approvals,
            'assets' => $assets,
            'conditions' => $conditions,
            'moveouts' => $moveouts,
            'user' => $user
        ]);
    }
    
    public function Index2()
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.appr_2', '=', 'mc_approval.approval_id')
        ->join('master_resto_v2 AS from_loc', 't_out.from_loc', '=', 'from_loc.id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name',
        'from_loc.name_store_street AS from_location'
        )
        ->where('t_out.out_id', 'like', 'DA%')
        ->whereIn('t_out.appr_2', ['1', '2', '3', '4'])
        ->whereNull('t_out.deleted_at')
        ->paginate(10);

        return view("Admin.apprdis-rm", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveouts' => $moveouts
        ]);
    }

    public function HalamanAmd2() 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.appr_2', '=', 'mc_approval.approval_id')
        ->join('master_resto_v2 AS from_loc', 't_out.from_loc', '=', 'from_loc.id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name',
        'from_loc.name_store_street AS from_location'
        )
        ->where('t_out.out_id', 'like', 'DA%')
        ->whereIn('t_out.appr_2', ['1', '2', '3', '4'])
        ->whereNull('t_out.deleted_at')
        ->paginate(10);

        return view("Admin.apprdis-rm", [
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

        return view("Admin.apprdis-sdgasset", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveouts' => $moveouts
        ]);
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

        return view("Admin.apprdis-sdgasset", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveouts' => $moveouts
        ]);
    }
    
    public function HalamanReview() 
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
    

        return view("Admin.review-disposal", [
            'fromLoc' => $fromLoc,
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveouts' => $moveouts,
            'restos' => $restos
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

        return view("Admin.revdis-mnr", [
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

        return view("Admin.revdis-taf", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveins' => $moveins,
            'delivery' => $delivery
        ]);
    }

    public function getAmd1()
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

    public function updateDataAmd1(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'appr_1' => 'required|string|max:255',
        ]);

        // Cek apakah MoveOut dengan id yang benar ada
        $moveout = MasterDisOut::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$moveout) {
            return response()->json(['status' => 'error', 'message' => 'moveout not found.'], 404);
        }

        // Update data moveout
        $moveout->appr_1 = $request->appr_1;
        if ($request->appr_1 == '2') {
            $moveout->appr_2 = '1';
        } elseif ($request->appr_1 == '4') {
            $moveout->is_confirm = '4';
    
            DB::table('t_out_detail')
                ->where('out_id', $id)
                ->update(['status' => 4]);
    
            $details = DB::table('t_out_detail')
                ->where('out_id', $id)
                ->get();
    
            foreach ($details as $detail) {
                DB::table('table_registrasi_asset')
                    ->where('id', $detail->asset_id)
                    ->increment('qty', 1); 
            }
        }
        
        if ($moveout->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'moveout updated successfully.',
                'redirect_url' => route('Admin.apprdis-am'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update moveout.'], 500);
        }
    }

    public function updateDataAmd2(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'appr_2' => 'required|string|max:255',
        ]);

        // Cek apakah MoveOut dengan id yang benar ada
        $moveout = MasterDisOut::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$moveout) {
            return response()->json(['status' => 'error', 'message' => 'moveout not found.'], 404);
        }

        // Update data moveout
        $moveout->appr_2 = $request->appr_2;
        if ($request->appr_2 == '2') {
            $moveout->appr_3 = '1';
        } elseif ($request->appr_1 == '4') {
            $moveout->is_confirm = '4';
    
            DB::table('t_out_detail')
                ->where('out_id', $id)
                ->update(['status' => 4]);
    
            $details = DB::table('t_out_detail')
                ->where('out_id', $id)
                ->get();
    
            foreach ($details as $detail) {
                DB::table('table_registrasi_asset')
                    ->where('id', $detail->asset_id)
                    ->increment('qty', 1); 
            }
        }
        
        if ($moveout->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'moveout updated successfully.',
                'redirect_url' => route('Admin.apprdis-rm'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update moveout.'], 500);
        }
    }

    public function updateDataAmd3(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'appr_3' => 'required|string|max:255',
        ]);

        // Cek apakah MoveOut dengan id yang benar ada
        $moveout = MasterDisOut::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$moveout) {
            return response()->json(['status' => 'error', 'message' => 'moveout not found.'], 404);
        }

        // Update data moveout
        $moveout->appr_3 = $request->appr_3;
        if ($request->appr_3 == '2') {
            $moveout->is_confirm = '4';
            $newInId = DB::table('t_in')->insertGetId([
                'in_id' => $moveout->in_id,  // Ambil dari out_id
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
                    'in_id' => $moveout->in_id,  // Menghubungkan dengan data baru di t_in
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
        
        if ($moveout->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'moveout updated successfully.',
                'redirect_url' => route('Admin.apprdis-sdgasset'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update moveout.'], 500);
        }
    }

    public function deleteDataAmd1($id)
    {
        $moveout = MasterDisOut::find($id);

        if ($moveout) {
            $moveout->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'moveout deleted successfully.',
                'redirect_url' => route('Admin.apprdis-am')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data moveout Gagal Terhapus'], 404);
        }
    }


    public function details1($MoveOutId)
    {
        $moveout = MasterDisOut::where('out_id', $MoveOutId)->first();

        if (!$moveout) {
            abort(404, 'moveout not found');
        }

        return view('moveout.details', ['asset' => $moveout]);
    }
}
