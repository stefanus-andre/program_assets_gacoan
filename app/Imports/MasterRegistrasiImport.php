<?php
namespace App\Imports;

use App\Models\Master\MasterRegistrasiModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterRegistrasiImport implements ToModel, WithHeadingRow
{
    /**
     * Handle the row data and either update an existing record or create a new one.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
       return new MasterRegistrasiModel([
        'register_code' => $row['register_code']
       ]);
    }

    public function rules(): array
    {
        return [
            'register_code' => 'required',
        ];
    }
}
