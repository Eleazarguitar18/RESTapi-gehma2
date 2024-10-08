<?php

namespace App\Http\Controllers\Afiliacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Afiliacion\Titular;
use App\Models\Afiliacion\Migracion;
use App\Models\Afiliacion\Afiliado;
use App\Models\Afiliacion\FotoAfiliado;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class TitularController extends Controller
{
    //
    public function crearTitular(Request $request)
    {
        //dd($request->all());
        try {
            // $request['id_tipoafiliado']=2;
            // return $request->all();
            $validator = Validator::make($request->all(), [
                'id_afiliado' => 'required',
                'fechaAfiliacion' => 'required',
                // 'fechaVencimiento' => 'required',
                // 'observaciones' => 'required',
                // 'estado_vigencia' => 'required',
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
            $existe = Titular::where('id_afiliado', '=', $request->id_afiliado)->first();

            if ($existe) {
                Titular::where('id_afiliado', '=', $request->id_afiliado)->update([
                    'fechaAfiliacion' => Carbon::parse($request->fechaAfiliacion)->format('d-m-Y'),
                    'nua' => $request->nua,
                    'estadoRequisitos' => 0,
                    // 'fechaVencimiento' => $fechaVencimiento1->format('d-m-Y'),
                    'observaciones' => $request->observaciones,
                    'estado_cambio' => 0,
                    'estado_vigencia' => 1,
                    'idUsuario' => 251,
                    'indefinido' => 0,
                ]);
                $actualizado = Titular::where('id_afiliado', '=', $request->id_afiliado)->first();

                return response()->json(
                    [
                        'success' => true,
                        'message' => 'El Titular ya existe y se actualizo',
                        'status' => 200,
                        'data' => $actualizado
                    ],
                    200,
                );
            }

            $data = Titular::create([
                'id_afiliado' => $request->id_afiliado,
                'fechaAfiliacion' => Carbon::parse($request->fechaAfiliacion)->format('d-m-Y'),
                'nua' => $request->nua,
                'estadoRequisitos' => 0,
                // 'fechaVencimiento' => $fechaVencimiento1->format('d-m-Y'),
                'observaciones' => $request->observaciones,
                'estado_cambio' => 0,
                'estado_vigencia' => 1,
                'idUsuario' => 251,
                'indefinido' => 0,
            ]);

            //dd($data);
            if (!$data) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Fallo al crear Titular',
                        'data' => $data,
                    ],
                    500,
                );
            }
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Titular creado satisfactoriamente',
                    'data' => $data,
                ],
                201,
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error al crear el Titular',
                    'data' => $th,
                ],
                500,
            );
        }
    }

    public function obtenerTitular($id)
    {
        $data = Titular::where('id_titular', $id)->first();
        // $data = Titular::find($id);
        // dd($data);
        if (!$data) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'no se encontro el Titular',
                ],
                404,
            );
        }
        return response()->json(
            [
                'success' => true,
                'message' => 'Titular encontrado',
                'data' => $data,
            ],
            200,
        );
    }

    public function listarTitular(Request $request)
    {
        $data = Titular::all();
        if (!$data) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'no se encontro lista Titular',
                ],
                500,
            );
        }
        return response()->json(
            [
                'success' => true,
                'message' => 'listado Titular',
                'data' => $data,
            ],
            200,
        );
    }
    public function buscarTitularCI($ci)
    {
        try {
            $data = Titular::where('DocIdentificacion', 'like', $ci)->first();
            // $data = Titular::find($id);
            // dd($data);
            if (!$data) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'no se encontro el Titular',
                    ],
                    404,
                );
            }
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Titular encontrado',
                    'data' => $data,
                ],
                200,
            );
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function actualizaEstadoCambio(Request $request)
    {
        try {
            // Verificar si existe un afiliado con la identificación proporcionada
            $afiliado = Afiliado::where('DocIdentificacion', 'like', $request->DocIdentificacion)->first();
            // dd($afiliado['id_afiliado']);
            if (!$afiliado) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró el Afiliado',
                ], 404);
            }
            // dd($afiliado);
            // Actualizar el grupo sanguíneo del afiliado
            $actualizado = Titular::where('id_afiliado', '=', $afiliado->id_afiliado)->update([
                'estado_cambio' => 1,
            ]);
            // dd($actualizado);
            $titularActualizado = Titular::where('id_afiliado', '=', $afiliado->id_afiliado)->first();
            if ($actualizado) {

                return response()->json([
                    'success' => true,
                    'message' => 'estado cambio actualizado correctamente',
                    'data' => $titularActualizado
                ], 200);
            }
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Fallo al Actualizar el estado cambio del titular',
                    'data' => $titularActualizado,
                ],
                500,
            );
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el estado cambio de titular',
                'error' => $th->getMessage(), // Mensaje del error
                'line' => $th->getLine(), // Línea donde ocurrió el error
                'file' => $th->getFile(), // Archivo donde ocurrió el error
            ], 500);
        }
    }
}
