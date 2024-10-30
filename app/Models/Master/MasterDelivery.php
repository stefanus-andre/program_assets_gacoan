<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MasterDelivery extends Model
{
    use HasFactory;
    
    protected $table = 't_transit';
    protected $primaryKey = 'transit_id';
    
    protected $fillable = [
        'transit_id',
        'transit_date',
        'asset_tag',
        'out_det_id',
        'in_det_id',
        'trx_id',
        'loc_id',
        'qty'
    ];

    protected static function boot()
    {
        parent::boot();

        // Event ketika menambah data (creating)
        static::creating(function ($model) {
            $model->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $model->create_by = Auth::user()->username ?? 'system'; // Mengisi create_by dengan username user yang login

            // Menghasilkan transit_id secara otomatis
            $maxMtcId = MasterDelivery::max('transit_id'); // Ambil nilai transit_id maksimum
            $model->transit_id = $maxMtcId ? $maxMtcId + 1 : 1; // Set transit_id, mulai dari 1 jika tidak ada
        });

        // Event ketika mengupdate data (updating)
        static::updating(function ($model) {
            $model->modified_date = Carbon::now(); // Mengisi modified_date dengan tanggal saat ini
            $model->modified_by = Auth::user()->username ?? 'system'; // Mengisi modified_by dengan username user yang login
        });
    }
}
