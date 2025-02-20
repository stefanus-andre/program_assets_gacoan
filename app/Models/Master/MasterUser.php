<?php



namespace App\Models\Master;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Auth; // Untuk mendapatkan username dari user yang sedang login

use Carbon\Carbon; // Untuk tanggal dan waktu

use Spatie\Permission\Traits\HasRoles;






class MasterUser extends Authenticatable

{

    use HasFactory, HasRoles;

    // use SoftDeletes;



    protected $table = 'm_user';

    protected $primaryKey = 'id';



    protected $fillable = [

        'id',

        'username',

        'password',

        'email',

        'role',
        
        'location_now',

        'created_at',

        'updated_at'

    ];

    

    public $timestamps = false; // Nonaktifkan pengelolaan otomatis kolom created_at dan updated_at

    protected $hidden = [
        'password', // Hide password in arrays or JSON
    ];



    protected static function boot()

    {

        parent::boot();



        // Event ketika menambah data (creating)

        static::creating(function ($model) {

            $model->created_at = Carbon::now(); // Mengisi created_at dengan tanggal saat ini

            // Menghasilkan id secara otomatis

            $maxUserId = MasterUser::max('id'); // Ambil nilai id maksimum

            $model->id = $maxUserId ? $maxUserId + 1 : 1; // Set id, mulai dari 1 jika tidak ada

        });



        // Event ketika mengupdate data (updating)

        static::updating(function ($model) {

            $model->updated_at = Carbon::now(); // Mengisi updated_at dengan tanggal saat ini

        });

    }

}

