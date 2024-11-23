<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Master\MasterSubCategory;

use Carbon\Carbon;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Support\Facades\File;



class SubCategoryController extends Controller

{

    public function Index()

    {

        $subcategorys = DB::table('m_subcategory')->select('m_subcategory.*')->paginate(10);



        return view("Admin.subcategory", ['subcategorys' => $subcategorys]);

    }



    public function HalamanSubCategory() 

    {

        $subcategorys = DB::table('m_subcategory')->select('m_subcategory.*')->paginate(10);



        return view("Admin.subcategory", ['subcategorys' => $subcategorys]);

    }



    public function getSubcategory()

    {

        // Mengambil semua data dari tabel m_subcategory

        $subcategorys = MasterSubCategory::all();

        return response()->json($subcategorys); // Mengembalikan data dalam format JSON

    }



    public function AddDataSubCategory(Request $request)

    {

        // Validasi data yang dikirimkan

        $request->validate([

            'subcat_code' => 'required|string|max:255',

            'subcat_name' => 'required|string|max:255',

        ]);



        try {

            // Buat instance dari model MasterSubCategory

            $subcategory = new MasterSubCategory();

            $subcategory->subcat_name = $request->input('subcat_name');

            $subcategory->subcat_code = $request->input('subcat_code');

            $subcategory->create_by = Auth::user()->username; // Mengambil username yang sedang login

            

            // Menghasilkan subcat_id secara otomatis

            $maxSubCategoryId = MasterSubCategory::max('subcat_id'); // Ambil nilai subcat_id maksimum

            $subcategory->subcat_id = $maxSubCategoryId ? $maxSubCategoryId + 1 : 1; // Set subcat_id, mulai dari 1 jika tidak ada

            

            $subcategory->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini

            $subcategory->save(); // Simpan data



            return response()->json([

                'status' => 'success',

                'message' => 'subcategory berhasil ditambahkan',

                'redirect_url' => route('Admin.subcategory')

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

            'data' => ['SubCategoryId' => '12345']

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



    public function updateDatasubcategory(Request $request, $id)

    {

        // Validasi input

        $request->validate([

            'subcat_code' => 'required|string|max:255',

            'subcat_name' => 'required|string|max:255',

        ]);



        // Cek apakah subcategory dengan id yang benar ada

        $subcategory = MasterSubCategory::find($id); // Langsung gunakan find jika ID adalah primary key



        if (!$subcategory) {

            return response()->json(['status' => 'error', 'message' => 'subcategory not found.'], 404);

        }



        // Update data subcategory

        $subcategory->subcat_code = $request->subcat_code;

        $subcategory->subcat_name = $request->subcat_name;

        

        if ($subcategory->save()) { // Menggunakan save() yang lebih aman daripada update()

            return response()->json([

                'status' => 'success',

                'message' => 'subcategory updated successfully.',

                'redirect_url' => route('Admin.subcategory'), // Sesuaikan dengan route index Anda

            ]);

        } else {

            return response()->json(['status' => 'error', 'message' => 'Failed to update subcategory.'], 500);

        }

    }



    public function deleteDataSubCategory($id)

    {

        $subcategory = MasterSubCategory::find($id);



        if ($subcategory) {

            $subcategory->delete();

            return response()->json([

                'status' => 'success', 

                'message' => 'subcategory deleted successfully.',

                'redirect_url' => route('Admin.subcategory')

            ]);

        } else {

            return response()->json(['status' => 'Error', 'message' => 'Data subcategory Gagal Terhapus'], 404);

        }

    }





    public function details($SubCategoryId)

    {

        $subcategory = MasterSubCategory::where('subcat_id', $SubCategoryId)->first();



        if (!$subcategory) {

            abort(404, 'subcategory not found');

        }



        return view('subcategory.details', ['asset' => $subcategory]);

    }

}

