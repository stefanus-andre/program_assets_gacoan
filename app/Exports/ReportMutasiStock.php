<?php

namespace App\Exports;

use App\Models\Master\MasterRegistrasiModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Exports\QrCode;
use Illuminate\Support\Facades\DB;

class ReportMutasiStock implements FromCollection, WithHeadings
{
    public function collection()
    {
        $DataMutasiStock = DB::table('t_out')
        ->select(
            't_out.out_id',
            't_out_detail.out_id',
            't_out.create_by',
            't_out.tf_code',
            't_out.appr_1_date',
            't_out.appr_2_date',
            't_out.appr_3_date',
            'm_assets.asset_model',
            'table_registrasi_asset.qty',
            'm_uom.uom_name',
            'from_location.name_store_street AS from_store',
            'dest_location.name_store_street AS dest_store',
            't_out.out_date',
            't_out.updated_at',
            'm_condition.condition_name'
        )
        ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
        ->join('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
        ->join(DB::raw('master_resto_v2 AS from_location'), 't_out.from_loc', '=', 'from_location.id')
        ->join(DB::raw('master_resto_v2 AS dest_location'), 't_out.dest_loc', '=', 'dest_location.id')
        ->join('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('m_uom', 't_out_detail.uom', '=', 'm_uom.uom_id')
        ->join('m_condition', 't_out_detail.condition', '=', 'm_condition.condition_id')
        ->get();
    

        return collect($DataMutasiStock);
    }

    public function headings(): array
    {
        return [
            'Asset Tag',
            'User Create',
            'Transfer Code',
            'Approval 1 Date',
            'Approval 2 Date',
            'Approval 3 Date',
            'Asset Name',
            'Quantity',
            'Satuan',
            'From Location',
            'To Location',
            'Transfer Date',
            'Confirmation Date',
            'Condition'
        ];
    }
}
