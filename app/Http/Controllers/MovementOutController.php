<?php



namespace App\Http\Controllers;



use App\Models\Master\MasterAsset;

use App\Models\Master\MasterMoveOut;

use App\Models\Master\MasterRegistrasiModel;

use App\Models\Master\TOutDetail;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;





class MovementOutController  extends Controller

{

    public function Index()

    {

        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();

        $restos = DB::table('master_resto_v2')->select('store_code', 'name_store_street')->get();

        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();

        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();

        

        $username = auth()->user()->username;

        $fromLoc = DB::table('m_people')

                ->where('nip', $username)

                ->value('loc_id');



        $registerLocation = DB::table('master_resto')

                ->where('store_code', $fromLoc)

                ->value('resto');

    

        // Filter assets based on the register_location matching the fetched resto

        $assets = DB::table('table_registrasi_asset')

            ->select('id', 'asset_name')

            // ->where('location_now', $registerLocation)

            ->where('qty', '>', 0) 

            ->get();       



        $moveouts = DB::table('t_out')

        ->leftjoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')

        ->leftjoin('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')

        ->where('t_out.is_active', 1) // Only include active records

        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')

        ->paginate(10);



        return view("Admin.movement.lihat_data_movement", [

            'fromLoc' => $fromLoc,

            'reasons' => $reasons,

            'assets' => $assets,

            'conditions' => $conditions,

            'moveouts' => $moveouts,

            'restos' => $restos

        ]);

    }



    public function HalamanMoveOut(Request $request)

    {

        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();

        $restos = DB::table('master_resto_v2')->select('store_code', 'name_store_street')->get();

        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();

        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();

        

        $username = auth()->user()->username;

        $fromLoc = DB::table('m_user')

                ->where('username', $username)

                ->value('location_now');



        $registerLocation = DB::table('master_resto_v2')

                ->where('name_store_street', $fromLoc)

                ->value('name_store_street');

    

        // Filter assets based on the location_now matching the fetched resto

        $assets = DB::table('table_registrasi_asset')

            ->select('id', 'asset_name')

            // ->where('register_location', $registerLocation)

            ->where('qty', '>', 0) 

            ->get();        



        $moveoutsQuery = DB::table('t_out')

            ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')

            ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')

            ->where('t_out.is_active', 1)

            ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name');



        // Apply date range filter if provided

        if ($request->filled('start_date') && $request->filled('end_date')) {

            $startDate = $request->input('start_date') . ' 00:00:00'; // mulai dari awal hari

            $endDate = $request->input('end_date') . ' 23:59:59'; // sampai akhir hari

            $moveoutsQuery->whereBetween('t_out.out_date', [$startDate, $endDate]);

        }

    

        // Paginate the results

        $moveouts = $moveoutsQuery->paginate(10);





        return view("Admin.movement.lihat_data_movement", [

            'fromLoc' => $fromLoc,

            'reasons' => $reasons,

            'assets' => $assets,

            'conditions' => $conditions,

            'moveouts' => $moveouts,

            'restos' => $restos

        ]);

        

    }


    public function LihatFormMoveOut() {

        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();

        $restos = DB::table('master_resto_v2')->select('store_code', 'name_store_street')->get();

        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();

        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();

        

        $username = auth()->user()->username;

        $fromLoc = DB::table('m_user')

                ->where('username', $username)

                ->value('location_now');



        $registerLocation = DB::table('master_resto_v2')

                ->where('name_store_street', $fromLoc)

                ->value('name_store_street');

    

        // Filter assets based on the location_now matching the fetched resto

        $assets = DB::table('table_registrasi_asset')

            ->select('id', 'asset_name')

            // ->where('register_location', $registerLocation)

            ->where('qty', '>', 0) 

            ->get();        



        $moveoutsQuery = DB::table('t_out')

            ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')

            ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')

            ->where('t_out.is_active', 1)

            ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name');



        // // Apply date range filter if provided

        // if ($request->filled('start_date') && $request->filled('end_date')) {

        //     $startDate = $request->input('start_date') . ' 00:00:00'; // mulai dari awal hari

        //     $endDate = $request->input('end_date') . ' 23:59:59'; // sampai akhir hari

        //     $moveoutsQuery->whereBetween('t_out.out_date', [$startDate, $endDate]);

        // }

    

        // Paginate the results

        $moveouts = $moveoutsQuery->paginate(10);



        return view('Admin.movement.add_data_movement',[
            
            'fromLoc' => $fromLoc,

            'reasons' => $reasons,

            'assets' => $assets,
            
            'conditions' => $conditions,

            'moveouts' => $moveouts,

            'restos' => $restos
        ]);
    }



