<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterApproval extends Model
{
    use HasFactory;

    protected $table = 'mc_approval';

    protected $fillable = [
        'approval_name'
    ];
}
