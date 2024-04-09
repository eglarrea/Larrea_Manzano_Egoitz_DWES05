<?php

namespace App\Http\Controllers;

use App\Models\Cine;
use App\Models\Sala;
use App\Models\Respuesta;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cines = Cine::all();

        $array = [];
        foreach ($cines as $cine) {
            $array[] = [
                'id' => $cine->id,
                'nombre' => $cine->nombre,
                'direccion' => $cine->direccion,
                'mail' => $cine->mail,
                'telefono' => $cine->telefono,
                'salas' => $cine->salas
            ];
        }

        $respuesta = new Respuesta();
        $respuesta->setStatusCode(Response::HTTP_OK);
        $respuesta->setError(false);
        $respuesta->setMensajeError("");
        $respuesta->setRespuesta($array);


        return response()->json($respuesta);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
        $respuesta = new Respuesta();
        try {
            $cine= new Cine();
            $cine->nombre=$request->nombre;
            $cine->direccion=$request->direccion;
            $cine->mail=$request->mail;
            $cine->telefono=$request->telefono;
            $cine->save();
            $salas=$request->salas;
            if(null!=$salas){
                $resultado=app(SalaController::class)->store($request,$cine->id);
                $cine->salas= $salas;
            }
            $respuesta->setStatusCode(Response::HTTP_OK);
            $respuesta->setError(false);
            $respuesta->setMensajeError("");
            $respuesta->setRespuesta($cine);
            DB::commit();
        } catch (Exception $e) {
            $respuesta->setStatusCode(500);
            $respuesta->setError(true);
            $respuesta->setMensajeError("Error al guardar los datos del cine");
            DB::rollback();
        }
        return response()->json($respuesta);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cine $cine)
    {

        $respuesta = new Respuesta();
        $respuesta->setStatusCode(Response::HTTP_OK);
        $respuesta->setError(false);
        $respuesta->setMensajeError("");

        $array = [];

        $array[] = [
            'id' => $cine->id,
            'nombre' => $cine->nombre,
            'direccion' => $cine->direccion,
            'mail' => $cine->mail,
            'telefono' => $cine->telefono,
            'salas' => $cine->salas
        ];


        $respuesta->setRespuesta($array);
        return response()->json($respuesta);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cine $cine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cine $cine)
    {
        $cine->update($request->all());
        $respuesta = new Respuesta();
        $respuesta->setStatusCode(Response::HTTP_OK);
        $respuesta->setError(false);
        $respuesta->setMensajeError("");
        $respuesta->setRespuesta($cine);
        return response()->json($respuesta);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cine $cine)
    {
        $cine->delete();
        $respuesta = new Respuesta();
        $respuesta->setStatusCode(Response::HTTP_OK);
        $respuesta->setError(false);
        $respuesta->setMensajeError("");
        $respuesta->setRespuesta("El cine se ha eliminado correctamente");
        return response()->json($respuesta);
    }
}
