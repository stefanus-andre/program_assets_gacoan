<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterMoveOut;
use App\Models\Master\TOutDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MovementOutController extends Controller
{
    public function Index()
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $restos = DB::table('master_resto')->select('store_code', 'resto')->get();
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
            ->where('register_location', $registerLocation)
            ->where('qty', '>', 0) 
            ->get();       

        $moveouts = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
        ->where('t_out.is_active', 1) // Only include active records
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')
        ->paginate(10);

        return view("Admin.moveout", [
            'fromLoc' => $fromLoc,
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'moveouts' => $moveouts,
            'restos' => $restos
        ]);
    }

    public function HalamanMoveOut() 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $restos = DB::table('master_resto')->select('store_code', 'resto')->get();
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
            ->where('register_location', $registerLocation)
            ->where('qty', '>', 0) 
            ->get();        

        $moveouts = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
        ->where('t_out.is_active', 1) // Only include active records
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')
        ->paginate(10);

        return view("Admin.moveout", [
            'fromLoc' => $fromLoc,
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'moveouts' => $moveouts,
            'restos' => $restos
        ]);
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
        $moveout = TOutDetail::find('out_id', $outId)->first();
        
        if (!$moveout) {
            return response()->json(['message' => 'Moveout not found'], 404);
        }
        
        return response()->json($moveout);
    }

    public function getMoveOut()
    {
        // Mengambil semua data dari tabel t_out
        $moveouts = MasterMoveOut::all();
        return response()->json($moveouts); // Mengembalikan data dalam format JSON
    }

    public function getAssetDetails($id)
    {
        // Debugging statement
        Log::info('Fetching asset details for ID: ' . $id);

        $asset = DB::table('table_registrasi_asset')
            ->select('merk', 'qty', 'satuan', 'serial_number', 'register_code')
            ->where('id', $id)
            ->first();

        //Log the fetched asset details
        Log::info('Asset details fetched: ', (array)$asset);

        return response()->json($asset);
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
    // Validasi data yang dikirimkan
    $request->validate([
        'out_date' => 'required|date',
        'from_loc' => 'required|string|max:255',
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

    try {
        // Buat instance dari model MasterMoveOut
        $moveout = new MasterMoveOut();
        $moveout->out_date = $request->input('out_date');
        $moveout->from_loc = $request->input('from_loc');
        $moveout->dest_loc = $request->input('dest_loc');
        $moveout->out_desc = $request->input('out_desc');
        $moveout->reason_id = $request->input('reason_id');
        $moveout->appr_1 = '1';
        $moveout->is_active = '1';
        $moveout->is_verify = '1';
        $moveout->is_confirm = '1';
        $moveout->create_by = Auth::user()->username;

        // Menghasilkan out_no secara otomatis untuk setiap aset
        $maxMoveoutId = MasterMoveOut::max('out_no');
        $out_no_base = $maxMoveoutId ? $maxMoveoutId + 1 : 1;

        // Menyimpan data moveout ke database
        $moveout->out_no = $out_no_base; // Set out_no untuk pertama
        // Menghasilkan out_id secara otomatis
        $trx_code = DB::table('t_trx')->where('trx_name', 'Asset Movement')->value('trx_code');

            // Format yymmdd untuk tanggal hari ini
            $today = Carbon::now()->format('ymd');

            // Hitung urutan nomor transaksi untuk hari ini
            $todayDate = Carbon::now()->format('Y-m-d');
            $todayCount = MasterMoveOut::whereDate('create_date', $todayDate)->count() + 1;
            $transaction_number = str_pad($todayCount, 3, '0', STR_PAD_LEFT); // Format as 001, 002, etc.

            // Format opname_id
            $moveout->out_id = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('from_loc')}.{$transaction_number}";
        
        $moveout->save(); // Simpan moveout

        // Loop melalui aset untuk menyimpan detail
        foreach ($request->input('asset_id') as $index => $assetId) {
            // Menghasilkan out_det_id secara otomatis
            $trx_code = DB::table('t_trx')->where('trx_name', 'Asset Movement')->value('trx_code');
            
                // Format yymmdd untuk tanggal hari ini
                $today = Carbon::now()->format('ymd');
            
                // Get the last transaction number used for today from opname_id
                $lastTransaction = DB::table('t_out_detail')
                    ->where('out_id', 'like', "{$trx_code}.{$today}.%") // Filter by out_id format
                    ->orderBy('out_id', 'desc')
                    ->first();
            
                // Calculate the next transaction number
                if ($lastTransaction) {
                    // Extract the last transaction number from the out_id
                    $lastOpnameId = $lastTransaction->out_id;
                    preg_match('/\.(\d{3})$/', $lastOpnameId, $matches);
                    $transaction_number = isset($matches[1]) ? intval($matches[1]) + 1 : 1; // Increment the last number or start with 1
                } else {
                    $transaction_number = 1; // Start with 1 if no transaction found
                }
                
                $transaction_number_str = str_pad($transaction_number, 3, '0', STR_PAD_LEFT); // Format as 001, 002, etc.
            
                // Format opname_id untuk setiap detail
                $out = "{$trx_code}.{$today}.{$request->input('reason_id')}.{$request->input('from_loc')}.{$transaction_number_str}";

            // Simpan data detail untuk aset
            DB::table('t_out_detail')->insert([
                'out_det_id' => $moveout->out_no,  // Menggunakan out_det_id yang dihasilkan
                'out_id' => $out,  // Menggunakan out_id yang dihasilkan
                'asset_id' => $assetId,
                'asset_tag' => $request->input('register_code')[$index],
                'serial_number' => $request->input('serial_number')[$index],
                'brand' => $request->input('merk')[$index],
                'qty' => $request->input('qty')[$index],
                'uom' => $request->input('satuan')[$index],
                'condition' => $request->input('condition_id')[$index],
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data moveout berhasil ditambahkan',
            'redirect_url' => route('Admin.moveout')
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ]);
    }
}

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
        $moveout = MasterMoveOut::find($id);

        if ($moveout) {
            // Set is_active to 0 instead of deleting the record
            $moveout->is_active = 0;
            $moveout->save(); // Save the changes to the database

            return response()->json([
                'status' => 'success', 
                'message' => 'MoveOut deactivated successfully.', // Updated message for clarity
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
}
