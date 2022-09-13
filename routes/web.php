<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EmpresaController;
use App\Http\Controllers\Api\LocalVotacionController;
use App\Http\Controllers\Api\PersonalController;
use App\Http\Controllers\AuthPersonalController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\Empresa\DatosController;
use App\Http\Controllers\Empresa\RedesSocialesController;
use App\Http\Controllers\Empresa\SliderController;
use App\Http\Controllers\Web\WebController;
use App\Http\Controllers\Empresa\BotonController;
use App\Http\Controllers\Empresa\ImagenController;
use App\Http\Controllers\Empresa\TestimonioController;
use App\Http\Controllers\Empresa\TituloController;
use App\Http\Controllers\Empresa\ServicioController;
use App\Http\Controllers\Empresa\PublicacionController;
use App\Http\Controllers\Empresa\SubImagenController;
use App\Http\Controllers\Empresa\SubpublicacionController;
use App\Http\Controllers\Empresa\CandidatosController;

use App\Http\Controllers\Empresa\DepartamentosController;
use App\Http\Controllers\Empresa\ProvinciasController;
use App\Http\Controllers\Empresa\DistritosController;
use App\Http\Controllers\Empresa\EleccionesController;
use App\Http\Controllers\Empresa\EleccionesVotosController;
use App\Http\Controllers\Empresa\PartidosController;
use App\Http\Controllers\Empresa\ZonasController;
use App\Http\Controllers\Empresa\RolController;
use App\Http\Controllers\Empresa\EncuestaController;
use App\Http\Controllers\Empresa\ProyectoController;
use App\Http\Controllers\Empresa\VotosController;
use App\Models\DatosEmpresa;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get("clearpersonal", [PersonalController::class, "clearPersonal"]);
Route::get("auth/login", [AuthPersonalController::class, "index"])->name("web.login.view");
Route::post("auth/login", [AuthPersonalController::class, "login"])->name("web.login.post");
Route::post("auth/logout", [AuthPersonalController::class, "logout"])->name("web.logout");
Route::get("auth/profile", [AuthPersonalController::class, "profile"])->name("web.profile")->middleware("auth.personal");
Route::post("auth/profile/{id}", [AuthPersonalController::class, "update"])->name("web.profile.update");
Route::get("auth/register", [AuthPersonalController::class, "create"])->name("web.register.view");
Route::post("auth/register", [AuthPersonalController::class, "store"])->name("web.register.post");
Route::get('/', [WebController::class, 'index'])->name('/');
Route::get('nosotros', [WebController::class, 'nosotros'])->name('nosotros');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('usuarios', [UserController::class, 'index'])->name('usuarios.admin');

Route::get('empresas', [EmpresaController::class, 'index'])->name('empresas.admin');
Route::get('nueva/crear-empresa/{empresa}', [EmpresaController::class, 'crearProyecto'])->name('empresas_nueva.admin');
Route::get('actualizar/git/proyectos-empresas', [EmpresaController::class, 'actualizarGit'])->name('empresas_actualizar.admin');

Route::get('empresas-create', [EmpresaController::class, 'create'])->name('empresas.create');
Route::post('empresa-store', [EmpresaController::class, 'store'])->name('empresas.store');

Route::get('datos-empresa', [DatosController::class, 'index'])->name('datos.empresa');
route::put('update-datos-empresa/{id}', [DatosController::class, 'update'])->name('datos.update');

Route::get('redes-sociales', [RedesSocialesController::class, 'index'])->name('redes.empresa');
Route::put('update-redes-sociales/{id}', [RedesSocialesController::class, 'update'])->name('redes.update');

Route::get('sliders', [SliderController::class, 'index'])->name('sliders.index');
Route::get('slider-create', [SliderController::class, 'create'])->name('sliders.craete');
Route::post('store-slider', [SliderController::class, 'store'])->name('sliders.store');
Route::get('slider-edit/{id}', [SliderController::class, 'edit'])->name('sliders.edit');
Route::put('slider-update/{id}', [SliderController::class, 'update'])->name('sliders.update');
Route::get('slider-delete/{id}', [SliderController::class, 'destroy'])->name('sliders.delete');

