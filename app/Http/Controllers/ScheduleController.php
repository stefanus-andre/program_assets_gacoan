<?php 

namespace App\Http\Controllers;

use App\Models\Master\MasterSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ScheduleController extends Controller {
    
    public function LihatDataSchedule() {
        return view("Admin.schedule.lihat_data_schedule");
    }

    public function EditDataSchedule() {
        return view("Admin.schedule.edit_data_schedule");
    }
}