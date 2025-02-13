<?php

namespace App\Imports;

use App\Models\Master\MasterStockOpnameModel;
use App\Models\Master\OpnameDetails;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterStockOpnameImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Menyimpan data ke tabel MasterStockOpnameModel
        MasterStockOpnameModel::create([
            'opname_id' => $row['opname_id'],
            'opname_no' => $row['opname_no'],
            'opname_reason_id' => $row['opname_reason_id'], // Sesuaikan jika ada kolom reason_id pada file CSV
            'opname_date' => $row['opname_date'], // Pastikan format tanggal sesuai dengan database
            'verify' => $row['verify'],
            'loc_id' => $row['loc_id'],
            'so_id' => $row['so_id'],
            'condition_id' => $row['condition_id'],
            'opname_desc' => $row['opname_desc'],
            'create_date' => $row['create_date'], // Pastikan format datetime sesuai
            'create_by' => $row['create_by'],
            'modified_date' => $row['modified_date'], // Pastikan format datetime sesuai
            'modified_by' => $row['modified_by'],
            'is_verify' => $row['is_verify'],
            'is_active' => $row['is_active'],
            'user_verify' => $row['user_verify'],
            'created_at' => now(), // Tambahkan waktu saat ini untuk created_at
        ]);

        $qty_diff = $row['qty_physical'] - $row['qty_onhand'];
        // Menyimpan data ke tabel MasterStockOpnameModel
        OpnameDetails::create([
            'opname_det_id' => $row['opname_det_id'],
            'opname_id' => $row['opname_id'],
            'register_code' => $row['register_code'], // Sesuaikan jika ada kolom reason_id pada file CSV
            'qty_onhand' => $row['qty_onhand'], // Pastikan format tanggal sesuai dengan database
            'qty_physical' => $row['qty_physical'],
            'qty_difference' => $qty_diff,
            'uom' => $row['uom'],
            'condition' => $row['condition'],
            'image' => $row['image'],
            'created_at' => now(), // Tambahkan waktu saat ini untuk created_at
        ]);

        return null;
    }
}
