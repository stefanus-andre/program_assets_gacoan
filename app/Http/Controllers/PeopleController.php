<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Master\MasterPeople;

use Carbon\Carbon;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Support\Facades\File;



class PeopleController extends Controller

{

    public function Index()

    {

        $peoples = DB::table('emp_employee')->select('emp_employee.*')->paginate(10);



        return view("Admin.people", ['peoples' => $peoples]);

    }



    public function HalamanPeople() 

    {

        $peoples = DB::table('emp_employee')->select('emp_employee.*')->paginate(10);



        return view("Admin.people", ['peoples' => $peoples]);

    }



    public function getPeople()

    {

        // Mengambil semua data dari tabel m_people

        $peoples = MasterPeople::all();

        return response()->json($peoples); // Mengembalikan data dalam format JSON

    }



    public function AddDataPeople(Request $request)

    {

        // Validasi data yang dikirimkan

        $request->validate([

            'people_nickname' => 'required|string|max:255',

            'people_fullname' => 'required|string|max:255',

            'people_email' => 'required|string|max:255',

            'people_whatsapp' => 'required|string|max:255',

            'division_id' => 'required|string|max:255',

            'dept_id' => 'required|string|max:255',

            'joblevel_id' => 'required|string|max:255',

            'region_id' => 'required|string|max:255',

            'loc_id' => 'required|string|max:255',

        ]);



        try {

            // Buat instance dari model MasterPeople

            $people = new MasterPeople();

            $people->people_nickname = $request->input('people_nickname');

            $people->people_fullname = $request->input('people_fullname');

            $people->people_email = $request->input('people_email');

            $people->people_whatsapp = $request->input('people_whatsapp');

            $people->division_id = $request->input('division_id');

            $people->dept_id = $request->input('dept_id');

            $people->joblevel_id = $request->input('joblevel_id');

            $people->region_id = $request->input('region_id');

            $people->loc_id = $request->input('loc_id');

            $people->create_by = Auth::user()->username; // Mengambil username yang sedang login

            

            // Menghasilkan people_id secara otomatis

            $maxPeopleId = MasterPeople::max('people_id'); // Ambil nilai people_id maksimum

            $people->people_id = $maxPeopleId ? $maxPeopleId + 1 : 1; // Set people_id, mulai dari 1 jika tidak ada

            

            $people->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini

            $people->save(); // Simpan data



            return response()->json([

                'status' => 'success',

                'message' => 'people berhasil ditambahkan',

                'redirect_url' => route('Admin.people')

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

            'data' => ['PeopleId' => '12345']

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



    public function updateDataPeople(Request $request, $id)

    {

        // Validasi input

        $request->validate([

            'people_nickname' => 'required|string|max:255',

            'people_fullname' => 'required|string|max:255',

            'people_email' => 'required|string|max:255',

            'people_whatsapp' => 'required|string|max:255',

            'division_id' => 'required|string|max:255',

            'dept_id' => 'required|string|max:255',

            'joblevel_id' => 'required|string|max:255',

            'region_id' => 'required|string|max:255',

            'loc_id' => 'required|string|max:255',

        ]);



        // Cek apakah people dengan id yang benar ada

        $people = MasterPeople::find($id); // Langsung gunakan find jika ID adalah primary key



        if (!$people) {

            return response()->json(['status' => 'error', 'message' => 'people not found.'], 404);

        }



        // Update data people

        $people->people_nickname = $request->people_nickname;

        $people->people_fullname = $request->people_fullname;

        $people->people_email = $request->people_email;

        $people->people_whatsapp = $request->people_whatsapp;

        $people->division_id = $request->division_id;

        $people->dept_id = $request->dept_id;

        $people->joblevel_id = $request->joblevel_id;

        $people->region_id = $request->region_id;

        $people->loc_id = $request->loc_id;

        

        if ($people->save()) { // Menggunakan save() yang lebih aman daripada update()

            return response()->json([

                'status' => 'success',

                'message' => 'people updated successfully.',

                'redirect_url' => route('Admin.people'), // Sesuaikan dengan route index Anda

            ]);

        } else {

            return response()->json(['status' => 'error', 'message' => 'Failed to update people.'], 500);

        }

    }



    public function deleteDataPeople($id)

    {

        $people = MasterPeople::find($id);



        if ($people) {

            $people->delete();

            return response()->json([

                'status' => 'success', 

                'message' => 'people deleted successfully.',

                'redirect_url' => route('Admin.people')

            ]);

        } else {

            return response()->json(['status' => 'Error', 'message' => 'Data people Gagal Terhapus'], 404);

        }

    }





    public function details($PeopleId)

    {

        $people = MasterPeople::where('people_id', $PeopleId)->first();



        if (!$people) {

            abort(404, 'people not found');

        }



        return view('people.details', ['asset' => $people]);

    }

}