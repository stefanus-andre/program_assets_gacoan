<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Master\MasterReason;

use Carbon\Carbon;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Support\Facades\File;



class ReasonController extends Controller

{

    public function Index()

    {

        $reasons = DB::table('m_reason')->select('m_reason.*')->paginate(10);



        return view("Admin.reason", ['reasons' => $reasons]);

    }



    public function HalamanReason() 

    {

        $reasons = DB::table('m_reason')->select('m_reason.*')->paginate(10);



        return view("Admin.reason", ['reasons' => $reasons]);

    }



    public function getReason()

    {

        // Mengambil semua data dari tabel m_reason

        $reasons = MasterReason::all();

        return response()->json($reasons); // Mengembalikan data dalam format JSON

    }



    public function AddDataReason(Request $request)

    {

        // Validasi data yang dikirimkan

        $request->validate([

            'reason_name' => 'required|string|max:255',

        ]);



        try {

            // Buat instance dari model MasterReason

            $reason = new MasterReason();

            $reason->reason_name = $request->input('reason_name');

            $reason->create_by = Auth::user()->username; // Mengambil username yang sedang login

            

            // Menghasilkan reason_id secara otomatis

            $maxReasonId = MasterReason::max('reason_id'); // Ambil nilai reason_id maksimum

            $reason->reason_id = $maxReasonId ? $maxReasonId + 1 : 1; // Set reason_id, mulai dari 1 jika tidak ada

            

            $reason->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini

            $reason->save(); // Simpan data



            return response()->json([

                'status' => 'success',

                'message' => 'reason berhasil ditambahkan',

                'redirect_url' => route('Admin.reason')

            ]);

            

        } catch (\Exception $e) {

            return response()->json([

                'status' => 'error',

                    'message' => 'Terjadi kesalahan atau terjadi duplikasi data'

                // 'message' => 'Terjadi kesalahan: ' . $e->getMessage()

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

            'data' => ['ReasonId' => '12345']

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



    public function updateDataReason(Request $request, $id)

    {

        // Validasi input

        $request->validate([

            'reason_name' => 'required|string|max:255',

        ]);



        // Cek apakah reason dengan id yang benar ada

        $reason = MasterReason::find($id); // Langsung gunakan find jika ID adalah primary key



        if (!$reason) {

            return response()->json(['status' => 'error', 'message' => 'reason not found.'], 404);

        }



        // Update data reason

        $reason->reason_name = $request->reason_name;

        

        if ($reason->save()) { // Menggunakan save() yang lebih aman daripada update()

            return response()->json([

                'status' => 'success',

                'message' => 'reason updated successfully.',

                'redirect_url' => route('Admin.reason'), // Sesuaikan dengan route index Anda

            ]);

        } else {

            return response()->json(['status' => 'error', 'message' => 'Failed to update reason.'], 500);

        }

    }



    public function deleteDataReason($id)

    {

        $reason = MasterReason::find($id);



        if ($reason) {

            $reason->delete();

            return response()->json([

                'status' => 'success', 

                'message' => 'reason deleted successfully.',

                'redirect_url' => route('Admin.reason')

            ]);

        } else {

            return response()->json(['status' => 'Error', 'message' => 'Data reason Gagal Terhapus'], 404);

        }

    }





    public function details($ReasonId)

    {

        $reason = MasterReason::where('reason_id', $ReasonId)->first();



        if (!$reason) {

            abort(404, 'reason not found');

        }



        return view('reason.details', ['asset' => $reason]);

    }

}