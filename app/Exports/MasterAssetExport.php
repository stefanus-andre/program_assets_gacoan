<?php 

namespace App\Exports;

use App\Models\Master\MasterAsset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class MasterAssetExport implements FromCollection, WithHeadings
{
    public function collection() {
        $query = DB::table('m_assets')
            ->select(
                'm_assets.asset_code',
                'm_assets.asset_model',
                'm_priority.priority_name',
                'm_category.cat_name',
                'm_type.type_name',
                'm_uom.uom_name'
            )
            ->leftJoin('m_priority', 'm_assets.priority_id', '=', 'm_priority.priority_id')
            ->leftJoin('m_category', 'm_assets.cat_id', '=', 'm_category.cat_id')
            ->leftJoin('m_type', 'm_assets.type_id', '=', 'm_type.type_id')
            ->leftJoin('m_uom', 'm_assets.uom_id', '=', 'm_uom.uom_id');
    
        // Apply dynamic filters
        if (request()->has('priority_id')) {
            $query->where('m_assets.priority_id', request('priority_id'));
        }
        if (request()->has('category_id')) {
            $query->where('m_assets.cat_id', request('category_id'));
        }
        if (request()->has('type_id')) {
            $query->where('m_assets.type_id', request('type_id'));
        }
    
        $MasterAsset = $query->get();
    
        // Add a "No" column as the first column
        $MasterAsset = $MasterAsset->map(function ($row, $key) {
            return [
                'No' => $key + 1, // Add "No" column
                'Asset Code' => $row->asset_code,
                'Asset Model' => $row->asset_model,
                'Prioritas' => $row->priority_name,
                'Kategori' => $row->cat_name,
                'Tipe' => $row->type_name,
                'Satuan' => $row->uom_name,
            ];
        });
    
        return $MasterAsset;
    }
    
    

    public function headings(): array {
    
        return [
            'No',            // Custom column for numbering
            'Asset Code',
            'Asset Model',
            'Prioritas',
            'Kategori',
            'Tipe',
            'Satuan',
        ];
    }
}