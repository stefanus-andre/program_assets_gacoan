<?php

namespace App\Imports;



use App\Models\Master\MasterAsset;

use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterAssetImport implements ToModel, WithHeadingRow 
{
    public function model(array $row) {
        return new MasterAsset([
            'asset_code' => $row['asset_code'],
            'asset_model' => $row['asset_model'],
            'priority_id' => $row['priority_id'],
            'cat_id' => $row['cat_id'],
            'type_id' => $row['type_id'],
            'uom_id' => $row['uom_id'],
        ]);
    }
}