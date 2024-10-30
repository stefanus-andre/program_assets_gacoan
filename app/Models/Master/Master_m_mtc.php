<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Master_m_mtc extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'm_mtc';

    protected $fillable = [
        'mtc_name',
        'create_date',
        'modified_date',
        'create_by',
        'modified_by',
        'is_active'
    ];
}
