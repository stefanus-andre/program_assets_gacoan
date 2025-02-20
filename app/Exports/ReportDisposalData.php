<?php

namespace App\Exports;

use App\Models\Master\MasterRegistrasiModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Exports\QrCode;
use Illuminate\Support\Facades\DB;

class ReportDisposalData implements FromCollection, WithHeadings
{
    public function collection()
    {
        $DataDisposal = DB::table('t_out')
        ->select(
            't_out.out_id',
            't_out_detail.out_id',
            'table_registrasi_asset.register_code',
            'm_assets.asset_model',
            'table_registrasi_asset.created_at AS registrasi_date',
            't_out.create_date AS date_destruction',
            'm_reason.reason_name',
            'mc_approval.approval_name',
            'm_condition.condition_name',
            't_out.out_desc'
        )
        
        ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
        ->join('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
        ->join('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
        ->join('m_condition', 't_out_detail.condition', '=', 'm_condition.condition_id')
        ->where('t_out.out_id', 'like', 'DA%')
        ->get();
    

        return collect($DataDisposal);
    }

    public function headings(): array
    {
        return [
            'Code Disposal Asset',
            'Asset Tag',
            'Asset Name',
            'Date Register',
            'Disposal Date',
            'Reason',
            'Approval Status',
            'Condition',
            'Note'
        ];
    }
}
