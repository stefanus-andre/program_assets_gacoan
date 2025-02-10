<?php 

namespace App\Http\Controllers\SDG;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class SDGControllers extends Controller {

    public function DashboardSDG() {
        return view('SDG.sdg_dashboard');
    }
} 