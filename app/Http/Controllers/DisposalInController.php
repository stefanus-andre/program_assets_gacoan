<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterDelivery;
use App\Models\Master\MasterDisIn;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DisposalInController extends Controller
{
    public function Index(Request $request)
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $moveins = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('t_in', 't_out.out_id', '=', 't_in.out_id')
        ->join('mc_approval', 't_in.appr_1', '=', 'mc_approval.approval_id')
        ->select('t_out.*', 't_in.*', 'm_reason.reason_name', 'mc_approval.approval_name', 't_out.appr_3')
        ->where('t_out.appr_3', '=', '2')
        ->when($startDate, function ($query, $startDate) {
            return $query->where('t_out.create_date', '>=', $startDate); // Filter by start date
        })
        ->when($endDate, function ($query, $endDate) {
            return $query->where('t_out.create_date', '<=', $endDate); // Filter by end date
        })
        ->select('t_out.*', 'm_reason.reason_name', 'mc_approval.approval_name')
        ->paginate(10);

        return view("Admin.disin", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveins' => $moveins
        ]);
    }

    public function HalamanDisIn(Request $request)
    {
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();

        $moveinsQuery = DB::table('t_out')
        ->join('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->join('t_in', 't_out.out_id', '=', 't_in.out_id')
        ->join('mc_approval', 't_in.appr_1', '=', 'mc_approval.approval_id')
        ->select('t_out.*', 't_in.*', 'm_reason.reason_name', 'mc_approval.approval_name', 't_out.appr_3')
        ->where('t_out.out_id', 'like', 'DA%')
        ->where('t_out.appr_3', '=', '2');

        // Apply date range filter if provided
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = $request->input('start_date') . ' 00:00:00'; // mulai dari awal hari
            $endDate = $request->input('end_date') . ' 23:59:59'; // sampai akhir hari
            $moveinsQuery->whereBetween('t_out.out_date', [$startDate, $endDate]);
        }
    
        // Paginate the results
        $moveins = $moveinsQuery->paginate(10);

        return view("Admin.disin", [
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'approvals' => $approvals,
            'moveins' => $moveins
        ]);
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
        $results = MasterDisIn::whereBetween('create_date', [$startDate, $endDate]);
    
        // Eksekusi query dan ambil hasilnya
        $results = $results->get();

        // Ambil data lain yang dibutuhkan untuk tampilan
        
        $reasons = DB::table('m_reason')->select('reason_id', 'reason_name')->get();
        $restos = DB::table('master_resto')->select('store_code', 'resto')->get();
        $approvals = DB::table('mc_approval')->select('approval_id', 'approval_name')->get();
        $assets = DB::table('table_registrasi_asset')->select('id', 'asset_name')->get();
        $conditions = DB::table('m_condition')->select('condition_id', 'condition_name')->get();

        $moveinsQuery = DB::table('t_out')
        ->leftjoin('m_reason', 't_out.reason_id', '=', 'm_reason.reason_id')
        ->leftjoin('t_in', 't_out.out_id', '=', 't_in.out_id')
        ->leftjoin('mc_approval', 't_in.appr_1', '=', 'mc_approval.approval_id')
        ->select('t_out.*', 't_in.*', 'm_reason.reason_name', 'mc_approval.approval_name', 't_out.appr_3')
        ->where('t_out.out_id', 'like', 'AM%')
        ->where('t_out.appr_3', '=', '2');
        
        // Paginate the results
        $moveins = $moveinsQuery->paginate(10);

        // Kembalikan hasil filter dan data lainnya ke tampilan Blade
        return view('admin.disin', [
            'results' => $results,
            'reasons' => $reasons,
            'assets' => $assets,
            'conditions' => $conditions,
            'moveins' => $moveins,
            'approvals' => $approvals,
            'restos' => $restos
        ]);
    }

    public function previewPDF($out_id)
    {
        // Ambil data berdasarkan out_id
        $data = DB::table('t_out')
            ->join('t_out_detail', 't_out.out_id', '=', 't_out_detail.out_id')
            ->leftJoin('master_resto as origin', 't_out.from_loc', '=', 'origin.store_code')
            ->leftJoin('master_resto as destination', 't_out.dest_loc', '=', 'destination.store_code')
            ->leftJoin('table_registrasi_asset', 't_out_detail.asset_id', '=', 'table_registrasi_asset.id')
            ->leftJoin('m_condition', 't_out_detail.condition', '=', 'm_condition.condition_id')
            ->leftJoin('m_category', 'table_registrasi_asset.category_asset', '=', 'm_category.cat_id')
            ->leftJoin('m_type', 'table_registrasi_asset.type_asset', '=', 'm_type.type_id')
            ->where('t_out.out_id', $out_id)
            ->select(
                't_out.*', 
                't_out_detail.*', 
                'origin.resto as origin_store_code', 
                'destination.resto as destination_store_code',
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
        $pdf = Pdf::loadView('Admin.pdf-disposal', compact('data'));

        return response($pdf->output(), 200)->header('Content-Type', 'application/pdf');
    }

    public function showPutForm($id)
    {
    $moveout = MasterDisIn::find($id); // Fetch the moveout record by ID

    if (!$moveout) {
        return response()->json(['status' => 'error', 'message' => 'Moveout not found.'], 404);
    }

    // Return the moveout data
    return response()->json(['status' => 'success', 'data' => $moveout]);
}


    public function getMoveOut()
    {
        // Mengambil semua data dari tabel t_in
        $moveins = MasterDisIn::all();
        return response()->json($moveins); // Mengembalikan data dalam format JSON
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
    // Fetch data from t_in and t_in_detail based on the out_id
    $moveOut = DB::table('t_in')
        ->where('in_id', $id)
        ->first();

    $moveOutDetails = DB::table('t_in_detail')
        ->where('in_id', $id)
        ->get(); // Assuming you want to retrieve all details related to this in_id

    // Combine the results (if necessary)
    $response = [
        'in_id' => $moveOut->in_id,
        'in_no' => $moveOut->in_no,
        'in_date' => $moveOut->in_date,
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

    public function AddDataMoveOut(Request $request)
    {
        // Validasi data yang dikirimkan
        $request->validate([
            'out_date' => 'required|date',
            'from_loc' => 'required|string|max:255',
            'dest_loc' => 'required|string|max:255',
            'out_desc' => 'required|string|max:255',
            'reason_id' => 'required|string|max:255',
            'asset_id' => 'required|integer',
            'register_code' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'qty' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'condition_id' => 'required|string|max:255',
        ]);

        try {
            // Buat instance dari model MasterDisIn
            $moveout = new MasterDisIn();
            $moveout->out_date = $request->input('out_date');
            $moveout->from_loc = $request->input('from_loc');
            $moveout->dest_loc = $request->input('dest_loc');
            $moveout->out_desc = $request->input('out_desc');
            $moveout->reason_id = $request->input('reason_id');
            $moveout->appr_1 = '1';
            $moveout->is_active = '1';
            $moveout->is_verify = '1';
            $moveout->is_confirm = '1';
            $moveout->create_by = Auth::user()->username; // Mengambil username yang sedang login

            // Menghasilkan out_no secara otomatis
            $maxMoveoutId = MasterDisIn::max('out_no'); // Ambil nilai out_no maksimum
            $moveout->out_no = $maxMoveoutId ? $maxMoveoutId + 1 : 1; // Set out_no, mulai dari 1 jika tidak ada
            
            // Menghasilkan MoveOut_id secara otomatis
            $randomNumberOut = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT); // Generate angka acak 4 digit untuk out_no
            $monthYear = Carbon::now()->format('mY'); // Ambil bulan dan tahun saat ini
            $moveout->out_id = '01-' . $randomNumberOut . '-' . $monthYear;
            
            $randomNumber = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT); // Generate angka acak 4 digit
            $monthYear = Carbon::now()->format('mY'); // Ambil bulan dan tahun saat ini
            $moveout->in_id = '02-' . $randomNumber . '-' . $monthYear; // Format in_id
            
            $moveout->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini
            $moveout->save(); // Simpan data

            $randomNumberDetOut = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT); // Generate angka acak 4 digit untuk out_no
            $monthYear = Carbon::now()->format('mY'); // Ambil bulan dan tahun saat ini
            $moveout->out_det_id = 'DMO-' . $randomNumberDetOut . '-' . $monthYear;

            DB::table('t_in_detail')->insert([
                'out_det_id' => $moveout->out_id,  
                'out_id' => $moveout->out_id,  
                'asset_id' => $request->input('asset_id'),
                'asset_tag' => $request->input('register_code'),
                'serial_number' => $request->input('serial_number'),
                'brand' => $request->input('merk'),
                'qty' => $request->input('qty'),
                'uom' => $request->input('satuan'),
                'condition' => $request->input('condition_id')
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'move$moveout berhasil ditambahkan',
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

    public function updateDataDisIn(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'appr_1' => 'required|string|max:255',
        ]);

        // Cek apakah MoveOut dengan id yang benar ada
        $movein = MasterDisIn::find($id); // Langsung gunakan find jika ID adalah primary key

        if (!$movein) {
            return response()->json(['status' => 'error', 'message' => 'movein not found.'], 404);
        }

        // Update data move$movein
        $movein->appr_1 = $request->appr_1;
        if ($request->appr_1 == '2') {
            $movein->is_confirm = '5';
            $movein->save();

            $maxTransitId = MasterDelivery::max('transit_id'); // Ambil nilai transit_id maksimum
            $movein->transit_id = $maxTransitId ? $maxTransitId + 1 : 1; // Set transit_id, mulai dari 1 jika tidak ada

            $randomNumberTransit = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT); // Generate angka acak 4 digit untuk out_no
            $monthYear = Carbon::now()->format('mY'); // Ambil bulan dan tahun saat ini
            $movein->trx_id = '01-' . $randomNumberTransit . '-' . $monthYear;

            DB::table('t_out')->where('out_id', $movein->out_id)->update([
                'is_confirm' => '5' // Update is_confirm ke t_out
            ]);

            // Ambil semua in_det_id dari t_in_detail berdasarkan in_id dari movein
            $inDetails = DB::table('t_in_detail')->where('in_id', $movein->in_id)->get();

            // Ambil semua out_det_id dari t_out_detail berdasarkan out_id dari movein
            $outDetails = DB::table('t_out_detail')->where('out_id', $movein->out_id)->get();

            // Masukkan data ke t_transit berdasarkan in_det_id dan out_det_id
            foreach ($inDetails as $inDetail) {
                foreach ($outDetails as $outDetail) {
                    DB::table('t_transit')->insert([
                        'trx_id' => $movein->trx_id,  
                        'transit_id' => $movein->transit_id,  
                        'in_det_id' => $inDetail->in_det_id, 
                        'out_det_id' => $outDetail->out_det_id, 
                        'asset_tag' => $outDetail->asset_tag, 
                        'qty' => $outDetail->qty, 
                        'loc_id' => $movein->dest_loc, 
                        'transit_date' => Carbon::now(),
                        // Tambahkan kolom lain jika diperlukan
                    ]);
                }
            }
        }
    
        return response()->json([
            'status' => 'success',
            'message' => 'movein updated successfully.',
            'redirect_url' => route('Admin.disin'), // Sesuaikan dengan route index Anda
        ]);
    }

    public function edit($id)
    {
        $moveout = MasterDisIn::with('asset')->findOrFail($id); // Assuming MoveOut has a relationship with Asset
        return response()->json($moveout);
    }

    public function deleteDataMoveOut($id)
    {
        $moveout = MasterDisIn::find($id);

        if ($moveout) {
            $moveout->delete();
            return response()->json([
                'status' => 'success', 
                'message' => 'moveout deleted successfully.',
                'redirect_url' => route('Admin.disin')
            ]);
        } else {
            return response()->json(['status' => 'Error', 'message' => 'Data moveout Gagal Terhapus'], 404);
        }
    }


    public function details($MoveOutId)
    {
        $moveout = MasterDisIn::where('out_id', $MoveOutId)->first();

        if (!$moveout) {
            abort(404, 'moveout not found');
        }

        return view('moveout.details', ['asset' => $moveout]);
    }
}
