<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Master\MasterCity;

use Carbon\Carbon;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Support\Facades\File;



class CityController extends Controller

{

    public function Index()

    {

        // $provinsies = DB::table('master_city')->select('id', 'city')->get();

        // $provinsies = $provinsies->unique('provinsi');

        $citys = DB::table('master_city')->select('master_city.*')->paginate(10);



        return view("Admin.city", [

            'citys' => $citys, 

            // 'provinsies' => $provinsies
        
        ]);

    }



    public function HalamanCity() 

    {

        // $provinsies = DB::table('m_city')->select('city_id', 'provinsi')->get();

        // $provinsies = $provinsies->unique('provinsi');

        $citys = DB::table('master_city')->select('master_city.*')->paginate(10);



        return view("Admin.city", [

            'citys' => $citys, 

            // 'provinsies' => $provinsies
        ]);

    }



    public function getCity()

    {

        // Mengambil semua data dari tabel m_city

        $citys = MasterCity::all();

        return response()->json($citys); // Mengembalikan data dalam format JSON

    }



    public function AddDataCity(Request $request)

    {

        // Validasi data yang dikirimkan

        $request->validate([

            'city' => 'required|string|max:255',

        ]);



        try {

            // Buat instance dari model MasterCity

            $city = new MasterCity();


            $city->city = $request->input('city');

            $city->create_by = Auth::user()->username; // Mengambil username yang sedang login

            

            // Menghasilkan city_id secara otomatis

            $maxcityId = MasterCity::max('id'); // Ambil nilai city_id maksimum

            $city->id = $maxcityId ? $maxcityId + 1 : 1; // Set city_id, mulai dari 1 jika tidak ada

            

            $city->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini

            $city->save(); // Simpan data



            return response()->json([

                'status' => 'success',

                'message' => 'city berhasil ditambahkan',

                'redirect_url' => route('Admin.city')

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

            'data' => ['cityId' => '12345']

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



    public function updateDataCity(Request $request, $id)

    {

        // Validasi input

        $request->validate([


            'city' => 'required|string|max:255',

        ]);



        // Cek apakah city dengan id yang benar ada

        $city = MasterCity::find($id); // Langsung gunakan find jika ID adalah primary key



        if (!$city) {

            return response()->json(['status' => 'error', 'message' => 'city not found.'], 404);

        }



        // Update data city


        $city->city = $request->city;

        

        if ($city->save()) { // Menggunakan save() yang lebih aman daripada update()

            return response()->json([

                'status' => 'success',

                'message' => 'city updated successfully.',

                'redirect_url' => route('Admin.city'), // Sesuaikan dengan route index Anda

            ]);

        } else {

            return response()->json(['status' => 'error', 'message' => 'Failed to update city.'], 500);

        }

    }



    public function deleteDataCity($id)

    {

        $city = MasterCity::find($id);



        if ($city) {

            $city->delete();

            return response()->json([

                'status' => 'success', 

                'message' => 'city deleted successfully.',

                'redirect_url' => route('Admin.city')

            ]);

        } else {

            return response()->json(['status' => 'Error', 'message' => 'Data city Gagal Terhapus'], 404);

        }

    }





    public function details($cityId)

    {

        $city = MasterCity::where('id', $cityId)->first();



        if (!$city) {

            abort(404, 'city not found');

        }



        return view('city.details', ['asset' => $city]);

    }

}

