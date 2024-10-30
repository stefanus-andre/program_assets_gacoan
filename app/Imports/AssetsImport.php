<?php

namespace App\Imports;

use App\Models\Master\MasterRegistrasiModel; // Your model
use Maatwebsite\Excel\Concerns\WithHeadingRow; // To handle heading rows
use Maatwebsite\Excel\Concerns\OnEachRow; // To handle each row individually
use SimpleSoftwareIO\QrCode\Facades\QrCode; // Ensure to include this for QR code generation
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon; // Import Carbon for date handling
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AssetsImport implements WithHeadingRow, OnEachRow
{
    public function onRow($row)
    {
        $rowArray = $row->toArray();
    
        $validator = Validator::make($rowArray, [
            'asset_name' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255',
            'serial_number' => 'required|string',
            'type_asset' => 'required|string|max:255',
            'category_asset' => 'required|string|max:255',
            'prioritas' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'qty' => 'required',
            'satuan' => 'required|string|max:255',
            'register_location' => 'required|string|max:255',
            'layout' => 'required|string|max:255',
            'register_date' => 'required',
            'supplier' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'purchase_number' => 'required|string|max:255',
            'purchase_date' => 'required',
            'warranty' => 'required',
            'periodic_maintenance' => 'required',
            'approve_status' => 'nullable|string|max:255'
            // Add other validation rules as needed
        ]);
    
        if ($validator->fails()) {
            // Optionally handle the error, e.g., log it, throw an exception, etc.
            return;
        }
        // Generate a random register_code
        $registerCode = $this->generateRandomRegisterCode();

        // Insert into the database
        DB::table('table_registrasi_asset')->insert([
            'register_code' => $registerCode,
            'asset_name' => $rowArray['asset_name'],
            'serial_number' => $rowArray['serial_number'],
            'type_asset' => $rowArray['type_asset'],
            'category_asset' => $rowArray['category_asset'],
            'prioritas' => $rowArray['prioritas'],
            'merk' => $rowArray['merk'],
            'qty' => $rowArray['qty'],
            'satuan' => $rowArray['satuan'],
            'register_location' => $rowArray['register_location'],
            'layout' => $rowArray['layout'],
            'register_date' => now(), // Use the current date
            'supplier' => $rowArray['supplier'],
            'status' => $rowArray['status'],
            'purchase_number' => $rowArray['purchase_number'],
            'purchase_date' => $rowArray['purchase_date'],
            'warranty' => $rowArray['warranty'],
            'periodic_maintenance' => $rowArray['periodic_maintenance'],
            'approve_status' => 'In Process' // Default value
        ]);
    }

    private function generateRandomRegisterCode()
    {
        // Generate a random number, adjust the range as needed
        return rand(100000, 999999); // Generates a random 6-digit number
    }
}
