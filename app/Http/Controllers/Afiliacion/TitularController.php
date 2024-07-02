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

        $validator = Validator::make($request->all(), [
            'fechaAfiliacion' => 'required|date',
            'nua' => 'required',
            'estadoRequisitos' => 'required',
            'fechaVencimiento' => 'required|date',
            'observaciones' => 'required',
            'estado_cambio' => 'required',
            'estado_vigencia' => 'required',
            'matricula' => 'required',
            'fecha_nacimiento' => 'required|date',
        ]);
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $data = Titular::create([
            'id_afiliado' => $request->id_afiliado,
            'fechaAfiliacion' => $request->fechaAfiliacion,
            'nua' => $request->nua,
            'estadoRequisitos' => $request->estadoRequisitos,
            'fechaVencimiento' => $request->fechaVencimiento,
            'observaciones' => $request->observaciones,
            'estado_cambio' => $request->estado_cambio,
            'estado_vigencia' => $request->estado_vigencia,
            'idUsuario' => env('ID_USUARIO'),
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
            ], 500);
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
