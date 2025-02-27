<?php 

namespace App\Http\Controllers\AM;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;



class AmController extends Controller
{
    public function dashboard()
    {
        return view('AM.layouts.am_layouts');
    }

    public function HalamanMovementOut(Request $request) {
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
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
        ->join('master_resto_v2 as fromResto', 't_out.from_loc', '=', 'fromResto.id')
        ->join('master_resto_v2 as toResto', 't_out.dest_loc', '=', 'toResto.id')
        ->where('t_out.is_active', 1);
    
        if ($request->filled('is_confirm') && $request->input('is_confirm') == 2) {
            $moveoutsQuery = DB::table('t_out')
            ->select(
                't_out.out_id',
                't_out.dest_loc',
                't_out.is_confirm',
                'master_resto_v2.name_store_street',
                'm_user.role',
                'm_user.location_now',
                't_in.from_location'
            )
            ->join('m_user', 't_out.dest_loc', '=', 'm_user.location_now')
            ->join('master_resto_v2', 't_out.dest_loc', '=', 'm_user.location_now')
            ->join('t_in', 't_out.in_id', '=', 't_in.in_id')
            ->where('m_user.location_now', $fromLoc)
            ->where('m_user.role', 'am')
            ->where('t_out.is_confirm', 3);
        
        } else {
            $moveoutsQuery->select(
                't_out.*',
                'm_reason.reason_name',
                'mc_approval.approval_name',
                'fromResto.name_store_street as from_location',
                'toResto.name_store_street as dest_location'
            );
        }
    
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = $request->input('start_date') . ' 00:00:00'; // start of the day
            $endDate = $request->input('end_date') . ' 23:59:59'; // end of the day
            $moveoutsQuery->whereBetween('t_out.out_date', [$startDate, $endDate]);
        }
    
        $moveouts = $moveoutsQuery->paginate(10);

        // dd($fromLoc);
    
        return view("AM.moveout.lihat_halaman_moveout", [
            'fromLoc' => $fromLoc,
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'moveouts' => $moveouts,
            'restos' => $restos
        ]);

    }


    public function HalamanDisposalAM()
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
    

        return view("AM.disposal.lihat_data_disposal", [
            'fromLoc' => $fromLoc,
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveouts' => $moveouts,
            'restos' => $restos
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

        return view('AM.disposal.detail_data_disposal', compact('reasons', 'moveOutAssets', 'assets'));
    }

    public function filterDisposal(Request $request)
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


        return view("AM.disposal.lihat_data_disposal", [
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

    public function HalamanAmd1() 
    {
        $user_loc = auth()->user()->location_now;
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
        ->where('t_out.from_loc', $user_loc)
        ->paginate(10);


        $user = Auth::user();

        return view("AM.disposal.apprdis-am", [
            'reasons' => $reasons,
            'approvals' => $approvals,
            'assets' => $assets,
            'conditions' => $conditions,
            'moveouts' => $moveouts,
            'user' => $user
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
        ->join('master_resto_v2 as fromResto', 't_out.from_loc', '=', 'fromResto.id')
        ->join('master_resto_v2 as toResto', 't_out.dest_loc', '=', 'toResto.id')
        ->select(
            't_out.*', 
            'm_reason.reason_name', 
            'mc_approval.approval_name',
            'fromResto.name_store_street as from_location', 
            'toResto.name_store_street as dest_location'
        )
        ->whereIn('t_out.appr_1', ['1', '2', '3', '4'])
        ->whereNull('t_out.deleted_at')
        ->whereExists(function ($query) {
            $user_location_now =  auth()->user()->location_now;
            $user_role = auth()->user()->role;
            $query->select(DB::raw(1))
                ->from('m_user')
                ->whereColumn('m_user.location_now', 't_out.dest_loc')
                ->where('m_user.role', $user_role)
                ->where('m_user.location_now', $user_location_now);
        })
        ->whereIn('appr_1', ['1', '2', '3', '4'])
        ->whereNull('t_out.deleted_at')
        ->paginate(10);

        return view("AM.moveout.approval-am", [
            'reasons' => $reasons,
            'approvals' => $approvals,
            'assets' => $assets,
            'conditions' => $conditions,
            'moveouts' => $moveouts
        ]);
    }

    public function getAmo1()
    {
        $moveouts = MasterMoveOut::all();
        return response()->json($moveouts);
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

        return view("AM.moveout.approval-am", [
            'reasons' => $reasons,
            'approvals' => $approvals,
            'assets' => $assets,
            'conditions' => $conditions,
            'moveouts' => $moveouts
        ]);
    }


    public function updateDataAmo1(Request $request, $id)
    {
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
    
            $details = DB::table('t_out_detail')
                ->where('out_id', $id)
                ->get();
    
            foreach ($details as $detail) {
                DB::table('table_registrasi_asset')
                    ->where('id', $detail->asset_id)
                    ->increment('qty', 1); 
            }
        }
    
        if ($moveout->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Moveout updated successfully.',
                'redirect_url' => route('Admin.apprmoveout-am'), // Adjust this route as needed
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update moveout.'], 500);
        }
    }


    public function HalamanConfirm() 
    {
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
            ->join('m_reason', DB::raw('t_out.reason_id COLLATE utf8mb4_unicode_ci'), '=', DB::raw('m_reason.reason_id COLLATE utf8mb4_unicode_ci'))
            ->join('mc_approval', DB::raw('t_out.is_confirm COLLATE utf8mb4_unicode_ci'), '=', DB::raw('mc_approval.approval_id COLLATE utf8mb4_unicode_ci'))
            ->join('master_resto_v2 AS fromResto', DB::raw('t_out.from_loc COLLATE utf8mb4_unicode_ci'), '=', DB::raw('fromResto.id COLLATE utf8mb4_unicode_ci'))
            ->join('master_resto_v2 AS toResto', DB::raw('t_out.dest_loc COLLATE utf8mb4_unicode_ci'), '=', DB::raw('toResto.id COLLATE utf8mb4_unicode_ci'))
            ->where('t_out.appr_1', '=', '2')
            ->where('t_out.appr_2', '=', '2')
            ->where('t_out.appr_3', '=', '2');
    
        if ($user_role == 'am') {
            $query->where('t_out.dest_loc', $user_location_now);
        } else {
            $query->where('t_out.from_loc', '!=', $user_location_now);
        }
    
        $moveins = $query->paginate(10);
    
        return view("AM.moveout.confirm", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveins' => $moveins,
        ]);
    }
}