Route::get('botones', [BotonController::class, 'index'])->name('botones.index');
Route::get('boton-create', [BotonController::class, 'create'])->name('botones.craete');
Route::post('store-boton', [BotonController::class, 'store'])->name('botones.store');
Route::get('boton-edit/{id}', [BotonController::class, 'edit'])->name('botones.edit');
Route::put('boton-update/{id}', [BotonController::class, 'update'])->name('botones.update');
Route::get('boton-delete/{id}', [BotonController::class, 'destroy'])->name('botones.delete');

Route::get('testimonios', [TestimonioController::class, 'index'])->name('testimonios.index');
Route::get('testimonio-create', [TestimonioController::class, 'create'])->name('testimonios.create');
Route::post('store-testimonio', [TestimonioController::class, 'store'])->name('testimonios.store');
Route::get('testimonio-edit/{id}', [TestimonioController::class, 'edit'])->name('testimonios.edit');
Route::put('testimonio-update/{id}', [TestimonioController::class, 'update'])->name('testimonios.update');
Route::get('testimonio-delete/{id}', [TestimonioController::class, 'destroy'])->name('testimonios.delete');

Route::get('servicios', [ServicioController::class, 'index'])->name('servicios.index');
Route::get('servicio-create', [ServicioController::class, 'create'])->name('servicios.create');
Route::post('store-servicio', [ServicioController::class, 'store'])->name('servicios.store');
Route::get('servicio-edit/{id}', [ServicioController::class, 'edit'])->name('servicios.edit');
Route::put('servicio-update/{id}', [ServicioController::class, 'update'])->name('servicios.update');
Route::get('servicio-delete/{id}', [ServicioController::class, 'destroy'])->name('servicios.delete');

Route::get('publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');
Route::get('publicacion-create', [PublicacionController::class, 'create'])->name('publicaciones.create');
Route::post('store-publicacion', [PublicacionController::class, 'store'])->name('publicaciones.store');
Route::get('publicacion-edit/{id}', [PublicacionController::class, 'edit'])->name('publicaciones.edit');
Route::put('publicacion-update/{id}', [PublicacionController::class, 'update'])->name('publicaciones.update');
Route::get('publicacion-delete/{id}', [PublicacionController::class, 'destroy'])->name('publicaciones.delete');

Route::get('subpublicaciones/{id}', [SubpublicacionController::class, 'index'])->name('subpublicaciones.index');
Route::get('subpublicacion-create/{id}', [SubpublicacionController::class, 'create'])->name('subpublicaciones.create');
Route::post('store-subpublicacion', [SubpublicacionController::class, 'store'])->name('subpublicaciones.store');
Route::get('subpublicacion-edit/{id}', [SubpublicacionController::class, 'edit'])->name('subpublicaciones.edit');
Route::put('subpublicacion-update/{id}', [SubpublicacionController::class, 'update'])->name('subpublicaciones.update');
Route::get('subpublicacion-delete/{id}', [SubpublicacionController::class, 'destroy'])->name('subpublicaciones.delete');

Route::get('galeria/{id}', [ImagenController::class, 'index'])->name('imagenes');
Route::post('imagen-store', [ImagenController::class, 'store'])->name('imagenes.store');
Route::get('imagen-delete/{id}', [ImagenController::class, 'destroy'])->name('imagenes.delete');

Route::get('sub-galeria/{id}', [SubImagenController::class, 'index'])->name('subimagenes');
Route::post('sub-imagen-store', [SubImagenController::class, 'store'])->name('subimagenes.store');
Route::get('sub-imagen-delete/{id}', [SubImagenController::class, 'destroy'])->name('subimagenes.delete');


Route::post('actualiza-titulo-testimonio', [TituloController::class, 'actualizaTituloTestimonio'])->name('actualiza.titulo.testimonio');
Route::post('actualiza-titulo-servicio', [TituloController::class, 'actualizarTituloServicio'])->name('actualiza.titulo.servicio');


