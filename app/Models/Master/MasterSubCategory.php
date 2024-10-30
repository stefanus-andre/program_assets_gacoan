<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan username dari user yang sedang login
use Carbon\Carbon; // Untuk tanggal dan waktu

class MasterSubCategory extends Model
{
    use HasFactory;
    // use SoftDeletes;
    
    protected $table = 'm_subcategory';
    protected $primaryKey = 'subcat_id';
    
    protected $fillable = [
        'subcat_id',
        'subcat_code',
        'subcat_name',
        'create_date',
        'modified_date',
        'created_by',
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

            // Menghasilkan subcat_id secara otomatis
            $maxChecklistId = MasterSubCategory::max('subcat_id'); // Ambil nilai subcat_id maksimum
            $model->subcat_id = $maxChecklistId ? $maxChecklistId + 1 : 1; // Set subcat_id, mulai dari 1 jika tidak ada
        });

        // Event ketika mengupdate data (updating)
        static::updating(function ($model) {
            $model->modified_date = Carbon::now(); // Mengisi modified_date dengan tanggal saat ini
            $model->modified_by = Auth::user()->username ?? 'system'; // Mengisi modified_by dengan username user yang login
        });
    }
}
