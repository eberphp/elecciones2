<?php

use App\Models\DatosEmpresa;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


if (!function_exists('idEmpresa')) {
    function idEmpresa()
    {

        try {
            if (Cache::has('id_empresa')) {
                return Cache::get('id_empresa');
            }

            $texto      = url('');
            $domain     = explode("//", $texto);
            $domain_aux = $domain[1];

            $empresa = DatosEmpresa::where('dominio', $domain_aux)->first();
            if ($empresa) {
                Cache::forever('id_empresa', $empresa->idUsuario);
                return Cache::get('id_empresa');
            } else {
                abort(404);
            }
        } catch (ValidationException $th) {
            Log::error('idEmpresa ' . json_encode($th));
            abort(404);
        }
    }
}
