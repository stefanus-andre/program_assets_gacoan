<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Master\MasterWarranty;

use Carbon\Carbon;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Support\Facades\File;



class WarrantyController extends Controller

{

    public function Index()

    {

        $warrantys = DB::table('m_warranty')->select('m_warranty.*')->paginate(10);



        return view("Admin.warranty", ['warrantys' => $warrantys]);

    }



    public function HalamanWarranty() 

    {

        $warrantys = DB::table('m_warranty')->select('m_warranty.*')->paginate(10);



        return view("Admin.warranty", ['warrantys' => $warrantys]);

    }



    public function getWarranty()

    {

        // Mengambil semua data dari tabel m_warranty

        $warrantys = MasterWarranty::all();

        return response()->json($warrantys); // Mengembalikan data dalam format JSON

    }



    public function AddDataWarranty(Request $request)

    {

        // Validasi data yang dikirimkan

        $request->validate([

            'warranty_name' => 'required|string|max:255',

            'warranty_day' => 'required|string|max:255',

        ]);



        try {

            // Buat instance dari model MasterWarranty

            $warranty = new MasterWarranty();

            $warranty->warranty_name = $request->input('warranty_name');

            $warranty->warranty_day = $request->input('warranty_day');

            $warranty->create_by = Auth::user()->username; // Mengambil username yang sedang login

            

            // Menghasilkan warranty_id secara otomatis

            $maxWarrantyId = MasterWarranty::max('warranty_id'); // Ambil nilai warranty_id maksimum

            $warranty->warranty_id = $maxWarrantyId ? $maxWarrantyId + 1 : 1; // Set warranty_id, mulai dari 1 jika tidak ada

            

            $warranty->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini

            $warranty->save(); // Simpan data



            return response()->json([

                'status' => 'success',

                'message' => 'warranty berhasil ditambahkan',

                'redirect_url' => route('Admin.warranty')

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

            'data' => ['WarrantyId' => '12345']

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



    public function updateDataWarranty(Request $request, $id)

    {

        // Validasi input

        $request->validate([

            'warranty_name' => 'required|string|max:255',

            'warranty_day' => 'required|string|max:255',

        ]);



        // Cek apakah warranty dengan id yang benar ada

        $warranty = MasterWarranty::find($id); // Langsung gunakan find jika ID adalah primary key



        if (!$warranty) {

            return response()->json(['status' => 'error', 'message' => 'warranty not found.'], 404);

        }



        // Update data warranty

        $warranty->warranty_name = $request->warranty_name;

        $warranty->warranty_day = $request->warranty_day;

        

        if ($warranty->save()) { // Menggunakan save() yang lebih aman daripada update()

            return response()->json([

                'status' => 'success',

                'message' => 'warranty updated successfully.',

                'redirect_url' => route('Admin.warranty'), // Sesuaikan dengan route index Anda

            ]);

        } else {

            return response()->json(['status' => 'error', 'message' => 'Failed to update warranty.'], 500);

        }

    }



    public function deleteDataWarranty($id)

    {

        $warranty = MasterWarranty::find($id);



        if ($warranty) {

            $warranty->delete();

            return response()->json([

                'status' => 'success', 

                'message' => 'warranty deleted successfully.',

                'redirect_url' => route('Admin.warranty')

            ]);

        } else {

            return response()->json(['status' => 'Error', 'message' => 'Data warranty Gagal Terhapus'], 404);

        }

    }





    public function details($WarrantyId)

    {

        $warranty = MasterWarranty::where('warranty_id', $WarrantyId)->first();



        if (!$warranty) {

            abort(404, 'warranty not found');

        }



        return view('warranty.details', ['asset' => $warranty]);

    }

}