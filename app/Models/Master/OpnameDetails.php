<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpnameDetails extends Model
{
    use HasFactory;

    protected $table = 't_opname_detail';
    protected $primaryKey = 'opname_det_id';

    protected $fillable = [
        'opname_det_id',
        'opname_id',
        'register_code',
        'qty_onhand',
        'qty_physical',
        'qty_difference',
        'uom',
        'condition_id',
        'image'
    ];

    public $timestamps = false;

    public function masterStockOpname()
    {
        return $this->belongsTo(MasterStockOpnameModel::class, 'opname_id', 'opname_id');
    }
    
    protected static function boot()
    {
        parent::boot();

        // Event ketika menambah data (creating)
        static::creating(function ($model) {
            // Menghasilkan opname_id secara otomatis
            $maxRepairId = OpnameDetails::max('opname_det_id'); // Ambil nilai opname_det_id maksimum
            $model->opname_det_id = $maxRepairId ? $maxRepairId + 1 : 1; // Set opname_id, mulai dari 1 jika tidak ada
        });
    }
}