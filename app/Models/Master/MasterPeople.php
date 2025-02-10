<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan username dari user yang sedang login
use Carbon\Carbon; // Untuk tanggal dan waktu

class MasterPeople extends Model
{
    use HasFactory;
    // use SoftDeletes;

    public $table = 'm_people';
    protected $primaryKey = 'people_id';

    public $fillable = [
        'people_id',
        'people_nickname',
        'people_fullname',
        'people_email',
        'people_whatsapp',
        'division_id',
        'dept_id',
        'joblevel_id',
        'region_id',
        'loc_id',
        'create_date',
        'modified_date',
        'create_by',
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

            // Menghasilkan people_id secara otomatis
            $maxPeopleId = MasterPeople::max('people_id'); // Ambil nilai people_id maksimum
            $model->people_id = $maxPeopleId ? $maxPeopleId + 1 : 1; // Set people_id, mulai dari 1 jika tidak ada
        });

        // Event ketika mengupdate data (updating)
        static::updating(function ($model) {
            $model->modified_date = Carbon::now(); // Mengisi modified_date dengan tanggal saat ini
            $model->modified_by = Auth::user()->username ?? 'system'; // Mengisi modified_by dengan username user yang login
        });
    }
}