//Route::get('mi-pagina/index/{id}', [WebController::class, 'index']);
Route::get('subpublicaciones/{id}/{pubicacion_id}', [WebController::class, 'subpublicaciones'])->name('subpublicaciones');

//elecciones
Route::get('departamentos', [DepartamentosController::class, 'index'])->name('departamentos.index');
Route::post('departamentos-store', [DepartamentosController::class, 'store'])->name('departamentos.store');
Route::post('departamentos-import', [DepartamentosController::class, 'import'])->name('departamentos.import');
route::get('departamento-cambia-estado/{id}', [DepartamentosController::class, 'destroy'])->name('departamentos.delete');

Route::get('provincias', [ProvinciasController::class, 'index'])->name('provincias.index');
Route::post('provincias-store', [ProvinciasController::class, 'store'])->name('provincias.store');
Route::post('provincias-import', [ProvinciasController::class, 'import'])->name('provincias.import');
route::get('provincias-cambia-estado/{id}', [ProvinciasController::class, 'destroy'])->name('provincias.delete');
route::get('getProvincias/{id}', [ProvinciasController::class, 'getProvincias']);

Route::get('distritos', [DistritosController::class, 'index'])->name('distritos.index');
Route::post('distritos-store', [DistritosController::class, 'store'])->name('distritos.store');
Route::post('distritos-import', [DistritosController::class, 'import'])->name('distritos.import');
route::get('distritos-cambia-estado/{id}', [DistritosController::class, 'destroy'])->name('distritos.delete');
route::get('getDistritos/{id}', [DistritosController::class, 'getDistritos']);

Route::get('zonas', [ZonasController::class, 'index'])->name('zonas.index');
Route::post('zonas-store', [ZonasController::class, 'store'])->name('zonas.store');
Route::get('zona-cambia-estado/{id}', [ZonasController::class, 'destroy'])->name('zonas.delete');
Route::get('/{departamento}/{provincia}/{distrito}/Zonas', [ZonasController::class, 'getZonas']);
Route::get('/{departamento}/{provincia}/{distrito}/locales_votacion', [LocalVotacionController::class, "getLocalesVotacion"]);

Route::get('partidos', [PartidosController::class, 'index'])->name('partidos.index');
Route::post('partifos-store', [PartidosController::class, 'store'])->name('partidos.store');
Route::put('partidos-update/{id}', [PartidosController::class, 'update'])->name('partidos.update');
Route::get('partidos-cambia-estado/{id}', [PartidosController::class, 'destroy'])->name('partidos.delete');

// ! candidatos index
Route::get('candidatos', [CandidatosController::class, 'index'])->name('candidatos.index');
Route::post('candidatos-store', [CandidatosController::class, 'store'])->name('candidatos.store');
Route::put('candidatos-update/{id}', [CandidatosController::class, 'update'])->name('candidatos.update');
Route::get('candidato/eliminar/{id}', [CandidatosController::class, 'destroy'])->name('elimina-candidatos');
Route::get('/{numero_mesa}/{eleccion}/candidatos_elecciones_web', [CandidatosController::class, 'getCandidatosEleccionesWeb']);
Route::get('/{departamento}/{provincia}/{distrito}/Candidatos', [CandidatosController::class, 'getCandidatos']);
Route::get('/{departamento}/{provincia}/{distrito}/{local}/{eleccion}/candidatos_elecciones', [CandidatosController::class, 'getCandidatosElecciones']);

//roles

