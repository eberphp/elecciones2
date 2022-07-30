<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;

class DepartamentoController extends Controller
{
   /**
 * Display a listing of the resource.
 * Mostramos el listado de los regitros solicitados.
 * @return \Illuminate\Http\Response
 *
 * @OA\Get(
 *     path="/api/departamentos",
 *     tags={"departamentos"},
 *     summary="Mostrar el listado de departamentos",
 *     @OA\Response(
 *         response=200,
 *         description="Mostrar todos los departamentos."
 *     ),
 *     @OA\Response(
 *         response="default",
 *         description="Ha ocurrido un error."
 *     )
 * )
 */
    public function index()
    {
        $departamentos = Departamento::all();
        return $departamentos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
