<?php

namespace App\Imports;

use App\Models\Departamento;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DepatamentosImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   //dd($row[0]);
        return new Departamento([
            'departamento' => $row['departamentos'],
            'estado' => 'activo'
        ]);
    }
}
