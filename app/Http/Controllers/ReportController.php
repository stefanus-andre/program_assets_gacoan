<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\JsonResponse;

use Maatwebsite\Excel\Facades\Excel;

use App\Exports\ReportMutasiStock;

use App\Exports\ReportDisposalData;

class ReportController extends Controller {

    public function ReportRegistrasiAsset() {
        return view('Admin.report.report_registrasi_asset');
    }


    public function ReportGetDataRegistrasiAsset(): JsonResponse {
    
        $dataAsset = DB::table('table_registrasi_asset')
            ->select('table_registrasi_asset.id'
                    ,'table_registrasi_asset.register_code'    
                    ,'table_registrasi_asset.serial_number'
                    ,'table_registrasi_asset.register_date'
                    ,'table_registrasi_asset.purchase_date'
                    ,'table_registrasi_asset.approve_status'
                    ,'table_registrasi_asset.serial_number'
                    ,'m_assets.asset_model'
                    ,'m_type.type_name'
                    ,'m_category.cat_name'
                    ,'m_priority.priority_name'
                    ,'m_brand.brand_name'
                    ,'m_uom.uom_name'
                    ,'master_resto_v2.name_store_street'
                    ,'m_layout.layout_name'
                    ,'m_supplier.supplier_name'
                    ,'m_condition.condition_name'
                    ,'m_warranty.warranty_name'
                    ,'m_periodic_mtc.periodic_mtc_name'
                    ,'table_registrasi_asset.deleted_at')
            ->leftJoin('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
            ->leftJoin('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_code')
            ->leftJoin('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
            ->leftJoin('m_priority', 'table_registrasi_asset.prioritas', '=', 'm_priority.priority_code')
            ->leftJoin('m_brand', 'table_registrasi_asset.merk', '=', 'm_brand.brand_id')
            ->leftJoin('m_uom', 'table_registrasi_asset.satuan', '=', 'm_uom.uom_id')
            ->leftJoin('master_resto_v2', 'table_registrasi_asset.register_location', '=', 'master_resto_v2.id')
            ->leftJoin('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
            ->leftJoin('m_supplier', 'table_registrasi_asset.supplier', '=', 'm_supplier.supplier_code')
            ->leftJoin('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
            ->leftJoin('m_warranty', 'table_registrasi_asset.warranty', '=', 'm_warranty.warranty_id')
            ->leftJoin('m_periodic_mtc', 'table_registrasi_asset.periodic_maintenance', '=', 'm_periodic_mtc.periodic_mtc_id')
            ->get();



    foreach ($dataAsset as $Asset) {

        // Set data_registrasi_asset_status based on deleted_at

        $Asset->data_registrasi_asset_status = is_null($Asset->deleted_at) ? 'active' : 'nonactive';



        // Check if asset_code is not null before generating the QR code

        if (!empty($Asset->asset_code)) {

            // Define the file path for the QR code

            $qrCodeFileName = $Asset->asset_code . '.png';

            $qrCodeFilePath = public_path('qrcodes/' . $qrCodeFileName);



            // Check if the QR code already exists

            if (file_exists($qrCodeFilePath)) {

                // Assign the QR code path to the asset object

                $Asset->qr_code_path = asset('public/qrcodes/' . $qrCodeFileName);

            } else {

                // Generate the QR code and save it to the defined path if it doesn't exist

                QrCode::format('png')->size(300)->generate($Asset->asset_code, $qrCodeFilePath);

                // Assign the newly generated QR code path to the asset object

                $Asset->qr_code_path = asset('public/qrcodes/' . $qrCodeFileName);

            }

        }

    }

    return response()->json($dataAsset);

}

    public function ReportMutasiStock() {
        return view('Admin.report.report_mutasi_stock');
    }


    public function ReportMutasiStockData() : JsonResponse {
    
        $DataMutasiStock = DB::table('t_out')
        ->select(
            't_out.*',
            't_out_detail.*',
            'table_registrasi_asset.*',
            'm_assets.*',
            // 't_out.from_loc',
            // 't_out.dest_loc',
            'from_location.name_store_street AS from_store',
            'dest_location.name_store_street AS dest_store',
            'm_reason.reason_name',
            'm_uom.uom_name',
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
    
        return response()->json($DataMutasiStock);
    }


    public function ExportExcelMutasiStock() {
        return Excel::download(new ReportMutasiStock,'data_mutasi_stock.xlsx');
    }

    public function ReportKartuStock() {
        return view('Admin.report.report_kartu_stock');
    }

    public function GetDataKartuStock() {
            $DataKartuStock = DB::table('t_out')
            ->select(
                't_out.*',
                't_out_detail.*',
                't_out_detail.qty as qty_out',
                'table_registrasi_asset.id',
                'table_registrasi_asset.created_at',
                'table_registrasi_asset.register_code',
                'table_registrasi_asset.qty',
                'm_assets.asset_model',
                'm_condition.condition_name',
                'm_type.type_name',
                'm_category.cat_name',
                'm_uom.uom_name'
                )
            ->join('t_out_detail','t_out.out_id', '=', 't_out_detail.out_id')
            ->join('table_registrasi_asset','t_out_detail.asset_id', '=', 'table_registrasi_asset.id')
            ->join('m_assets','table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
            ->join('m_condition','t_out_detail.condition', '=', 'm_condition.condition_id')
            ->join('m_type','table_registrasi_asset.type_asset', '=', 'm_type.type_code')
            ->join('m_category','table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
            ->join('m_uom','t_out_detail.uom', '=', 'm_uom.uom_id')
            ->get();

            return response()->json($DataKartuStock);
    }


    public function ExportExcelKartuStock() {
        return Excel::download(new ReportKartuStock, 'data_kartu_stock.xlsx');
    }


    public function ReportChecklistAsset() {
        return view('Admin.report.report_checklist_asset');
    }

    public function ReportMaintenaceAsset() {
        return view('Admin.report.report_maintenance_asset');
    }

    public function ReportHistoryMaintenace() {
        return view('Admin.report.report_history_maintenance');
    }

    
    public function ReportStockAssetPerLocation() {
        return view('Admin.report.report_stock_asset_per_location');
    }

    public function GetDataStockAssetPerLocation() {
        $DataStockAssetPerLocation = DB::table('t_out')
        ->select(
            't_out.*',
            't_out_detail.*',
            't_out_detail.qty as qty_out',
            'table_registrasi_asset.id',
            'table_registrasi_asset.created_at',
            'table_registrasi_asset.register_code',
            'table_registrasi_asset.qty',
            'm_assets.asset_model',
            'm_condition.condition_name',
            'm_type.type_name',
            'm_category.cat_name',
            'm_uom.uom_name',
            'm_layout.layout_name',
            'master_resto_v2.name_store_street'
            )
        ->join('t_out_detail','t_out.out_id', '=', 't_out_detail.out_id')
        ->join('table_registrasi_asset','t_out_detail.asset_id', '=', 'table_registrasi_asset.id')
        ->join('m_assets','table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
        ->join('m_condition','t_out_detail.condition', '=', 'm_condition.condition_id')
        ->join('m_type','table_registrasi_asset.type_asset', '=', 'm_type.type_code')
        ->join('m_category','table_registrasi_asset.category_asset', '=', 'm_category.cat_code')
        ->join('m_uom','t_out_detail.uom', '=', 'm_uom.uom_id')
        ->join('m_layout', 'table_registrasi_asset.layout', '=', 'm_layout.layout_id')
        ->join('master_resto_v2', 't_out.dest_loc', '=', 'master_resto_v2.id')
        ->get();


        return response()->json($DataStockAssetPerLocation);
    }

    public function ExportStockAsset() {
        return Excel::download(new ReportStockAsset, 'data_stock_asset.xlsx');
    }


    public function ReportGaransiAsset() {
        return view('Admin.report.report_garansi_asset');
    }

    public function ReportDisposalAsset() {
        return view('Admin.report.report_disposal_asset');
    }

    public function ReportDisposalAssetData() : JsonResponse {
        $DataDisposal = DB::table('t_out')
        ->select(
            't_out.*',
            't_out_detail.*',
            'm_reason.reason_name',
            'mc_approval.approval_name',
            'master_resto_v2.*',
            'table_registrasi_asset.*',
            'm_assets.*'
        )
        ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id') // Added this join
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
        ->join('master_resto_v2', 't_out.from_loc', '=', 'master_resto_v2.id')
        ->join('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
        ->join('m_assets', 'table_registrasi_asset.asset_name', '=', 'm_assets.asset_id')
        ->where('t_out.out_id', 'like', 'DA%') 
        ->get();
    
    
    return response()->json($DataDisposal);
    
    }

    public function ExportExcelDisposalAssetData() {
        return Excel::download(new ReportDisposalData,'data_disposal_asset.xlsx');
    }

    public function ReportStockOpname() {
        return view('Admin.report.report_stock_opname');
    }


    public function ReportStockOpnameData() : JsonResponse {
        $dataStockOpname = DB::table('t_opname_header')
        ->join('t_opname_detail', 't_opname_header.opname_id', '=', 't_opname_detail.opname_id')
        ->join('master_resto_v2', 't_opname_header.loc_id', '=', 'master_resto_v2.id')
        ->join('m_condition', 'm_condition.condition_id', '=', 't_opname_detail.condition')
        ->join('m_uom', 'm_uom.uom_id', '=', 't_opname_detail.uom')
        ->select(
            't_opname_header.opname_id', 
            't_opname_header.opname_desc',
            't_opname_header.deleted_at',
            't_opname_detail.*', 
            'm_condition.condition_name', 
            'm_uom.uom_name', 
            'master_resto_v2.name_store_street AS location_now')
        ->where('t_opname_header.is_active', '=', '1')
        ->get();

        return response()->json($dataStockOpname);
    }

    public function ReportTrendIssue() {
        return view('Admin.report.report_trend_issue');
    }
}