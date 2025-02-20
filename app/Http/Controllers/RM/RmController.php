<?php

namespace App\Http\Controllers;


use App\Models\Master\MasterAsset;

use App\Models\Master\MasterMoveOut;

use App\Models\Master\MasterRegistrasiModel;

use App\Models\Master\TOutDetail;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;





class RmController extends Controller
{
    public function dashboard() {
        return view('RM.rm_dashboard');
    }
}
