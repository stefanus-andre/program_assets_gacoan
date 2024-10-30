<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterStockOpnameModel;
use Illuminate\Http\Request;

class StockOpnameController extends Controller
{
    public function HalamanStockOpname() {
        return view('admin.stock_opname.laman_stock_opname');
    }

    public function GetDataStockOpname() {
        $dataStockOpname = MasterStockOpnameModel::all();
        return response()->json($dataStockOpname);
    }
}
