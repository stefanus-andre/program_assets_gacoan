<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterBomHeader extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'm_bom_header';

    protected $fillable = [
        'bom_name',
        'asset_id',
        'brand_id',
        'bom_desc',
        'created_date',
        'modified_date',
        'created_by',
        'modified_by',
        'is_active'
    ];
}


