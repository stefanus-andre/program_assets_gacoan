<?php
namespace App\Imports;

use App\Models\Master\MasterRegistrasiModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class AssetsImport implements ToModel, WithValidation
{
    public function model(array $row)
    {
        return new MasterRegistrasiModel([
            'register_code' => $row[0],
            'asset_name' => $row[1],
            'serial_number' => $row[2],
            'type_asset' => $row[3],
            'category_asset' => $row[4],
            'prioritas' => $row[5],
            'merk' => $row[6],
            'qty' => $row[7],
            'satuan' => $row[8],
            'register_location' => $row[9],
            'layout' => $row[10],
            'register_date' => \Carbon\Carbon::parse($row[11]), // Pastikan format tanggal sesuai
            'supplier' => $row[12],
            'status' => $row[13],
            'purchase_number' => $row[14],
            'purchase_date' => \Carbon\Carbon::parse($row[15]), // Pastikan format tanggal sesuai
            'warranty' => $row[16],
            'periodic_maintenance' => $row[17],
            'approve_status' => $row[18], // Nullable
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'required|string|max:255',   // register_code
            '1' => 'required|string|max:255',   // asset_name
            '2' => 'required|string',             // serial_number
            '3' => 'required|string|max:255',   // type_asset
            '4' => 'required|string|max:255',   // category_asset
            '5' => 'required|string|max:255',   // prioritas
            '6' => 'required|string|max:255',   // merk
            '7' => 'required|integer',           // qty
            '8' => 'required|string|max:255',   // satuan
            '9' => 'required|string|max:255',   // register_location
            '10' => 'required|string|max:255',  // layout
            '11' => 'required|date',             // register_date
            '12' => 'required|string|max:255',  // supplier
            '13' => 'required|string|max:255',  // status
            '14' => 'required|string|max:255',   // purchase_number
            '15' => 'required|date',             // purchase_date
            '16' => 'required|string',            // warranty
            '17' => 'required|string',            // periodic_maintenance
            '18' => 'nullable|string|max:255',   // approve_status
        ];
    }
}
