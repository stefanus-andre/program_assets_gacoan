<?php

namespace App\Imports;



use App\Models\Master\MasterRegistrasiModel;

use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;



class MasterRegistrasiImport implements ToModel, WithHeadingRow

{

    /**

     * Handle the row data and either update an existing record or create a new one.

     *

     * @param array $row

     * @return \Illuminate\Database\Eloquent\Model|null

     */

    public function model(array $row)

    {

       return new MasterRegistrasiModel([

        'register_code' => $row['register_code'],
        'asset_name' => $row['asset_name'],
        'serial_number' => $row['serial_number'],
        'type_asset' => $row['type_asset'],
        'category_asset' => $row['category_asset'],
        'prioritas'  => $row['prioritas'],
        'merk' => $row['merk'],
        'qty' => $row['qty'],
        'satuan' => $row['satuan'],
        'register_location' => $row['register_location'],
        'layout'  => $row['layout'],
        'register_date' => $row['register_date'],
        'supplier' => $row['supplier'],
        'status' => $row['status'],
        'purchase_number' => $row['purchase_number'],
        'purchase_date' => $row['purchase_date'],
        'warranty' => $row['warranty'],
        'periodic_maintenance' => $row['periodic_maintenance'],
        'width' => $row['width'],
        'height' => $row['height'],
        'depth' => $row['depth']
       ]);

    }

}

