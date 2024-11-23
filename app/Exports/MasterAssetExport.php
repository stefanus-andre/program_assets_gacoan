<?php 

namespace App\Exports;

use App\Models\Master\MasterAsset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class MasterAssetExport implements FromCollection, WithHeadings
{
    public function collection() {
        $MasterAsset = DB::table('m_assets')
        ->select('asset_id','asset_code','asset_model','m_priority.priority_name', 'm_category.cat_name', 'm_type.type_name', 'm_uom.uom_name')
        ->join('m_priority', 'm_assets.priority_id', '=', 'm_priority.priority_id')
        ->join('m_category', 'm_assets.cat_id', '=', 'm_category.cat_id')
        ->join('m_type', 'm_assets.type_id', '=' , 'm_type.type_id')
        ->join('m_uom', 'm_assets.uom_id', '=' , 'm_uom.uom_id')
        ->get();

        return $MasterAsset;
    }

    public function headings(): array {
    
        return [
            'No',
            'Asset Code',
            'Asset Model',
            'Prioritas',
            'Kategori',
            'Tipe',
            'Satuan' 
        ];
    }
}