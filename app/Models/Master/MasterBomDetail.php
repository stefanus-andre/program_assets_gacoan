<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterBomDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'mc_bom_detail';

    protected $fillable = [
        'bom_id',
        'asset_id',
        'qty',
        'uom_id',
        'brand_id'
    ];
}
