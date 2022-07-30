<?php

namespace App\Imports;

use App\Models\Provincia;
use App\Models\Departamento;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProvinciasImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    private $departamento;

    public function __construct()
    {
        $this->departamento = Departamento::pluck('id', 'departamento');
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Provincia([
            'idDepartamento' => $this->departamento[$row['departamentos']],
            'provincia' => $row['provincias'],
            'estado' => 'activo'
        ]);
    }

    public function batchSize(): int
    {
        return 4000;
    }

    public function chunkSize(): int
    {
        return 4000;
    }
}
