<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan username dari user yang sedang login
use Carbon\Carbon; // Untuk tanggal dan waktu

class MasterCondition extends Model
{
    use HasFactory;
    
    protected $table = 'm_condition';
    protected $primaryKey = 'condition_id';
    
    protected $fillable = [
        'condition_id',
        'condition_name',
        'create_date',
        'modified_date',
        'modified_by',
        'create_by',
        'is_active',
        'deleted_at'
    ];
    public $timestamps = false; // Nonaktifkan pengelolaan otomatis kolom created_at dan updated_at

    protected static function boot()
    {
        parent::boot();

        // Event ketika menambah data (creating)
        static::creating(function ($model) {
            $model->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $model->create_by = Auth::user()->username ?? 'system'; // Mengisi create_by dengan username user yang login
            $model->modified_by = null; 
            // Menghasilkan id secara otomatis
            $maxConditionId = MasterCondition::max('condition_id'); // Ambil nilai id maksimum
            $model->condition_id = $maxConditionId ? $maxConditionId + 1 : 1; // Set id, mulai dari 1 jika tidak ada
        });

        // Event ketika mengupdate data (updating)
        static::updating(function ($model) {
            $model->modified_date = Carbon::now(); // Mengisi modified_date dengan tanggal saat ini
            $model->modified_by = Auth::user()->username ?? 'system'; // Mengisi modified_by dengan username user yang login
        });
    }
}
