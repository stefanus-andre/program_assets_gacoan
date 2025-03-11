<?php



namespace App\Http\Controllers;



use App\Models\Master\MasterRestoModel;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;



class RestoController extends Controller

{


    public function DataResto()
    {
        $datas = DB::table('master_resto_v2')
            ->select('master_resto_v2.*')
            ->paginate(10);
        return view('Admin.resto', compact('datas'));
    }


    public function GetDataResto(Request $request)
    {

        $searchTerm = $request->input('search');


        if ($searchTerm) {

            $dataResto = MasterRestoModel::where('kode_resto', 'LIKE', '%' . $searchTerm . '%')

                ->orWhere('resto', 'LIKE', '%' . $searchTerm . '%')

                ->orWhere('kom_resto', 'LIKE', '%' . $searchTerm . '%')

                ->orWhere('name_store_street', 'LIKE', '%' . $searchTerm . '%')

                ->get();
        } else {

            $dataResto = MasterRestoModel::all();
        }



        // Log data for debugging (optional)

        // \Log::info($dataResto);



        return response()->json($dataResto);
    }



    public function getInitialRegisterLocation()

    {

        // Assuming you have a way to get the specific initial register location

        $initialResto = MasterRestoModel::first(); // Fetch the first record as an example



        // Return the initial register location as JSON

        return response()->json([

            'register_location' => $initialResto ? $initialResto->kode_resto . ' - ' . $initialResto->resto . ' - ' . $initialResto->kom_resto : null

        ]);
    }


    public function getResto()

    {

        // Mengambil semua data dari tabel m_city

        $datas = DB::table('master_resto_v2')
            ->select('master_resto_v2.*')
            ->get();

        return response()->json($datas);
    }

    public function details($restoId)

    {

        $resto = MasterRestoModel::where('id', $restoId)->first();



        if (!$resto) {

            abort(404, 'Resto not found');
        }



        return view('resto.details', ['asset' => $city]);
    }
}
