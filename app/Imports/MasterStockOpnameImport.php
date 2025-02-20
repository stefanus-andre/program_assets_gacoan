<?php

namespace App\Imports;



use App\Models\Master\MasterStockOpnameModel;

use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterStockOpnameImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row) {

        $header = MasMasterStockOpnameModel::create([
            'opname_id' => $row['opname_id'],
            'opname_no' => $row['opname_no'],
            'barang_opname' => $row['barang_opname'],
            'loc_id' => $row['loc_id'],
            'so_id' => $row['so_id'],
            'opname_desc' => $row['opname_desc'],
            'create_date' => $row['create_date'],
            'create_by' => $row['create_by'],
            'modified_date' => $row['modified_date'],
            'modified_by' => $row['modified_by'],
            'is_verify' => $row['is_verify'],
            'is_active' => $row['is_active'],
            'user_verify' => $row['user_verify']
        ]);

        OpnameDetails::create([
            'opname_id' => $header->opname_id,
            'register_code' => $row['register_code'],
            'qty_onhand' => $row['qty_onhand'],
            'qty_physical' => $row['qty_physical'],
            'qty_difference' => $row['qty_difference'],
            'uom' => $row['uom'],
            'condition_id' => $row['condition_id'],
            'image' => $row['image']
        ]);

        return null;
    }
}
