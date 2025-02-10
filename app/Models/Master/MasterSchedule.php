<?php 

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class MasterSchedule extends Model 
{
    use HasFactory, SoftDeletes;

    protected $table = 'm_schedule';
}