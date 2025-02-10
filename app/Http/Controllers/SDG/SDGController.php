<?php 

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

class SDGController extends Controller {
    
    public function DashboardSDG () {
        return view('sdg_dashboard');
    }

}