<?php

namespace App\Imports;

use App\Models\Master\MasterStockOpnameModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterStockOpnameImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        return new MasterStockOpnameModel([
            'opname_id' => $row['opname_id'],
            'opname_no' => $row['opname_no'],
            'opname_reason_id' => $row['opname_reason_id'],
            'opname_date' => $row['opname_date'],
            'verify' => $row['verify'],
            'loc_id' => $row['loc_id'],
            'so_id' => $row['so_id'],
            'condition_id' => $row['condition_id'],
            'opname_desc' => $row['opname_desc'],
            'create_date' => $row['create_date'],
            'create_by' => $row['create_by'],
            'modified_date' => $row['modified_date'],
            'modified_by' => $row['modified_by'],
            'is_verify' => $row['is_verify'],
            'is_active' => $row['is_active'],
            'user_verify' => $row['user_verify'],
            'created_at' => now(),
        ]);
    }
}
