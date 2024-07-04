<?php

namespace App\Http\Controllers\Afiliacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Afiliacion\Titular;
use App\Models\Afiliacion\Afiliado;
use App\Models\Afiliacion\FotoAfiliado;
use Illuminate\Support\Facades\Validator;

class TitularController extends Controller
{
    //
    public function crearTitular(Request $request)
    {
        try {
            
        $validator = Validator::make($request->all(), [
            'id_afiliado' => 'required',
            'fechaAfiliacion' => 'required',
            'estadoRequisitos' => 'required',
            'fechaVencimiento' => 'required',
            'observaciones' => 'required',
            'estado_cambio' => 'required',
            'estado_vigencia' => 'required',
            'matricula' => 'required',
        ]);
        if ($validator->fails()) {
            $data = [
                'success' => false,
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $existe = Titular::where('id_afiliado', $request->id_afiliado)->exists();
        if ($existe) {
            return response()->json([
                'success' => false,
                'message' => 'El Titular ya existe.',
                'status' => 502
            ], 502);
        }
        $fechaAfiliacion1=new \DateTime($request->fechaAfiliacion);
        $fechaVencimiento1=new \DateTime($request->fechaVencimiento);
        $data = Titular::create([
            'id_afiliado' => $request->id_afiliado,
            'fechaAfiliacion' => $request->fechaAfiliacion1->format('d-m-Y'),
            'nua' => $request->nua,
            'estadoRequisitos' => $request->estadoRequisitos,
            'fechaVencimiento' => $request->fechaVencimiento1->format('d-m-Y'),
            'observaciones' => $request->observaciones,
            'estado_cambio' => $request->estado_cambio,
            'estado_vigencia' => $request->estado_vigencia,
            'idUsuario' => 251,
            'indefinido' => $request->indefinido,
        ]);
        // dd($data);
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Fallo al crear Titular'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Titular creado satisfactoriamente',
            'data' => $data
        ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el Titular',
                'data' => $th
            ], 500);
        }
    }
    public function obtenerTitular($id)
    {
        $data = Titular::where('id_titular', $id)->first();
        // $data = Titular::find($id);
        // dd($data);
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'no se encontro el Titular'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Titular encontrado',
            'data' => $data
        ], 200);
    }
    public function listarTitular(Request $request)
    {
        $data = Titular::all();
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'no se encontro lista Titular'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'listado Titular',
            'data' => $data
        ], 200);
    }
}
