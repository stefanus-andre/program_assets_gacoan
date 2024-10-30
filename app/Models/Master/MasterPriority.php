<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan username dari user yang sedang login
use Carbon\Carbon; // Untuk tanggal dan waktu

class MasterPriority extends Model
{
    use HasFactory;
    // use SoftDeletes;

    public $table = 'm_priority';
    protected $primaryKey = 'priority_id';

    public $fillable = [
        'priority_id',
        'priority_code',
        'priority_name',
        'create_date',
        'modified_date',
        'created_by',
        'modified_by',
        'is_active'
    ];
    
    public $timestamps = false; // Nonaktifkan pengelolaan otomatis kolom created_at dan updated_at

    protected static function boot()
    {
        parent::boot();

        // Event ketika menambah data (creating)
        static::creating(function ($model) {
            $model->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $model->create_by = Auth::user()->username ?? 'system'; // Mengisi create_by dengan username user yang login

            // Menghasilkan priority_id secara otomatis
            $maxPriorityId = MasterPriority::max('priority_id'); // Ambil nilai priority_id maksimum
            $model->priority_id = $maxPriorityId ? $maxPriorityId + 1 : 1; // Set priority_id, mulai dari 1 jika tidak ada
        });

        // Event ketika mengupdate data (updating)
        static::updating(function ($model) {
            $model->modified_date = Carbon::now(); // Mengisi modified_date dengan tanggal saat ini
            $model->modified_by = Auth::user()->username ?? 'system'; // Mengisi modified_by dengan username user yang login
        });
    }
}
