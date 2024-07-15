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
    public function obtnerBeneficiarioPor_id_Afiliado(Request $request)
    {
        $existe = Afiliado::where('DocIdentificacion', 'like', $request->DocIdentificacion)->exists();
        //where('DocIdentificacion', $request->DocIdentificacion)->first();


    }
    public function actualizaEstadoCambio(Request $request)
    {
        try {
            // Verificar si existe un afiliado con la identificación proporcionada
            $Beneficiario = Beneficiario::where('DocIdentificacion', 'like', $request->DocIdentificacion)->first();
            if (!$Beneficiario) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró el Beneficiario',
                ], 404);
            }

            // Actualizar el grupo sanguíneo del Beneficiario
            $actualizado = Beneficiario::where('DocIdentificacion', 'like', $request->DocIdentificacion)->update([
                'estado_cambio' => 1,
            ]);
            // dd($actualizado);
            $BeneficiarioActualizado = Beneficiario::where('DocIdentificacion', 'like', $request->DocIdentificacion)->first();
            if ($actualizado) {

                return response()->json([
                    'success' => true,
                    'message' => 'Estado cambio actualizado correctamente',
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
                'message' => 'Error al actualizar el grupo sanguíneo. Datos inválidos, por favor revisa los datos ingresados.',
                'error' => $th->getMessage(), // Mensaje del error
                'line' => $th->getLine(), // Línea donde ocurrió el error
                'file' => $th->getFile(), // Archivo donde ocurrió el error
            ], 500);
        }
    }
}
