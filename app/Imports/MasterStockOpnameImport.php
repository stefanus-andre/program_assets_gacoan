<?php

namespace App\Imports;



use App\Models\Master\MasterStockOpnameModel;

use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterStockOpnameImport implements ToModel, WithHeadingRow
{
    public function model(array $row) {
        return new MasterStockOpnameModel([
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
    }
}