    public function printPDF($id)

    {

        // Ambil data dari tabel t_out dan t_out_detail berdasarkan ID

        $moveout = MasterMoveOut::with('details')->findOrFail($id);



        // Generate PDF

        $pdf = Pdf::loadView('Admin.pdf-moveout', compact('moveout'));



        // Return PDF response untuk di-download atau dilihat

        return $pdf->download('moveout_' . $moveout->out_no . '.pdf');

    }



    public function previewPDF($out_id)

    {

        // Ambil data berdasarkan out_id

        $data = DB::table('t_out')
        ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
        ->leftJoin('master_resto_v2 as origin', 't_out.from_loc', '=', 'origin.store_code')
        ->leftJoin('master_resto_v2 as destination', 't_out.dest_loc', '=', 'destination.store_code')
        ->leftJoin('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
        ->leftJoin('m_condition', 't_out_detail.condition', '=', 'm_condition.condition_id')
        ->leftJoin('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_id')
        ->leftJoin('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_id')
        ->where('t_out.out_id', $out_id)
        ->select(
            't_out.*',
            't_out_detail.*',
            'origin.store_code as origin_store_code', // Include origin store_code
            'origin.resto as origin_store_name',
            'destination.store_code as destination_store_code', // Include destination store_code
            'destination.resto as destination_store_name',
            'table_registrasi_asset.asset_name',
            'table_registrasi_asset.category_asset',
            'table_registrasi_asset.serial_number',
            'table_registrasi_asset.type_asset',
            'm_condition.condition_name',
            'm_type.type_name',
            'm_category.cat_name'
        )
        ->first();
    



        // Jika data tidak ditemukan, tampilkan halaman 404

        if (!$data) {

            abort(404, 'MoveOut not found');

        }



        // Buat PDF menggunakan data yang ditemukan

        $pdf = PDF::loadView('Admin.pdf-moveout', compact('data'));



        return response($pdf->output(), 200)->header('Content-Type', 'application/pdf');

    }



    public function downloadPDF()

    {

        $data = $this->getData();

        $pdf = PDF::loadView('Admin.pdf-moveout', compact('data'));



        // Unduh PDF

        return $pdf->download('moveout.pdf');

    }



    // public function showPutForm($outId)

    // {

    //     $moveout = MasterMoveOut::where('out_id', $outId)->first(); // Corrected to match the relationship name

    

    //     if (!$moveout) {

    //         return response()->json(['message' => 'Moveout not found'], 404);

    //     }

    

    //     return response()->json($moveout);

    // }



    // public function showPutFormDetail($outId)

    // {

    //     // Ambil hanya kolom yang diperlukan

    //     $moveoutDetails = TOutDetail::where('out_id', $outId)

    //         ->select('brand', 'qty', 'condition', 'uom', 'serial_number', 'asset_tag')

    //         ->get();



    //     if ($moveoutDetails->isEmpty()) {

    //         // Return a 404 response jika data tidak ditemukan

    //         return response()->json(['message' => 'Moveout Detail not found'], 404);

    //     }



    //     // Kembalikan detail moveout sebagai JSON

    //     return response()->json($moveoutDetails);

    // }



    public function showPutFormMoveout($outId)

    {

        $moveout = MasterMoveOut::find('out_id', $outId)->first();

        

        if (!$moveout) {

            return response()->json(['message' => 'Moveout not found'], 404);

        }

        

        return response()->json($moveout);

    }



    public function showPutFormMoveoutDetail($outId)
    {
        try {
            Log::info("showPutFormMoveoutDetail called with out_id: $outId");
    
            // Fetch the moveout details
            $moveout = TOutDetail::where('out_id', $outId)->first();
    
            if (!$moveout) {
                // Log a warning for missing data
                Log::warning("No details found for out_id: $outId");
                return response()->json(['error' => true, 'message' => 'Moveout not found'], 404);
            }
    
            // Log successful retrieval
            Log::info("Moveout details retrieved successfully for out_id: $outId", [
                'details' => $moveout
            ]);
    
            // Return the moveout details
            return response()->json([
                'error' => false,
                'data' => $moveout
            ], 200);
        } catch (\Exception $e) {
            // Log any unexpected errors
            Log::error("Error in showPutFormMoveoutDetail for out_id: $outId", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            // Return a generic error response
            return response()->json([
                'error' => true,
                'message' => 'An unexpected error occurred. Please try again later.'
            ], 500);
        }
    }
    


    public function getMoveOut()

    {

        // Mengambil semua data dari tabel t_out

        $moveouts = MasterMoveOut::all();

        return response()->json($moveouts); // Mengembalikan data dalam format JSON

    }



    public function getAssetDetails($id)

    {

        $asset = MasterRegistrasiModel::find($id);



        if ($asset) {

            return response()->json([

                'merk' => $asset->merk,

                'qty' => $asset->qty,

                'satuan' => $asset->satuan,

                'serial_number' => $asset->serial_number,

                'register_code' => $asset->register_code,

            ]);

        } else {

            return response()->json([], 404); // Not found

        }

    }



    public function getMoveoutDetails($id)

    {

        // Retrieve moveout and related details

        $moveout = MasterMoveOut::find($id);

        $details = $moveout ? $moveout->details : [];



        return response()->json([

            'moveout' => $moveout,

            'details' => $details

        ]);

    }



    // public function getOutData($out_id)

    // {

    //     $outData = DB::table('t_out')

    //                 ->where('out_id', $out_id)

    //                 ->first();



    //     $outDetailData = DB::table('t_out_detail')

    //                 ->where('out_id', $out_id)

    //                 ->first();



    //     if ($outData && $outDetailData) {

    //         return response()->json([

    //             'out' => $outData,

    //             'detail' => $outDetailData,

    //         ]);

    //     } else {

    //         return response()->json(['message' => 'Data not found'], 404);

    //     }

    // }



    // // Fetch asset details based on asset_id

    // public function getAssetData($asset_id)

    // {

    //     $assetData = DB::table('table_registrasi_asset')

    //                 ->where('id', $asset_id)

    //                 ->first();



    //     if ($assetData) {

    //         return response()->json($assetData);

    //     } else {

    //         return response()->json(['message' => 'Data not found'], 404);

    //     }

    // }



    public function getDetails($id)

    {

        // Fetch data from t_out and t_out_detail based on the out_id

        $moveOut = DB::table('t_out')

            ->where('out_id', $id)

            ->first();



        $moveOutDetails = DB::table('t_out_detail')

            ->where('out_id', $id)

            ->get(); // Assuming you want to retrieve all details related to this out_id



        $firstDetail = $moveOutDetails->first();

        // Combine the results (if necessary)

        $response = [

            'out_id' => $moveOut->out_id,

            'out_no' => $moveOut->out_no,

            'out_date' => $moveOut->out_date,

            'from_loc' => $moveOut->from_loc,

            'dest_loc' => $moveOut->dest_loc,

            'in_id' => $moveOut->in_id,

            'reason_id' => $moveOut->reason_id,

            'out_desc' => $moveOut->out_desc,

            'asset_id' => $firstDetail->asset_id ?? '',

            'asset_tag' => $firstDetail->asset_tag ?? '',

            'serial_number' => $firstDetail->serial_number ?? '',

            'brand' => $firstDetail->brand ?? '',

            'qty' => $firstDetail->qty ?? '',

            'uom' => $firstDetail->uom ?? '',

            'condition' => $firstDetail->condition ?? '',

        ];



        return response()->json($response);

    }



public function getMoveOutById($id)

{

    $moveout = MasterMoveOut::find($id); // Fetch the moveout entry by ID



    if ($moveout) {

        return response()->json($moveout); // Return the moveout data as JSON

    }



    return response()->json(['message' => 'MoveOut not found'], 404); // Handle not found case

}



public function AddDataMoveOut(Request $request)
{
    // Validation remains the same
    $request->validate([
        'out_date' => 'required|date',
        'from_loc_id' => 'required|string|max:255',
        'dest_loc' => 'required|string|max:255',
        'out_desc' => 'required|string|max:255',
        'reason_id' => 'required|string|max:255',
        'asset_id' => 'required|array',
        'register_code' => 'required|array',
        'serial_number' => 'required|array',
        'merk' => 'required|array',
        'qty' => 'required|array',
        'satuan' => 'required|array',
        'condition_id' => 'required|array',
    ]);

    // Location check remains the same
    if ($request->input('from_loc') === $request->input('dest_loc')) {
        return redirect()->back()->with('error', 'Lokasi Asal dan Lokasi Tujuan tidak boleh sama!');
    }

    // Generate the out_id ONCE for both master and detail records
    $trx_code = DB::table('t_trx')->where('trx_name', 'Asset Movement')->value('trx_code');
    $today = Carbon::now()->format('ymd');
    $todayCount = MasterMoveOut::whereDate('create_date', Carbon::now())->count() + 1;
    $transaction_number = str_pad($todayCount, 3, '0', STR_PAD_LEFT);
    $out_id = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('from_loc_id')}.{$transaction_number}";

    // Create master record
    $moveout = new MasterMoveOut();
    $moveout->out_date = $request->input('out_date');
    $moveout->from_loc = $request->input('from_loc_id');
    $moveout->dest_loc = $request->input('dest_loc');
    $moveout->out_desc = $request->input('out_desc');
    $moveout->reason_id = $request->input('reason_id');
    $moveout->appr_1 = '1';
    $moveout->is_active = '1';
    $moveout->is_verify = '1';
    $moveout->is_confirm = '1';
    $moveout->create_by = Auth::user()->username;

    // Set the out_no
    $maxMoveoutId = MasterMoveOut::max('out_no');
    $out_no_base = $maxMoveoutId ? $maxMoveoutId + 1 : 1;
    $moveout->out_no = $out_no_base;

    // Set the out_id (using the same one we generated above)
    $moveout->out_id = $out_id;

    // Save master record
    $moveout->save();

    // Loop through assets and save details using the same out_id
    foreach ($request->input('asset_id') as $index => $assetId) {
        DB::table('t_out_detail')->insert([
            'out_det_id' => $moveout->out_no,
            'out_id' => $out_id,  // Use the same out_id as the master record
            'asset_id' => $assetId,
            'asset_tag' => $request->input('register_code')[$index],
            'serial_number' => $request->input('serial_number')[$index],
            'brand' => $request->input('merk')[$index],
            'qty' => $request->input('qty')[$index],
            'uom' => $request->input('satuan')[$index],
            'condition' => $request->input('condition_id')[$index],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}




// public function AddDataMoveOut(Request $request)
// {
//     // Validasi data yang dikirimkan
//     $request->validate([
//         'out_date' => 'required|date',
//         'from_loc' => 'required|string|max:255',
//         'dest_loc' => 'required|string|max:255',
//         'out_desc' => 'required|string|max:255',
//         'reason_id' => 'required|string|max:255',
//         'asset_id' => 'required|array',
//         'register_code' => 'required|array',
//         'serial_number' => 'required|array',
//         'merk' => 'required|array',
//         'qty' => 'required|array',
//         'satuan' => 'required|array',
//         'condition_id' => 'required|array',
//     ], [
//         'dest_loc.different' => 'Lokasi Asal dan Lokasi Tujuan tidak boleh sama!',
//     ]);

//     // Manual check for same values before proceeding
//     if ($request->input('from_loc') === $request->input('dest_loc')) {
//         return redirect()->back()->with('error', 'Lokasi Asal dan Lokasi Tujuan tidak boleh sama!');
//     }

//     // Buat instance dari model MasterMoveOut
//     $moveout = new MasterMoveOut();
//     $moveout->out_date = $request->input('out_date');
//     $moveout->from_loc = $request->input('from_loc');
//     $moveout->dest_loc = $request->input('dest_loc');
//     $moveout->out_desc = $request->input('out_desc');
//     $moveout->reason_id = $request->input('reason_id');
//     $moveout->appr_1 = '1';
//     $moveout->is_active = '1';
//     $moveout->is_verify = '1';
//     $moveout->is_confirm = '1';
//     $moveout->create_by = Auth::user()->username;

//     // Menghasilkan out_no secara otomatis untuk setiap aset
//     $maxMoveoutId = MasterMoveOut::max('out_no');
//     $out_no_base = $maxMoveoutId ? $maxMoveoutId + 1 : 1;
//     $moveout->out_no = $out_no_base;

//     // Format out_id
//     $trx_code = DB::table('t_trx')->where('trx_name', 'Asset Movement')->value('trx_code');
//     $today = Carbon::now()->format('ymd');
//     $todayCount = MasterMoveOut::whereDate('create_date', Carbon::now())->count() + 1;
//     $transaction_number = str_pad($todayCount, 3, '0', STR_PAD_LEFT); // Format as 001, 002, etc.
//     $moveout->out_id = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('from_loc')}.{$transaction_number}";
    

//     // Simpan moveout
//     $moveout->save();

//     // Loop melalui aset untuk menyimpan detail
//     foreach ($request->input('asset_id') as $index => $assetId) {
//         $trx_code = DB::table('t_trx')->where('trx_name', 'Asset Movement')->value('trx_code');
//         $today = Carbon::now()->format('ymd');
//         $lastTransaction = DB::table('t_out_detail')
//             ->where('out_id', 'like', "{$trx_code}.{$today}.%")
//             ->orderBy('out_id', 'desc')
//             ->first();

//         // Calculate the next transaction number
//         if (isset($lastTransaction->opname_id)) {
//             $lastOpnameId = $lastTransaction->opname_id;
//             preg_match('/\.(\d{3})$/', $lastOpnameId, $matches);
//             $transaction_number = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
//         } else {
//             $transaction_number = 1;
//         }

//         $transaction_number_str = str_pad($transaction_number, 3, '0', STR_PAD_LEFT);
//         $out_id = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('from_loc')}.{$transaction_number_str}";

//         // Simpan data detail untuk aset
//         DB::table('t_out_detail')->insert([
//             'out_det_id' => $moveout->out_no,  
//             'out_id' => $out_id,
//             'asset_id' => $assetId,
//             'asset_tag' => $request->input('register_code')[$index],
//             'serial_number' => $request->input('serial_number')[$index],
//             'brand' => $request->input('merk')[$index],
//             'qty' => $request->input('qty')[$index],
//             'uom' => $request->input('satuan')[$index],
//             'condition' => $request->input('condition_id')[$index],
//             'created_at' => Carbon::now(), // Current timestamp for creation
//             'updated_at' => Carbon::now(), // Current timestamp for update
//         ]);

  
//     }

//     return redirect()->route('Admin.moveout')->with('success', 'Data berhasil ditambahkan!');
// }



// DB::table('table_registrasi_asset')
// ->where('id', $assetId)
// ->decrement('qty', $request->input('qty')[$index]);

// DB::table('table_registrasi_asset')
// ->where('id', $assetId)
// ->where('qty', '<', 0)
// ->update(['qty' => 0]);


    // Example push notification function

    private function sendPushNotification($expoPushToken, $title, $body)

    {

        $url = 'https://exp.host/--/api/v2/push/send';

        $data = [

            'to' => $expoPushToken,

            'sound' => 'default',

            'title' => $title,

            'body' => $body,

            'data' => ['MoveOutId' => '12345']

        ];



        $options = [

            'http' => [

                'header' => "Content-type: application/json\r\n",

                'method' => 'POST',

                'content' => json_encode($data)

            ]

        ];



        $context = stream_context_create($options);

        $result = file_get_contents($url, false, $context);



        return $result;

    }



    public function updateDataMoveOut(Request $request, $id)

    {

        // Validasi input

        $request->validate([

            'out_no' => 'required|string|max:255',

        ]);



        // Cek apakah MoveOut dengan id yang benar ada

        $moveout = MasterMoveOut::find($id); // Langsung gunakan find jika ID adalah primary key



        if (!$moveout) {

            return response()->json(['status' => 'error', 'message' => 'move$moveout not found.'], 404);

        }



        // Update data move$moveout

        $moveout->out_no = $request->out_no;

        

        if ($moveout->save()) { // Menggunakan save() yang lebih aman daripada update()

            return response()->json([

                'status' => 'success',

                'message' => 'move$moveout updated successfully.',

                'redirect_url' => route('Admin.moveout'), // Sesuaikan dengan route index Anda

            ]);

        } else {

            return response()->json(['status' => 'error', 'message' => 'Failed to update move$moveout.'], 500);

        }

    }



    public function edit($id)

    {

        $moveout = MasterMoveOut::with('asset')->findOrFail($id); // Assuming MoveOut has a relationship with Asset

        return response()->json($moveout);

    }



    public function deleteDataMoveOut($id)
    {
        // Find the moveout record
        $moveout = MasterMoveOut::find($id);
    
        if ($moveout) {
            // Soft delete the moveout record
            $moveout->is_active = 0;
            $moveout->deleted_at = Carbon::now();
            $moveout->save();
    
            // Soft delete related details
            // $moveout->details()->update(['deleted_at' => Carbon::now()]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'MoveOut and related details deactivated successfully.',
                'redirect_url' => route('Admin.moveout')
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Data MoveOut not found.'], 404);
        }
    }
    
    





    public function details($MoveOutId)

    {

        $moveout = MasterMoveOut::where('out_id', $MoveOutId)->first();



        if (!$moveout) {

            abort(404, 'move$moveout not found');

        }



        return view('move$moveout.details', ['asset' => $moveout]);

    }

    public function getDestLocations(Request $request)
{
    $search = $request->input('search'); // Retrieve the search term

    $locations = DB::table('master_resto_v2')
        ->select('id','store_code', 'name_store_street')
        ->when($search, function ($query, $search) {
            return $query->where('name_store_street', 'LIKE', "%{$search}%");
        })
        ->get();

    return response()->json($locations);
}

public function getAjaxDataAssets() {


$assets = DB::table('table_registrasi_asset')

->select('id', 'asset_name', 'merk', 'qty', 'satuan', 'serial_number', 'register_code')

// ->where('register_location', $registerLocation)

->where('qty', '>', 0) 

->get();        


    return response()->json($assets);
}

public function getAjaxAssetDetails($id)
{
    $asset = DB::table('table_registrasi_asset')
        ->select('merk', 'qty', 'satuan', 'serial_number', 'register_code')
        ->where('id', $id)
        ->first();

    if ($asset) {
        return response()->json($asset);
    } else {
        return response()->json(['error' => 'Asset not found'], 404);
    }
}

public function getLocationUser() {
    $username = auth()->user()->username;

    // Fetch the current location and its ID
    $userLocation = DB::table('m_user')
        ->select('master_resto_v2.id', 'master_resto_v2.name_store_street')
        ->join('master_resto_v2', 'master_resto_v2.id', '=', 'm_user.location_now')
        ->where('m_user.username', $username)
        ->first();

    // Return the location ID and name as JSON
    return response()->json($userLocation);
}


public function getCondition() {
    $condition = DB::table('m_condition')
    ->select('condition_id','condition_name')
    ->get();

    return response()->json($condition);
}


public function searchRegisterAsset(Request $request)
    {
        $query = MasterRegistrasiModel::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('register_code', 'like', "%{$search}%")
                  ->orWhere('asset_name', 'like', "%{$search}%")
                  ->orWhere('serial_number', 'like', "%{$search}%");
        }

        $data = $query->paginate(10); // You can adjust the pagination limit
        return response()->json($data);
    }


    public function ajaxGetDataRegistAsset()
    {
        $assets = DB::table('table_registrasi_asset')
        ->select('table_registrasi_asset.*')
        ->where('qty','>', 0)
        ->get(); // Directly fetch all data
    
        $data = [];
        foreach ($assets as $asset) {
            $data[] = [
                'id' => $asset->id,
                'register_code' => $asset->register_code,
                'asset_name' => $asset->asset_name,
                'type_asset' => $asset->type_asset,
                'category_asset' => $asset->category_asset,
                'condition' => $asset->condition,
                'width' => $asset->width,
                'height' => $asset->height,
                'depth' => $asset->depth,
            ];
        }
    
        return response()->json([
            'data' => $data,
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
        ]);
    }   
        
        public function dataDetailMovement($id) {
            $moveOutAssets = DB::table('t_out')
            ->select('t_out.*','t_out_detail.*')
            ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
            ->where('t_out.out_id',$id)
            ->get();
        
            // if ($moveOutAssets->isEmpty()) {
            //     return redirect()->back()->with('error', 'No move-out data found.');
            // }
        
            return view('Admin.movement.detail_data_movement', compact('moveOutAssets'));
        }
        
        

        public function editDataDetailMovement($id) {
            $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();

            $moveOutAssets = DB::table('t_out')
            ->select('t_out.*','t_out_detail.*', 'm_reason.*')
            ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
            ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
            ->where('t_out.out_id',$id)
            ->first();


            return view('Admin.movement.edit_data_movement', compact('moveOutAssets','reasons'));
        }

        public function filter(Request $request)
        {
            // Validasi input tanggal
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);
        
            // Ambil input tanggal dari request
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
        
            // Ubah tanggal menjadi waktu mulai (00:00:00) dan akhir (23:59:59)
            $startDate = \Carbon\Carbon::parse($startDate)->startOfDay();  // 2024-11-06 00:00:00
            $endDate = \Carbon\Carbon::parse($endDate)->endOfDay();        // 2024-11-06 23:59:59
        
            // Query untuk filter berdasarkan create_date
            $results = MasterMoveOut::whereBetween('create_date', [$startDate, $endDate]);
        
            // Eksekusi query dan ambil hasilnya
            $results = $results->get();
    
            // Ambil data lain yang dibutuhkan untuk tampilan
            $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();

            $restos = DB::table('master_resto_v2')->select('store_code', 'name_store_street')->get();
    
            $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
    
            $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
    
            
            $username = auth()->user()->username;
    
            $fromLoc = DB::table('m_user')
    
                    ->where('username', $username)
    
                    ->value('location_now');
    
    
    
            $registerLocation = DB::table('master_resto_v2')
    
                    ->where('name_store_street', $fromLoc)
    
                    ->value('name_store_street');
    
        
    
            // Filter assets based on the location_now matching the fetched resto
    
            $assets = DB::table('table_registrasi_asset')
    
                ->select('id', 'asset_name')
    
                // ->where('register_location', $registerLocation)
    
                ->where('qty', '>', 0) 
    
                ->get();        
    
    
    
            $moveoutsQuery = DB::table('t_out')
    
                ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
    
                ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
    
                ->where('t_out.is_active', 1)
    
                ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name');
    
    
    
            // Apply date range filter if provided
    
            if ($request->filled('start_date') && $request->filled('end_date')) {
    
                $startDate = $request->input('start_date') . ' 00:00:00'; // mulai dari awal hari
    
                $endDate = $request->input('end_date') . ' 23:59:59'; // sampai akhir hari
    
                $moveoutsQuery->whereBetween('t_out.out_date', [$startDate, $endDate]);
    
            }
    
        
    
            // Paginate the results
    
            $moveouts = $moveoutsQuery->paginate(10);
    
            // Kembalikan hasil filter dan data lainnya ke tampilan Blade
            return view('Admin.moveout', [
                'results' => $results,
                'fromLoc' => $fromLoc,
                'reasons' => $reasons,
                'assets' => $assets,
                'conditions' => $conditions,
                'moveouts' => $moveouts,
                'restos' => $restos
            ]);
        }


    public function getOutDetails($outId)
{   
    $details = DB::table('t_out_detail')
        ->select(
            't_out_detail.*',
            'm_assets.asset_model',
            'm_condition.condition_name'
        )
        ->join('m_assets', 't_out_detail.asset_id', '=', 'm_assets.asset_id')
        ->leftJoin('m_condition', 't_out_detail.condition', '=', 'm_condition.condition_id')
        ->where('t_out_detail.out_id', $outId)
        ->get();
        
    return response()->json($details);
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'out_date' => 'required|date',
        'from_loc' => 'required|string|max:255',
        'dest_loc' => 'required|string|max:255',
        'out_desc' => 'required|string|max:255',
        'reason_id' => 'required|integer',
        'asset_id' => 'array|required',
        'merk' => 'array',
        'qty' => 'array',
        'satuan' => 'array',
        'serial_number' => 'array',
        'register_code' => 'array',
        'condition_id' => 'array|required',
    ]);

    // Update the main movement out data
    $moveOut = MasterMoveOut::findOrFail($id);
    $moveOut->update([
        'out_date' => $validatedData['out_date'],
        'from_loc' => $validatedData['from_loc'],
        'dest_loc' => $validatedData['dest_loc'],
        'out_desc' => $validatedData['out_desc'],
        'reason_id' => $validatedData['reason_id'],
    ]);

    // Update associated assets
    // foreach ($validatedData['asset_id'] as $index => $assetId) {
    //     MasterAsset::updateOrCreate(
    //         ['out_id' => $id, 'asset_id' => $assetId],
    //         [
    //             'merk' => $validatedData['merk'][$index] ?? null,
    //             'qty' => $validatedData['qty'][$index] ?? 0,
    //             'satuan' => $validatedData['satuan'][$index] ?? null,
    //             'serial_number' => $validatedData['serial_number'][$index] ?? null,
    //             'register_code' => $validatedData['register_code'][$index] ?? null,
    //             'condition_id' => $validatedData['condition_id'][$index],
    //         ]
    //     );
    // }

    return redirect()->back()->with('success', 'Movement out updated successfully!');
}


    }


 