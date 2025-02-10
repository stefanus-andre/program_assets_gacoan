<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Master\MasterPeriodicMtc;

use Carbon\Carbon;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Support\Facades\File;



class PeriodicMtcController extends Controller

{

    public function Index()

    {

        $periodics = DB::table('m_periodic_mtc')->select('m_periodic_mtc.*')->paginate(10);



        return view("Admin.periodic_mtc", ['periodics' => $periodics]);

    }



    public function HalamanPeriodicMtc() 

    {

        $periodics = DB::table('m_periodic_mtc')->select('m_periodic_mtc.*')->paginate(10);



        return view("Admin.periodic_mtc", ['periodics' => $periodics]);

    }



    public function getPeriodicMtc()

    {

        // Mengambil semua data dari tabel m_periodic_mtc

        $periodics = MasterPeriodicMtc::all();

        return response()->json($periodics); // Mengembalikan data dalam format JSON

    }



    public function AddDataPeriodicMtc(Request $request)

    {

        // Validasi data yang dikirimkan

        $request->validate([

            'periodic_mtc_name' => 'required|string|max:255',

            'periodic_mtc_day' => 'required|string|max:255',

        ]);



        try {

            // Buat instance dari model MasterPeriodicMtc

            $periodic = new MasterPeriodicMtc();

            $periodic->periodic_mtc_name = $request->input('periodic_mtc_name');

            $periodic->periodic_mtc_day = $request->input('periodic_mtc_day');

            $periodic->create_by = Auth::user()->username; // Mengambil username yang sedang login

            

            // Menghasilkan periodic_mtc_id secara otomatis

            $maxPeriodicMtcId = MasterPeriodicMtc::max('periodic_mtc_id'); // Ambil nilai periodic_mtc_id maksimum

            $periodic->periodic_mtc_id = $maxPeriodicMtcId ? $maxPeriodicMtcId + 1 : 1; // Set periodic_mtc_id, mulai dari 1 jika tidak ada

            

            $periodic->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini

            $periodic->save(); // Simpan data



            return response()->json([

                'status' => 'success',

                'message' => 'periodic berhasil ditambahkan',

                'redirect_url' => route('Admin.periodic')

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

            'data' => ['PeriodicMtcId' => '12345']

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



    public function updateDataPeriodicMtc(Request $request, $id)

    {

        // Validasi input

        $request->validate([

            'periodic_mtc_name' => 'required|string|max:255',

            'periodic_mtc_day' => 'required|string|max:255',

        ]);



        // Cek apakah periodic dengan id yang benar ada

        $periodic = MasterPeriodicMtc::find($id); // Langsung gunakan find jika ID adalah primary key



        if (!$periodic) {

            return response()->json(['status' => 'error', 'message' => 'periodic not found.'], 404);

        }



        // Update data periodic

        $periodic->periodic_mtc_name = $request->periodic_mtc_name;

        $periodic->periodic_mtc_day = $request->periodic_mtc_day;

        

        if ($periodic->save()) { // Menggunakan save() yang lebih aman daripada update()

            return response()->json([

                'status' => 'success',

                'message' => 'periodic updated successfully.',

                'redirect_url' => route('Admin.periodic'), // Sesuaikan dengan route index Anda

            ]);

        } else {

            return response()->json(['status' => 'error', 'message' => 'Failed to update periodic.'], 500);

        }

    }



    public function deleteDataPeriodicMtc($id)

    {

        $periodic = MasterPeriodicMtc::find($id);



        if ($periodic) {

            $periodic->delete();

            return response()->json([

                'status' => 'success', 

                'message' => 'periodic deleted successfully.',

                'redirect_url' => route('Admin.periodic')

            ]);

        } else {

            return response()->json(['status' => 'Error', 'message' => 'Data periodic Gagal Terhapus'], 404);

        }

    }





    public function details($PeriodicMtcId)

    {

        $periodic = MasterPeriodicMtc::where('periodic_mtc_id', $PeriodicMtcId)->first();



        if (!$periodic) {

            abort(404, 'periodic not found');

        }



        return view('periodic.details', ['asset' => $periodic]);

    }

    public function getPeriodicMtcAjax()
{
    $periodics = MasterPeriodicMtc::select('periodic_mtc_id', 'periodic_mtc_name')
        ->where('is_active', 1)  // If you have an active status column
        ->orderBy('periodic_mtc_name')
        ->get();
    
    return response()->json($periodics);
}

}