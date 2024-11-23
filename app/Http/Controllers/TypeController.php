<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Master\MasterType;

use Carbon\Carbon;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Support\Facades\File;



class TypeController extends Controller

{

    public function Index()

    {

        $types = DB::table('m_type')->select('m_type.*')->paginate(10);



        return view("Admin.type", ['types' => $types]);

    }



    public function HalamanType() 

    {

        $types = DB::table('m_type')->select('m_type.*')->paginate(10);



        return view("Admin.type", ['types' => $types]);

    }



    public function getType()

    {

        // Mengambil semua data dari tabel m_type

        $types = MasterType::all();

        return response()->json($types); // Mengembalikan data dalam format JSON

    }



    public function AddDataType(Request $request)

    {

        // Validasi data yang dikirimkan

        $request->validate([

            'type_code' => 'required|string|max:255',

            'type_name' => 'required|string|max:255',

        ]);



        try {

            // Buat instance dari model MasterType

            $type = new MasterType();

            $type->type_code = $request->input('type_code');

            $type->type_name = $request->input('type_name');

            $type->create_by = Auth::user()->username; // Mengambil username yang sedang login

            

            // Menghasilkan type_id secara otomatis

            $maxTypeId = MasterType::max('type_id'); // Ambil nilai type_id maksimum

            $type->type_id = $maxTypeId ? $maxTypeId + 1 : 1; // Set type_id, mulai dari 1 jika tidak ada

            

            $type->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini

            $type->save(); // Simpan data



            return response()->json([

                'status' => 'success',

                'message' => 'type berhasil ditambahkan',

                'redirect_url' => route('Admin.type')

            ]);

            

        } catch (\Exception $e) {

            return response()->json([

                'status' => 'error',

                'message' => 'Terjadi kesalahan atau data terduplikasi' 

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

            'data' => ['TypeId' => '12345']

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



    public function updateDataType(Request $request, $id)

    {

        // Validasi input

        $request->validate([

            'type_code' => 'required|string|max:255',

            'type_name' => 'required|string|max:255',

        ]);



        // Cek apakah type dengan id yang benar ada

        $type = MasterType::find($id); // Langsung gunakan find jika ID adalah primary key



        if (!$type) {

            return response()->json(['status' => 'error', 'message' => 'type not found.'], 404);

        }



        // Update data type

        $type->type_code = $request->type_code;

        $type->type_name = $request->type_name;

        

        if ($type->save()) { // Menggunakan save() yang lebih aman daripada update()

            return response()->json([

                'status' => 'success',

                'message' => 'type updated successfully.',

                'redirect_url' => route('Admin.type'), // Sesuaikan dengan route index Anda

            ]);

        } else {

            return response()->json(['status' => 'error', 'message' => 'Failed to update type.'], 500);

        }

    }



    public function deleteDataType($id)

    {

        $type = MasterType::find($id);



        if ($type) {

            $type->delete();

            return response()->json([

                'status' => 'success', 

                'message' => 'type deleted successfully.',

                'redirect_url' => route('Admin.type')

            ]);

        } else {

            return response()->json(['status' => 'Error', 'message' => 'Data type Gagal Terhapus'], 404);

        }

    }





    public function details($TypeId)

    {

        $type = MasterType::where('type_id', $TypeId)->first();



        if (!$type) {

            abort(404, 'type not found');

        }



        return view('type.details', ['asset' => $type]);

    }

}