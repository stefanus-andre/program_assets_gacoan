<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterStockOpnameModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'm_stock_opname';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];



    protected $fillable = [
        'barang_in',
        'barang_out',
        'barang_opname',
        'total_barang_in',
        'total_barang_out',
        'total_barang_opname',
        'nama_barang'
    ];

    public $timestamps = true;
}
