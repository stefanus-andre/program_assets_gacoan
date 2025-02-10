<?php 

namespace App\Http\Controllers;

use App\Models\Master\MasterPreventiveMaintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CorrectiveMaintenanceController extends Controller {
    
    public function LihatDataCorrectiveMaintenance() {
        return view("Admin.corrective_maintenance.lihat_data_corrective_maintenance");
    }
}