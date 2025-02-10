<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan username dari user yang sedang login
use Carbon\Carbon; // Untuk tanggal dan waktu

class MasterGroupUser extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'm_groupuser';
    protected $primaryKey = 'group_id';

    protected $fillable = [
        'group_id',
        'group_name',
        'group_roles',
        'created_by',
        'modified_by',
        'create_date',
        'modified_date',
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

            // Menghasilkan group_id secara otomatis
            $maxGroupId = MasterGroupUser::max('group_id'); // Ambil nilai group_id maksimum
            $model->group_id = $maxGroupId ? $maxGroupId + 1 : 1; // Set group_id, mulai dari 1 jika tidak ada
        });

        // Event ketika mengupdate data (updating)
        static::updating(function ($model) {
            $model->modified_date = Carbon::now(); // Mengisi modified_date dengan tanggal saat ini
            $model->modified_by = Auth::user()->username ?? 'system'; // Mengisi modified_by dengan username user yang login
        });
    }
}
