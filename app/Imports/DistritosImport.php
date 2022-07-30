<?php

namespace App\Imports;

use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DistritosImport implements ToModel, WithHeadingRow
{
    private $departamento;
    private $provincia;

    public function __construct()
    {
        $this->departamento = Departamento::pluck('id', 'departamento');
        $this->provincia = Provincia::pluck('id', 'provincia');
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Distrito([
            'idDepartamento' => $this->departamento[$row['departamentos']],
            'idProvincia' => $this->provincia[$row['provincias']],
            'distrito' => $row['distritos'],
            'estado' => 'activo'
        ]);
    }
}
