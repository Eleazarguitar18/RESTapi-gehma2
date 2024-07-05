<?php

namespace App\Http\Controllers\Afiliacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Afiliacion\Migracion;
use Illuminate\Support\Facades\Validator;

class MigracionController extends Controller
{
    public function agregarMigracion(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_afiliado' => 'required',
            ]);
            if ($validator->fails()) {
                $data = [
                    'success' => false,
                    'message' => 'Error en la validación de los datos',
                    'errors' => $validator->errors(),
                    'status' => 400,
                ];
                return response()->json($data, 400);
            }
            $existe = Migracion::where('id_afiliado', '=', $request->id_afiliado)->exists();
            if ($existe) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'El Afilado ya existe en la tabla de migracion a Sighov2.',
                        'status' => 502,
                    ],
                    502,
                );
            }
            $data = Migracion::create([
                'id_afiliado' => $request->id_afiliado,
                'estado_migracion' => 'CREADO',
            ]);
            if (!$data) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Fallo al crear Titular EN LA TABLA DE MIGRACION',
                        'data' => $data,
                    ],
                    500,
                );
            }
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Titular creado satisfactoriamente en la tabla MIGRACION',
                    'data' => $data,
                ],
                201,
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error al crear el Afiliado en la tabla de migracion',
                    'data' => $th,
                ],
                500,
            );
        }
    }
    public function obtenerAfiliadoMigracion($id_afiliado)
    {
        //code
    }
    public function listarAfilaidoMigracion()
    {
        //code
    }
}
