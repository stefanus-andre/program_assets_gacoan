<?php



namespace App\Models\Master;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;



class MasterTipeMaintenance extends Model

{

    use HasFactory;
    // use SoftDeletes;

    protected $table = 'm_mtc_type';
    protected $primaryKey = 'mtc_type_id';


    protected $fillable = [
        'mtc_type_name',
        'create_date',
        'modified_date',
        'created_by',
        'modified_by',
        'is_active'
    ];

}

