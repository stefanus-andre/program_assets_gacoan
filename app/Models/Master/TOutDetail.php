<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TOutDetail extends Model
{
    use HasFactory;

    protected $table = 't_out_detail';
    protected $primaryKey = 'out_det_id';

    protected $fillable = [
        'out_det_id',
        'out_id',
        'asset_id',
        'asset_tag',
        'serial_number',
        'brand',
        'qty',
        'uom',
        'condition',
        'image'
    ];

    public $timestamps = false;

    // public function masterMoveOut()
    // {
    //     return $this->belongsTo(MasterMoveOut::class, 'out_det_id', 'out_det_id');
    // }
}