<?php

namespace App\Http\Controllers\RM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RestoManagerController extends Controller
{
    public function Dashboard() {
        return view('RM.rm_dashboard');
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
    
        return view("RM.movement.confirm", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveins' => $moveins,
        ]);
    }


    public function HalamanApproveDisposalRM() {
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

        return view("RM.disposal.approve", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveouts' => $moveouts
        ]);
    }
}
