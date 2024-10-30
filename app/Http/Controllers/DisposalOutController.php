<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterDisOut;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DisposalOutController extends Controller
{
    public function Index()
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')
        ->paginate(10);

        return view("Admin.disout", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'moveouts' => $moveouts
        ]);
    }

    public function HalamanDisOut() 
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $moveouts = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('mc_approval', 't_out.is_confirm', '=', 'mc_approval.approval_id')
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')
        ->paginate(10);

        return view("Admin.disout", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'moveouts' => $moveouts
        ]);
    }

    public function showPutForm($id)
    {
        $moveout = MasterDisOut::find($id); // Fetch the moveout record by ID

        if (!$moveout) {
            return response()->json(['status' => 'error', 'message' => 'Moveout not found.'], 404);
        }

        // Return the moveout data
        return response()->json(['status' => 'success', 'data' => $moveout]);
    }


    public function getDisOut()
    {
        // Mengambil semua data dari tabel t_out
        $moveouts = MasterDisOut::all();
        return response()->json($moveouts); // Mengembalikan data dalam format JSON
    }

    public function getAssetDetails($id)
    {
        $asset = DB::table('table_registrasi_asset')
            ->select('merk', 'qty', 'satuan', 'serial_number', 'register_code')
            ->where('id', $id)
            ->first();

        return response()->json($asset);
    }

    public function getDetails($id)
    {
        // Fetch data from t_out and t_out_detail based on the out_id
        $moveOut = DB::table('t_out')
            ->where('out_id', $id)
            ->first();

        $moveOutDetails = DB::table('t_out_detail')
            ->where('out_id', $id)
            ->get(); // Assuming you want to retrieve all details related to this out_id

        // Combine the results (if necessary)
        $response = [
            'out_id' => $moveOut->out_id,
            'out_no' => $moveOut->out_no,
            'out_date' => $moveOut->out_date,
            'from_loc' => $moveOut->from_loc,
            'dest_loc' => $moveOut->dest_loc,
            'in_id' => $moveOut->in_id,
            'out_desc' => $moveOut->out_desc,
            // Assuming there's a single asset, or you need to modify this to handle multiple assets
            'asset_id' => $moveOutDetails->first()->asset_id ?? '',
            'asset_name' => $moveOutDetails->first()->asset_name ?? '',
            'asset_tag' => $moveOutDetails->first()->asset_tag ?? '',
            'serial_number' => $moveOutDetails->first()->serial_number ?? '',
            'brand' => $moveOutDetails->first()->brand ?? '',
            'qty' => $moveOutDetails->first()->qty ?? '',
            'uom' => $moveOutDetails->first()->uom ?? '',
            'condition' => $moveOutDetails->first()->condition ?? '',
            'image' => $moveOutDetails->first()->image ?? '',
        ];

        return response()->json($response);
    }

    public function getMoveOutById($id)
    {
        $moveout = MasterDisOut::find($id); // Fetch the moveout entry by ID

        if ($moveout) {
            return response()->json($moveout); // Return the moveout data as JSON
        }

        return response()->json(['message' => 'MoveOut not found'], 404); // Handle not found case
    }


    public function AddDataDisOut(Request $request)
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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            // Buat instance dari model MasterDisOut
            $moveout = new MasterDisOut();
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
            $maxMoveoutId = MasterDisOut::max('out_no');
            $out_no_base = $maxMoveoutId ? $maxMoveoutId + 1 : 1;

            // Menyimpan data moveout ke database
            $moveout->out_no = $out_no_base; // Set out_no untuk pertama
            // Menghasilkan out_id secara otomatis
            $moveout->out_id = str_pad($out_no_base, 2, '0', STR_PAD_LEFT) . '-01-' . Carbon::now()->format('mY'); // Misal, untuk out_id
            
            $moveout->save(); // Simpan moveout

            // Loop melalui aset untuk menyimpan detail
            foreach ($request->input('asset_id') as $index => $assetId) {
                // Menghasilkan out_det_id secara otomatis
                $out_det_id = str_pad($out_no_base, 2, '0', STR_PAD_LEFT) . '-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT) . '-' . Carbon::now()->format('mY');
                // Process the image for each asset if available
                $imagePath = null;
                if ($request->hasFile("images.$index")) { // Access the image by index
                    $image = $request->file("images.$index");
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads/image'), $imageName);
                    $imagePath = 'uploads/image/' . $imageName;
                }
                // Simpan data detail untuk aset
                DB::table('t_out_detail')->insert([
                    'out_det_id' => $out_det_id,  // Menggunakan out_det_id yang dihasilkan
                    'out_id' => $moveout->out_id,  // Menggunakan out_id yang dihasilkan
                    'asset_id' => $assetId,
                    'asset_tag' => $request->input('register_code')[$index],
                    'serial_number' => $request->input('serial_number')[$index],
                    'brand' => $request->input('merk')[$index],
                    'qty' => $request->input('qty')[$index],
                    'uom' => $request->input('satuan')[$index],
                    'condition' => $request->input('condition_id')[$index],
                    'image' => $imagePath, // Store image path for this asset
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Data moveout berhasil ditambahkan',
                'redirect_url' => route('Admin.disout')
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

    public function updateDataDisOut(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'out_no' => 'required|string|max:255',
        ]);

        // Cek apakah MoveOut dengan id yang benar ada
        $moveout = MasterDisOut::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$moveout) {
            return response()->json(['status' => 'error', 'message' => 'move$moveout not found.'], 404);
        }

        // Update data move$moveout
        $moveout->out_no = $request->out_no;
        
        if ($moveout->save()) { // Menggunakan save() yang lebih aman daripada update()
            return response()->json([
                'status' => 'success',
                'message' => 'move$moveout updated successfully.',
                'redirect_url' => route('Admin.disout'), // Sesuaikan dengan route index Anda
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update move$moveout.'], 500);
        }
    }

    public function edit($id)
    {
        $moveout = MasterDisOut::with('asset')->findOrFail($id); // Assuming MoveOut has a relationship with Asset
        return response()->json($moveout);
    }

    public function deleteDataDisOut($id)
    {
        $moveout = MasterDisOut::find($id);

        if ($moveout) {
            $moveout->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'move$moveout deleted successfully.',
                'redirect_url' => route('Admin.disout')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data move$moveout Gagal Terhapus'], 404);
        }
    }


    public function details($MoveOutId)
    {
        $moveout = MasterDisOut::where('out_id', $MoveOutId)->first();

        if (!$moveout) {
            abort(404, 'move$moveout not found');
        }

        return view('move$moveout.details', ['asset' => $moveout]);
    }
}
