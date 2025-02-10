<?php



namespace App\Models\Master;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;



class MasterRegistrasiModel extends Model

{

    use HasFactory;

    use SoftDeletes;



    protected $table = 'table_registrasi_asset';



    protected $primaryKey = 'id';



    protected $dates = ['deleted_at'];

    protected $fillable = [

        'register_code',

        'asset_name',

        'serial_number',

        'type_asset',

        'category_asset',

        'prioritas',

        'merk',

        'qty',

        'satuan',

        'register_location',

        'layout',

        'register_date',

        'supplier',

        'condition',

        'purchase_number',

        'purchase_date',

        'warranty',

        'periodic_maintenance',

        'approve_status',

        'width',
        
        'height',
        
        'depth',

        'location_now'

    ];



    public $timestamps = false;

    

}

