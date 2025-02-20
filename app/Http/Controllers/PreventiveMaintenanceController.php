<?php 

namespace App\Http\Controllers;

use App\Models\Master\MasterPreventiveMaintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PreventiveMaintenanceController extends Controller 
{
    public function LihatDataPreventiveMaintenance() {
        return view("Admin.preventive_maintenance.lihat_data_preventive_maintenance");
    }
}