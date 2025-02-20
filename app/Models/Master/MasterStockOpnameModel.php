<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MasterStockOpnameModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 't_opname_header';

    protected $primaryKey = 'opname_id';

    protected $fillable = [
        'opname_id',
        'opname_reason_id',
        'barang_opname',
        'loc_id',
        'opname_date',
        'opname_desc',
        'create_date',
        'create_by',
        'modified_date',
        'modified_by',
        'is_verify',
        'is_active',
        'user_verify'
    ];
    
    public $timestamps = true; // Nonaktifkan pengelolaan otomatis kolom created_at dan updated_at

    public function OpnameDetails() // Change 'details' to 'OpnameDetailss'
    {
        return $this->hasMany(OpnameDetails::class, 'opname_id', 'opname_id');
    }
    
    protected static function boot()
    {
        parent::boot();

        // Event ketika menambah data (creating)
        static::creating(function ($model) {
            $model->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $model->create_by = Auth::user()->username ?? 'system'; // Mengisi create_by dengan username user yang login

            // Menghasilkan opname_id secara otomatis
            $maxRepairId = MasterStockOpnameModel::max('opname_no'); // Ambil nilai opname_no maksimum
            $model->opname_no = $maxRepairId ? $maxRepairId + 1 : 1; // Set opname_id, mulai dari 1 jika tidak ada
        });

        // Event ketika mengupdate data (updating)
        static::updating(function ($model) {
            $model->modified_date = Carbon::now(); // Mengisi modified_date dengan tanggal saat ini
            $model->modified_by = Auth::user()->username ?? 'system'; // Mengisi modified_by dengan username user yang login
        });
    }
}