Route::get('roles', [RolController::class, 'index'])->name('roles.index');
Route::post('roles-store', [RolController::class, 'store'])->name('roles.store');
Route::put('roles-update/{id}', [RolController::class, 'update'])->name('roles.update');
Route::get('roles-destroy/{id}', [RolController::class, 'destroy'])->name('roles.delete');
Route::group(['middleware' => 'auth'], function () {
    Route::prefix("configuracion")->group(function () {
        Route::get("cargo", [ConfiguracionController::class, "cargo"])->name("configuracion.cargo");
        Route::get("funcion", [ConfiguracionController::class, "funcion"])->name("configuracion.funcion");
        Route::get("estadoEvaluacion", [ConfiguracionController::class, "estadoEvaluacion"])->name("configuracion.estadoEvaluacion");
        Route::get("vinculo", [ConfiguracionController::class, "vinculo"])->name("configuracion.vinculo");
        Route::get("tipoUsuario", [ConfiguracionController::class, "tipoUsuario"])->name("configuracion.tipoUsuario");
        Route::get("tipoUbigeo", [ConfiguracionController::class, "tipoUbigeo"])->name("configuracion.tipoUbigeo");
        Route::get("tipoActividad", [ConfiguracionController::class, "tipoActividad"])->name("configuracion.tipoActividad");
        Route::get("area", [ConfiguracionController::class, "area"])->name("configuracion.area");
        Route::get("prioridad", [ConfiguracionController::class, "prioridad"])->name("configuracion.prioridad");
        Route::get("estadoGestion", [ConfiguracionController::class, "estadoGestion"])->name("configuracion.estadoGestion");
        Route::get("usuarioResponsable", [ConfiguracionController::class, "usuarioResponsable"])->name("configuracion.usuarioResponsable");
        Route::get("estadoActividad", [ConfiguracionController::class, "estadoActividad"])->name("configuracion.estadoActividad");
        Route::get("estadoProceso", [ConfiguracionController::class, "estadoProceso"])->name("configuracion.estadoProceso");
        Route::get("personal", [ConfiguracionController::class, "personal"])->name("configuracion.personal");
        Route::get("personal_web", [ConfiguracionController::class, "personal_web"])->name("configuracion.personalweb");
    });
});

// RUTAS DE ENCUESTAS
Route::middleware(['auth'])->controller(EncuestaController::class)->prefix('Encuesta')->group(function () {
    Route::get('/', 'index')->name('Encuesta');
    Route::get('/Encuestador', 'encuestador')->name('Encuesta.encuestador');
    Route::post('/', 'store')->name('Encuesta.store');
    Route::get('/{encuesta}/show', 'show')->name('Encuesta.show');
    Route::post('/{encuesta}/update', 'update')->name('Encuesta.update');
    Route::get('/{encuesta}/destroy', 'destroy')->name('Encuesta.destroy');
    Route::get('/{encuesta}/Publicacion', 'publicacion')->name('Encuesta.publicacion');
    Route::post('/{encuesta}/Sumatoria', 'sumatoria')->name('Encuesta.sumatoria');
});

Route::middleware(['auth'])->controller(EleccionesController::class)->prefix('elecciones')->group(function () {
    Route::get('/', 'index')->name('elecciones');
    Route::get('/Encuestador', 'encuestador')->name('elecciones.encuestador');
    Route::post('/', 'store')->name('elecciones.store');
    Route::get('/{eleccion}/show', 'show')->name('elecciones.show');
    Route::post('/{eleccion}/update', 'update')->name('elecciones.update');
    Route::get('/{eleccion}/destroy', 'destroy')->name('elecciones.destroy');
    Route::get('/{eleccion}/Publicacion', 'publicacion')->name('elecciones.publicacion');
    Route::post('/{eleccion}/Sumatoria', 'sumatoria')->name('elecciones.sumatoria');
});

Route::get("locales_votacion", [LocalVotacionController::class, "view"])->name("locales_votacion.view");
Route::post("locales_votacion/validate_password", [LocalVotacionController::class, "validatePassword"]);
Route::post("locales_votacion/files/delete", [LocalVotacionController::class, "deleteFile"]);
Route::get("locales_votacion/files/{local}/{eleccion}/{tipo}", [LocalVotacionController::class, "filesLocalVotacion"]);
Route::post("locales_votacion/files", [LocalVotacionController::class, "uploadFiles"]);

