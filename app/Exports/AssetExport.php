<?php

namespace App\Exports;

use App\Models\Master\MasterRegistrasiModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AssetExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch all assets with QR code paths from the database
        $dataAsset = MasterRegistrasiModel::all();

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
            'ID',
            'Register Code',
            'Asset Name',
            'Serial Number',
            'Type Asset',
            'Category Asset',
            'Prioritas',
            'Merk',
            'Qty',
            'Satuan',
            'Register Location',
            'Layout',
            'Register Date',
            'Supplier',
            'Status',
            'Purchase Number',
            'Purchase Date',
            'Warranty',
            'Periodic Maintenance',
            'QR Code Path',
            'created_at',
            'updated_at',
            'deleted_at'
        ];
    }
}
