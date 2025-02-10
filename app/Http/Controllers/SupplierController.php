<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Master\MasterSupplier;

use Carbon\Carbon;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Support\Facades\File;



class SupplierController extends Controller

{

    public function Index()

    {

        $suppliers = DB::table('m_supplier')->select('m_supplier.*')->paginate(10);



        return view("Admin.supplier", ['suppliers' => $suppliers]);

    }



    public function HalamanSupplier() 

    {

        $suppliers = DB::table('m_supplier')->select('m_supplier.*')->paginate(10);



        return view("Admin.supplier", ['suppliers' => $suppliers]);

    }



    public function getSupplier()

    {

        // Mengambil semua data dari tabel m_supplier

        $suppliers = MasterSupplier::all();

        return response()->json($suppliers); // Mengembalikan data dalam format JSON

    }



    public function AddDataSupplier(Request $request)

    {

        // Validasi data yang dikirimkan

        $request->validate([

            'supplier_code' => 'required|string|max:255',

            'supplier_name' => 'required|string|max:255',

            'supplier_address' => 'required|string|max:255',

        ]);



        try {

            // Buat instance dari model MasterSupplier

            $supplier = new MasterSupplier();

            $supplier->supplier_code = $request->input('supplier_code');

            $supplier->supplier_name = $request->input('supplier_name');

            $supplier->supplier_address = $request->input('supplier_address');

            $supplier->create_by = Auth::user()->username; // Mengambil username yang sedang login

            

            // Menghasilkan supplier_id secara otomatis

            $maxSupplierId = MasterSupplier::max('supplier_id'); // Ambil nilai supplier_id maksimum

            $supplier->supplier_id = $maxSupplierId ? $maxSupplierId + 1 : 1; // Set supplier_id, mulai dari 1 jika tidak ada

            

            $supplier->create_date = Carbon::now(); // Mengisi create_date dengan tanggal saat ini

            $supplier->save(); // Simpan data



            return response()->json([

                'status' => 'success',

                'message' => 'supplier berhasil ditambahkan',

                'redirect_url' => route('Admin.supplier')

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

            'data' => ['SupplierId' => '12345']

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



    public function updateDataSupplier(Request $request, $id)

    {

        // Validasi input

        $request->validate([

            'supplier_code' => 'required|string|max:255',

            'supplier_name' => 'required|string|max:255',

            'supplier_address' => 'required|string|max:255',

        ]);



        // Cek apakah supplier dengan id yang benar ada

        $supplier = MasterSupplier::find($id); // Langsung gunakan find jika ID adalah primary key



        if (!$supplier) {

            return response()->json(['status' => 'error', 'message' => 'supplier not found.'], 404);

        }



        // Update data supplier

        $supplier->supplier_code = $request->supplier_code;

        $supplier->supplier_name = $request->supplier_name;

        $supplier->supplier_address = $request->supplier_address;

        

        if ($supplier->save()) { // Menggunakan save() yang lebih aman daripada update()

            return response()->json([

                'status' => 'success',

                'message' => 'supplier updated successfully.',

                'redirect_url' => route('Admin.supplier'), // Sesuaikan dengan route index Anda

            ]);

        } else {

            return response()->json(['status' => 'error', 'message' => 'Failed to update supplier.'], 500);

        }

    }



    public function deleteDataSupplier($id)

    {

        $supplier = MasterSupplier::find($id);



        if ($supplier) {

            $supplier->delete();

            return response()->json([

                'status' => 'success', 

                'message' => 'supplier deleted successfully.',

                'redirect_url' => route('Admin.supplier')

            ]);

        } else {

            return response()->json(['status' => 'Error', 'message' => 'Data supplier Gagal Terhapus'], 404);

        }

    }





    public function details($SupplierId)

    {

        $supplier = MasterSupplier::where('supplier_id', $SupplierId)->first();



        if (!$supplier) {

            abort(404, 'supplier not found');

        }



        return view('supplier.details', ['asset' => $supplier]);

    }

}