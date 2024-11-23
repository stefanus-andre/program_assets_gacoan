<?php

namespace App\Http\Controllers;

class ReportController extends Controller {

    public function ReportRegistrasiAsset() {
        return view('Admin.report.report_registrasi_asset');
    }

    public function ReportMutasiStock() {
        return view('Admin.report.report_mutasi_stock');
    }

    public function ReportKartuStock() {
        return view('Admin.report.report_kartu_stock');
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

    public function ReportStockAsset() {
        return view('Admin.report.report_stock_asset');
    }

    public function ReportGaransiAsset() {
        return view('Admin.report.report_garansi_asset');
    }

    public function ReportDisposalAsset() {
        return view('Admin.report.report_disposal_asset');
    }

    public function ReportStockOpname() {
        return view('Admin.report.report_stock_opname');
    }

    public function ReportTrendIssue() {
        return view('Admin.report.report_trend_issue');
    }
}