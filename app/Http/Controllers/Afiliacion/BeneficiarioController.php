<?php

namespace App\Http\Controllers\Afiliacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Afiliacion\Beneficiario;
use Illuminate\Support\Facades\Validator;
use App\Models\Afiliacion\Afiliado;
use Carbon\Carbon;

class BeneficiarioController extends Controller
{
    public function crearBeneficiario(Request $request)
    {
        // dd($request->all());
        try {
            $validator = Validator::make($request->all(), [
                //'id_beneficiario' => 'required',
                //'id_afiliado' => 'required',
                //'id_titular' => 'required', Buscar por numero de carnet 'DocIdentificacion'
                'id_parentesco' => 'required',
                'fechaAfiliacion' => 'required',
                // 'estadoRequisitos' => 'required',
                // 'observaciones' => 'required',
                // 'fechaVencimiento' => 'required', 
                //'estado_cambio' => 'required', por defecto 0
                //'idUsuario' => 'required', 251
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

            $existe = Beneficiario::where('id_afiliado', '=', $request->id_afiliado)->first(); //where('DocIdentificacion', $request->DocIdentificacion)->first();
            //dd($existe);
            if ($existe) {
                Beneficiario::where('id_afiliado', '=', $request->id_afiliado)->update([
                    'id_titular' => $request->id_titular,

                    'id_parentesco' => $request->id_parentesco,
                    'fechaAfiliacion' => Carbon::parse($request->fechaAfiliacion)->format('d-m-Y'), //
                    'estadoRequisitos' => 0,
                    'observaciones' => $request->observaciones,
                    // 'fechaVencimiento'=>null,
                    'estado_cambio' => 0,
                    'idUsuario' => 251,
                ]);
                $actualizado = Beneficiario::where('id_afiliado', '=', $request->id_afiliado)->first(); //where('DocIdentificacion', $request->DocIdentificacion)->first();

                return response()->json(
                    [
                        'success' => true,
                        'message' => 'El Beneficiario ya existe y se actualizo',
                        'status' => 200,
                        'data' => $actualizado
                    ],
                    200,
                );
            } else {
                $data = Beneficiario::create([
                    'id_afiliado' => $request->id_afiliado,
                    'id_titular' => $request->id_titular,
                    'id_parentesco' => $request->id_parentesco,
                    'fechaAfiliacion' => Carbon::parse($request->fechaAfiliacion)->format('d-m-Y'), //
                    'estadoRequisitos' => 0,
                    'observaciones' => $request->observaciones,
                    // 'fechaVencimiento'=>null,
                    'estado_cambio' => 0,
                    'idUsuario' => 251,
                ]);

                if (!$data) {
                    return response()->json(
                        [
                            'success' => false,
                            'message' => 'Fallo al crear Beneficiario',
                            'data' => $data
                        ],
                        500,
                    );
                }
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Beneficiario creado satisfactoriamente',
                        'data' => $data,
                    ],
                    201,
                );
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el afiliado Beneficiario',
                'data' => $th
            ], 500);
        }
    }
    public function buscarBeneficiarioCI($ci)
    {
        try {
            $data = Beneficiario::where('DocIdentificacion', 'like', $ci)->first();
            // $data = Beneficiario::find($id);
            // dd($data);
            if (!$data) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'no se encontro el Beneficiario',
                    ],
                    404,
                );
            }
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Beneficiario encontrado',
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
            $actualizado = Beneficiario::where('id_afiliado', '=', $afiliado->id_afiliado)->update([
                'estado_cambio' => 1,
            ]);
            // dd($actualizado);
            $BeneficiarioActualizado = Beneficiario::where('id_afiliado', '=', $afiliado->id_afiliado)->first();
            if ($actualizado) {

                return response()->json([
                    'success' => true,
                    'message' => 'estado cambio actualizado correctamente',
                    'data' => $BeneficiarioActualizado
                ], 200);
            }
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Fallo al Actualizar el estado cambio del Beneficiario',
                    'data' => $BeneficiarioActualizado,
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
