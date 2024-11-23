<?php

namespace App\Exports;

use App\Models\Master\MasterRegistrasiModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Exports\QrCode;
use Illuminate\Support\Facades\DB;

class AssetExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch all assets with QR code paths from the database
        $dataAsset = DB::table('table_registrasi_asset')->select('id', 'register_code','asset_name', 'serial_number', 'type_asset', 'category_asset', 'prioritas','merk', 'qty','satuan',
       'width', 'height', 'depth', 'register_location','layout', 'register_date','supplier', 'status', 'purchase_number','purchase_date', 'warranty', 'periodic_maintenance')->get();

        foreach ($dataAsset as $Asset) {
            if (!empty($Asset->asset_code)) {
                $qrCodeFileName = $Asset->asset_code . '.png';
                $qrCodeFilePath = storage_path('app/public/qrcodes/' . $qrCodeFileName);

                if (file_exists($qrCodeFilePath)) {
                    $Asset->qr_code_path = asset('storage/qrcodes/' . $qrCodeFileName);
                } else {
                    QrCode::format('png')->size(300)->generate($Asset->asset_code, $qrCodeFilePath);
                    $Asset->qr_code_path = asset('storage/qrcodes/' . $qrCodeFileName);
                }
            }
        }

        // Return the collection of assets
        return $dataAsset;
    }

    public function headings(): array
    {
        return [
            'No',
            'Register Code',
            'Asset Name',
            'Serial Number',
            'Type Asset',
            'Category Asset',
            'Prioritas',
            'Merk',
            'Qty',
            'Satuan',
            'Width',
            'Height',
            'Depth',
            'Register Location',
            'Layout',
            'Register Date',
            'Supplier',
            'Status',
            'Purchase Number',
            'Purchase Date',
            'Warranty',
            'Periodic Maintenance'
        ];
    }
}
