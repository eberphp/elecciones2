<?php

namespace Database\Seeders;

use App\Models\DatosEmpresa;
use App\Models\Perfil;
use App\Models\RedesSociales;
use App\Models\Titulo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Primera Empresa
        DB::beginTransaction();

        $perfil_id_1  = Perfil::create([
            'tipo'              => 'empresa',
            'nombres'           => 'Levelte',
            'nombreCorto'       => 'Levelte',
            'correo'            => 'en.levelte@gmail.com',
            'empresa'           => 'Levelte',
        ]);

        $empresa_id_1 = DatosEmpresa::create([
            'perfil_id' => $perfil_id_1->id,
            'dominio'   => 'en.levelte.com', //'en.levelte.com',
            'nombre'    => 'Levelte',
            'correo'            => 'en.levelte@gmail.com',
        ]);

        User::create([
            'perfil_id'         => $perfil_id_1->id,
            'email'             => 'en.levelte@gmail.com',
            'password'          => bcrypt('123456'),
            'datos_empresa_id'  => $empresa_id_1->id
        ]);

        RedesSociales::create([
            'datos_empresa_id'  => $empresa_id_1->id,
            'perfil_id'         => $perfil_id_1->id,
        ]);

        Titulo::create([
            'datos_empresa_id' => $empresa_id_1->id
        ]);


        //Admin
        $perfil_id_admin  = Perfil::create([
            'tipo'              => 'admin',
            'nombres'           => 'Levelte',
            'nombreCorto'       => 'Levelte',
            'correo'            => 'admin@gmail.com',
            'empresa'           => 'Levelte',
        ]);

        User::create([
            'perfil_id'         => $perfil_id_admin->id,
            'email'             => 'admin@gmail.com',
            'password'          => bcrypt('123456'),
            'datos_empresa_id'  => $empresa_id_1->id
        ]);

        //Segunda Empresa



        $perfil_id_2  = Perfil::create([
            'tipo'              => 'empresa',
            'nombres'           => 'Ghcontigo', //don.ghcontigo.com
            'nombreCorto'       => 'Ghcontigo',
            'correo'            => 'don.ghcontigo@gmail.com',
            'empresa'           => 'Levelte',
        ]);

        $empresa_id_2 = DatosEmpresa::create([
            'perfil_id' => $perfil_id_2->id,
            'dominio'   => 'don.ghcontigo.com', //'don.ghcontigo.com',
            'nombre'    => 'Ghcontigo',
            'correo'            => 'don.ghcontigo@gmail.com',
        ]);

        User::create([
            'perfil_id'         => $perfil_id_2->id,
            'email'             => 'don.ghcontigo@gmail.com',
            'password'          => bcrypt('123456'),
            'datos_empresa_id'  => $empresa_id_2->id
        ]);

        RedesSociales::create([
            'datos_empresa_id'  => $empresa_id_2->id,
            'perfil_id'         => $perfil_id_2->id,
        ]);

        Titulo::create([
            'datos_empresa_id' => $empresa_id_2->id
        ]);

        DB::commit();
    }
}
