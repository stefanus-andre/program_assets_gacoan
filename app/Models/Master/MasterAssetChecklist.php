<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterAssetChecklist extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'mc_asset_checklist';

    protected $fillable = [
        'asset_checklist_name',
        'asset_id',
        'checklist_id',
        'control_id',
        'asset_checklist_desc',
        'is_active',
        'create_date',
        'modified_date',
        'created_by',
        'modified_by'
    ];
}
