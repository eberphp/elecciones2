<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiMenuController;
use App\Http\Controllers\ApiOptionMenuController;
use App\Http\Controllers\ApiEncuestaController;
use App\Http\Controllers\API\JWTAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/departamentos', 'App\Http\Controllers\DepartamentoController@index');
Route::get('/provincias/{id}', 'App\Http\Controllers\ProvinciaController@showDep');
Route::get('/distritos/{idDepartamento}/{idProvincia}', 'App\Http\Controllers\DistritoController@showDist' );
Route::get('/menu','App\Http\Controllers\ApiMenuController@index');
Route::post('/menu','App\Http\Controllers\ApiMenuController@store');
Route::put('/menu/{id}','App\Http\Controllers\ApiMenuController@update');
Route::delete('/menu/{id}','App\Http\Controllers\ApiMenuController@destroy');
Route::get('/opmenu','App\Http\Controllers\ApiOptionMenuController@index');
Route::post('/opmenu','App\Http\Controllers\ApiOptionMenuController@store');
Route::put('/opmenu/{id}','App\Http\Controllers\ApiOptionMenuController@update');
Route::delete('/opmenu/{id}','App\Http\Controllers\ApiOptionMenuController@destroy');
Route::get('/encuesta','App\Http\Controllers\ApiEncuestaController@index');
Route::post('/encuesta','App\Http\Controllers\ApiEncuestaController@store');
Route::put('/encuesta/{id}','App\Http\Controllers\ApiEncuestaController@update');

Route::delete('/encuesta/{id}','App\Http\Controllers\ApiEncuestaController@destroy');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);

});


// Route::get('/menu', [MenuController::class,'index']);