Route::post("locales_votacion_web/files/delete", [LocalVotacionController::class, "deleteFileWeb"]);
Route::post("locales_votacion_web/files", [LocalVotacionController::class, "uploadFilesWeb"]);
// RUTAS DE VOTOS
Route::middleware(['auth'])->controller(VotosController::class)->prefix('Votos')->group(function () {
    Route::get('/', 'index')->name('Votos');
    Route::get('/{encuesta}/Encuestador', 'encuestador')->name('Votos.encuestador');
    Route::get('/{encuesta}/Manual', 'manual')->name('Votos.manual');
    Route::get('/{encuesta}/Grafico', 'grafico')->name('Votos.grafico');
    //Vista Publico
    Route::get('/{encuesta}/Grafico/Publico', 'graficoPublico')->name('Votos.grafico.publico')->withoutMiddleware(['auth']);
    Route::get('/{encuesta}/Dispositivo', 'dispositivo')->name('Votos.dispositivo')->withoutMiddleware(['auth']);

    Route::post('/', 'store')->name('Votos.store');

    Route::post('/Dispositivo', 'storeDispositivo')->name('Votos.store.dispositivo')->withoutMiddleware(['auth']);

    Route::post('/Manuales', 'storeManual')->name('Votos.manuales');
    Route::get('/{encuesta}/show', 'show')->name('Votos.show');
    Route::post('/{encuesta}/update', 'update')->name('Votos.update');
    Route::get('/{encuesta}/destroy', 'destroy')->name('Votos.destroy');


    Route::get('/{encuesta}/{departamento}/{provincia}/{distrito}/{zona}/Graficos/Total', 'getVotosDepartamentos')
        ->name('Votos.graficos.departamento')->withoutMiddleware(['auth']);
});
// RUTAS DE VOTOS Elecciones

Route::get('elecciones_voto/{eleccion}/Manual_web', [EleccionesVotosController::class, 'manualWeb'])->name('elecciones_voto.manual_web');
Route::post('elecciones_voto/Manuales_web', [EleccionesVotosController::class, 'storeManualWeb'])->name('elecciones_voto.manuales_web');
Route::middleware(['auth'])->controller(EleccionesVotosController::class)->prefix('elecciones_voto')->group(function () {
    Route::get('/', 'index')->name('elecciones_voto');
    Route::get('/{eleccion}/Encuestador', 'encuestador')->name('elecciones_voto.encuestador');
    Route::get('/{eleccion}/Manual', 'manual')->name('elecciones_voto.manual');

    Route::get('/{eleccion}/Grafico', 'grafico')->name('elecciones_voto.grafico');
    //Vista Publico
    Route::get('/{eleccion}/Grafico/Publico', 'graficoPublico')->name('elecciones_voto.grafico.publico')->withoutMiddleware(['auth']);
    Route::get('/{eleccion}/Dispositivo', 'dispositivo')->name('elecciones_voto.dispositivo')->withoutMiddleware(['auth']);

    Route::post('/', 'store')->name('elecciones_voto.store');
    Route::post('/Manuales', 'storeManual')->name('elecciones_voto.manuales');
    Route::get('/{eleccion}/show', 'show')->name('elecciones_voto.show');
    Route::post('/{eleccion}/update', 'update')->name('elecciones_voto.update');
    Route::get('/{eleccion}/destroy', 'destroy')->name('elecciones_voto.destroy');


    Route::get('/{eleccion}/{departamento}/{provincia}/{distrito}/{zona}/Graficos/Total', 'getVotosDepartamentos')
        ->name('elecciones_voto.graficos.departamento')->withoutMiddleware(['auth']);
});

// RUTAS DE PROYECTOS
Route::middleware(['auth'])->controller(ProyectoController::class)->prefix('Proyecto')->group(function () {
    Route::get('/', 'index')->name('Proyecto');
    Route::post('/', 'store')->name('Proyecto.store');
    Route::get('/{proyecto}/show', 'show')->name('Proyecto.show');
    Route::post('/{proyecto}/update', 'update')->name('Proyecto.update');
    Route::get('/{proyecto}/destroy', 'destroy')->name('Proyecto.destroy');
});

//Log

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
Route::get("storage_link",function(){
    Artisan::call("storage:link");
});