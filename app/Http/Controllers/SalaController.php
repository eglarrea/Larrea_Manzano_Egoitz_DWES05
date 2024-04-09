<?php

namespace App\Http\Controllers;

use App\Models\Cine;
use App\Models\Respuesta;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request,$cineId)
    {
        $salas=$request->salas;
       
        foreach ($salas as $sala) {
            
            $salaAlta= new Sala();
            $salaAlta->idSala=$sala['idSala'];
            $salaAlta->idCine=$cineId;
            $sala['pelicula'];
            $salaAlta->pelicula=$sala['pelicula'];
            $salaAlta->aforo=$sala['aforo'];
            $salaAlta->es3d=$sala['es3d'];
            $salaAlta->save();
        }
       
      
    }

    /**
     * Display the specified resource.
     */
    public function show(Sala $sala)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sala $sala)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $cine,$sala)
    {
        $var=$request->request->all();
        $salaEncontrada = DB::table('salas')
                ->where('idSala', '=', $sala)
                ->where('idCine', '=', $cine)
                ->exists();

        $respuesta = new Respuesta();
        
        if (!$salaEncontrada){
            $respuesta->setStatusCode(Response::HTTP_OK);
            $respuesta->setError(true);
            $respuesta->setMensajeError("No existe la sala para ese cine");
            $respuesta->setRespuesta("");
        }else{
            Sala::where('idSala', '=', $sala)->where('idCine', '=', $cine)->update($request->all());
            $respuesta->setStatusCode(Response::HTTP_OK);
            $respuesta->setError(false);
            $respuesta->setMensajeError("");
            $respuesta->setRespuesta("Los datos de la sala se han actualizado correctamente");
        }        
        return response()->json($respuesta);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sala $sala)
    {
        //
    }
}
