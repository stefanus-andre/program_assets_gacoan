<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan username dari user yang sedang login
use Carbon\Carbon; // Untuk tanggal dan waktu

class MasterDisposal extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 't_out';
    protected $primaryKey = 'out_id';
    
    protected $fillable = [
        'out_id',
        'out_no',
        'out_date',
        'from_loc',
        'dest_loc',
        'in_id',
        'appr_1',
        'appr_1_date',
        'appr_2',
        'appr_2_date',
        'appr_3',
        'appr_3_date',
        'is_verify',
        'out_desc',
        'reason_id',
        'create_date',
        'modified_date',
        'create_by',
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

            // Menghasilkan out_no secara otomatis
            $maxMtcId = MasterDisposal::max('out_no'); // Ambil nilai out_no maksimum
            $model->out_no = $maxMtcId ? $maxMtcId + 1 : 1; // Set out_no, mulai dari 1 jika tidak ada
        });

        // Event ketika mengupdate data (updating)
        static::updating(function ($model) {
            $model->modified_date = Carbon::now(); // Mengisi modified_date dengan tanggal saat ini
            $model->modified_by = Auth::user()->username ?? 'system'; // Mengisi modified_by dengan username user yang login
        });
    }
    
}
