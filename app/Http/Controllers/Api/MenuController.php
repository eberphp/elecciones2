<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MenuFormRequest;
use App\Models\Menu;
// use App\Models\Products;
use Illuminate\Http\Request;
use Exception;


class MenuController extends Controller
{
    public $componentName;

    public function __construct()
    {
        // $this->middleware('permission:ver-categoria', ['only' => ['index']]);
        // $this->middleware('permission:crear-categoria', ['only' => ['create', 'store']]);
        // $this->middleware('permission:editar-categoria', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:borrar-categoria', ['only' => ['destroy']]);

        // $this->middleware('auth');
        $this->componentName = 'Menu';
    }

    // public $bool=array(1,2);


    public function index(Request $request)
    {
        $estados = [0,1];
        $query = trim($request->get('searchText'));
        if ($request) {
            $menu = Menu::orderByDesc('idMenu')->get();
            // ->where('nombre', 'LIKE', '%' . $query . '%')
            // ->get();
            return view('configuracion.menu.index', [ "componentName" => $this->componentName,"menu" => $menu, "searchText" => $query,"estados" => $estados]);
        }
    }
    // public function create()
    // { 
    //     $estados = ['PAGADO', 'EN DEUDA'];
    //     return view('configuracion.menu.create',  ["estados" => $estados]);
    // }
    public function store(MenuFormRequest $request)
    {
        try {
            $mytime = Carbon::now('America/Lima');
            $fecha = $mytime->toDateTimeString();
            $menu = new Menu();
            $menu->codMenu =  strtoupper($request->get('codMenu'));
            $menu->created_at = $fecha;
            
            $menu->description = $request->get('description');
            $menu->flag_estatus = intval($request->get('flag_estatus'));
            // $menu->flag_estatus = 1;
            $menu->save();
            return Redirect::to('configuracion/menu')->with(['success' => $menu->codMenu . ' agregado']);
        } catch (Exception $e) {
            return Redirect::to('configuracion/menu')->with(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $estados = [0,1];
        return view("configuracion.menu.edit", [ "menu" => Menu::findOrFail($id),"estados" => $estados, "componentName" => $this->componentName]);
    }
    public function update(MenuFormRequest $request, $id)
    {
        try {
            $mytime = Carbon::now('America/Lima');
            $fecha = $mytime->toDateTimeString();
            $menu = Menu::findOrFail($id);
            $menu->codMenu =  strtoupper($request->get('codMenu'));
            $menu->create_ap = $fecha;
            $menu->description = $request->get('description');
            $menu->flag_estatus = intval($request->get('flag_estatus'));
            $menu->update();
            return Redirect::to('configuracion/menu')->with(['success' => $menu->codMenu . ' modificado']);
        } catch (Exception $e) {
            return Redirect::to('configuracion/menu')->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            if ($request->ajax()) {
                $menu = Menu::findOrFail($id);
                if ($menu->delete()) {
                    return response()->json([
                        'success' => true,
                        'message' => '¡Satisfactorio!, Registro eliminado con éxito.',
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => '¡Error!, No se pudo eliminar.',
                    ]);
                }
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => '¡Error!, .' . $e->getMessage(),
                ]);
            }
        }
    }

    // public static function validate_destroy($id)
    // {
    //     return Products::where('idCategories', $id)->count() == 0 ? true : false;
    // }
}
