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

            $texto      = url('');
            $domain     = explode("//", $texto);
            $domain_aux = $domain[1];

            if (Cache::has($domain_aux)) {
                return Cache::get($domain_aux);
            }

            $empresa = DatosEmpresa::where('dominio', $domain_aux)->first();
            if ($empresa) {
                Cache::forever($domain_aux, $empresa->id);
                return Cache::get($domain_aux);
                //return $empresa->id;
            } else {
                abort(404);
            }
        } catch (ValidationException $th) {
            Log::error('idEmpresa ' . json_encode($th));
            abort(404);
        }
    }
}
