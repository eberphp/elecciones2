<?php

use App\Models\DatosEmpresa;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;


if (!function_exists('idEmpresa')) {
    function idEmpresa()
    {

        try {

            $texto      = url('');
            $domain     = explode("//", $texto);
            $domain_aux = $domain[1];
            $domain_aux = str_replace(['www.', "https"], '', $domain[1]);

            if (Cache::has($domain_aux)) {
                return Cache::get($domain_aux);
            }

            $empresa = DatosEmpresa::where('dominio', $domain_aux)->first();
            dd($empresa);

           // dd($domain_aux, $empresa);

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


if (!function_exists('limpiar_datos')) {
    function limpiar_datos($texto_a_reemplazar, $reemplazar = [])
    {
        try {
            return str_replace($reemplazar, '', $texto_a_reemplazar);
        } catch (ValidationException $th) {
            Log::error('limpiar_datos ' . json_encode($th));
            abort(404);
        }
    }
}
