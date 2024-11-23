<?php



namespace App\Http\Controllers;



use App\Models\Master\MasterRestoModel;

use Illuminate\Http\Request;



class RestoController extends Controller

{

    public function GetDataResto(Request $request) {

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

    

    

}

