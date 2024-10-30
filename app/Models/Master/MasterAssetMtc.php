<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterAssetMtc extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'mc_asset_mtc';

    protected $fillable = [
        'asset_mtc_name',
        'asset_id',
        'mtc_id',
        'asset_mtc_desc',
        'is_active',
        'created_date',
        'modified_date',
        'created_by',
        'modified_by'
    ];
}
