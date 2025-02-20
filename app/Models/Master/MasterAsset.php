<?php



namespace App\Models\Master;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Auth; // Untuk mendapatkan username dari user yang sedang login

use Carbon\Carbon; // Untuk tanggal dan waktu



class MasterAsset extends Model

{

    use HasFactory;

    // use SoftDeletes;



    protected $table = 'm_assets';

    protected $primaryKey = 'asset_id';



    protected $fillable = [

        'asset_id',

        'asset_code',

        'asset_model',

        // 'asset_quantity',

        // 'asset_status',

        'asset_image',

        'priority_id',

        'cat_id',

        'type_id',

        'uom_id',

        'create_date',

        'modified_date',

        'created_by',

        'modified_by',

        'is_active',

        'deleted_at',

        'qr_code_path'

    ];

    public $timestamps = true; // Enable automatic timestamps



    protected static function boot()

    {

        parent::boot();



        // Event ketika menambah data (creating)

        static::creating(function ($model) {

            $model->create_by = Auth::user()->username ?? 'system'; // Mengisi create_by dengan username user yang login



            // Menghasilkan asset_id secara otomatis

            $maxAssetId = MasterAsset::max('asset_id'); // Ambil nilai asset_id maksimum

            $model->asset_id = $maxAssetId ? $maxAssetId + 1 : 1; // Set asset_id, mulai dari 1 jika tidak ada

        });



        // Event ketika mengupdate data (updating)

        static::updating(function ($model) {

            $model->modified_by = Auth::user()->username ?? 'system'; // Mengisi modified_by dengan username user yang login

        });

    }

}

