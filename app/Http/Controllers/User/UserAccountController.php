<?php



namespace App\Http\Controllers\User;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\JsonResponse;



class UserAccountController extends Controller

{

    public function Index() {

        return view('User.user_dashboard');

    }

      
    public function GetTotalDataAsset(): JsonResponse
    
    {
        $totalDataAsset = DB::table('table_registrasi_asset')
        ->select('table_registrasi_asset.*')
        ->get();

    $count = $totalDataAsset->count(); // Count the total number of rows

    return response()->json([
        'total_count' => $count,
        'data' => $totalDataAsset
    ]);
    }


    public function GetTotalDataAssetRusak(): JsonResponse 
    {
        $totalDataAssetRusak = DB::table('table_registrasi_asset')
        ->select('table_registrasi_asset.*', 'm_condition.condition_name')
        ->join('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
        ->where('m_condition.condition_name', '=', 'BROKEN')
        ->get();

        $count = $totalDataAssetRusak->count(); // Count the total number of rows

        return response()->json([
            'total_count' => $count,
            'data' => $totalDataAssetRusak
        ]);
    }


    public function GetTotalDataAssetBagus(): JsonResponse 
    {
        $totalDataAssetBagus = DB::table('table_registrasi_asset')
        ->select('table_registrasi_asset.*', 'm_condition.condition_name')
        ->join('m_condition', 'table_registrasi_asset.condition', '=', 'm_condition.condition_id')
        ->where('m_condition.condition_name', '=', 'GOOD')
        ->get();

        $count = $totalDataAssetBagus->count(); // Count the total number of rows

        return response()->json([
            'total_count' => $count,
            'data' => $totalDataAssetBagus
        ]);
    }


}

