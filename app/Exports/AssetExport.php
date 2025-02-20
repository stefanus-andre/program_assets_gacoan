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
        $dataAsset = DB::table('table_registrasi_asset')
        ->select(
            'table_registrasi_asset.id',
            'table_registrasi_asset.register_code',
            'm_assets.asset_model as asset_name',
            'table_registrasi_asset.serial_number',
            'm_type.type_name as type_asset',
            'm_category.cat_name as category_asset',
            'm_priority.priority_name as prioritas',
            'm_brand.brand_name',
            'table_registrasi_asset.qty',
            'm_uom.uom_name as satuan',
            'table_registrasi_asset.width',
            'table_registrasi_asset.height',
            'table_registrasi_asset.depth',
            'master_resto_v2.name_store_street as register_location',
            'm_layout.layout_name as layout',
            'table_registrasi_asset.register_date',
            'm_supplier.supplier_name as supplier',
            'm_condition.condition_name as condition',
            'table_registrasi_asset.purchase_number',
            'table_registrasi_asset.purchase_date',
            'm_warranty.warranty_name as warranty',
            'm_periodic_mtc.periodic_mtc_name as periodic_maintenance'
        )
        ->leftJoin('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
        ->leftJoin('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
        ->leftJoin('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
        ->leftJoin('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
        ->leftJoin('m_priority', 'table_registrasi_asset.prioritas', '=', 'm_priority.priority_code')
        ->leftJoin('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
        ->leftJoin('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
        ->leftJoin('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
        ->leftJoin('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
        ->leftJoin('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
        ->leftJoin('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
        ->leftJoin('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
        ->get();
    

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
        return collect($dataAsset);
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
            'Condition',
            'Purchase Number',
            'Purchase Date',
            'Warranty',
            'Periodic Maintenance'
        ];
    }
}
