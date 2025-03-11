<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $total_asset = DB::table('t_transaction_qty')
            ->sum('qty');

        $bad_asset = DB::table('t_transaction_qty')
            ->whereIn('condition', [2, 4])
            ->sum('qty');


        $good_asset = DB::table('t_transaction_qty')
            ->whereIn('condition', [1, 3])
            ->sum('qty');


        $total_resto = DB::table('master_resto_v2')
            ->count();

        return view("Admin.dashboard_admin", [
            'totalAsset' => $total_asset,
            'badAsset' => $bad_asset,
            'goodAsset' => $good_asset,
            'totalResto' => $total_resto
        ]);
    }
}
