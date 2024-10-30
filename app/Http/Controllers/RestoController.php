<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterRestoModel;
use Illuminate\Http\Request;

class RestoController extends Controller
{
    public function GetDataResto(Request $request) {
        // Get the search term from the request
        $searchTerm = $request->input('search');
    
        // If a search term is provided, filter across multiple fields
        if ($searchTerm) {
            $dataResto = MasterRestoModel::where('kode_resto', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('resto', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('kom_resto', 'LIKE', '%' . $searchTerm . '%')
                ->get();
        } else {
            // Return all data if no search term is provided
            $dataResto = MasterRestoModel::all();
        }
    
        // Return the results as JSON
        return response()->json($dataResto);
    }
    
    
}
