<?php

namespace App\Http\Controllers\Afiliacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Afiliacion\Beneficiario;
use App\Models\Afiliacion\Afiliado;
use App\Models\Afiliacion\Titular;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AfiliadoController extends Controller
{
    public function crearAfiliado(Request $request)
    {
        //dd($request->all());
        $datoError = "Error";
        try {
            $validator = Validator::make($request->all(), [
                // 'id_tipoafiliado' => 'required',
                'matricula' => 'required',
                'nombres' => 'required',
                //'apellidoPaterno' => 'required',
                //'apellidoMaterno' => 'required',
                //apellido esposo
                'fechaNacimiento' => 'required',
                'id_estadocivil' => 'required',
                'sexo' => 'required', // M o F
                'DocIdentificacion' => 'required',
                'id_departamento' => 'required',
                'id_departamentonac' => 'required',
                'domicilio' => 'required',
                'telefonoDomicilio' => 'required',
                'telefonoCelular' => 'required',
                'fechaRegistro' => 'required',
                // 'id_gruposanguineo' => 'required',
                'telefonocontacto' => 'required',
                'detallecontacto' => 'required',
                // 'observaciones' => 'required',
                // 'id_estadoAfiliado' => 'required',
                //'id_afiliado' => 'required',
                // 'fechaAfiliacion' => 'required|date',
                // 'estadoRequisitos' => 'required',
                // 'fechaVencimiento' => 'required|date',
                // 'observaciones' => 'required',
                // 'estado_cambio' => 'required',
                // 'estado_vigencia' => 'required'
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
            $existe = Afiliado::where('DocIdentificacion', 'like', $request->DocIdentificacion)->first(); //where('DocIdentificacion', $request->DocIdentificacion)->first();
            //dd($request->DocIdentificacion);
            if ($existe) {
                // Actualizar afiliado
                Afiliado::where('DocIdentificacion', 'like', $request->DocIdentificacion)->update([
                    'id_tipoafiliado' => $request->id_tipoafiliado,
                    'fechaNacimiento' => Carbon::parse($request->fechaNacimeinto)->format('d-m-Y'),
                    'fechaRegistro' => Carbon::parse($request->fechaRegistro)->format('d-m-Y'),
                    'matricula' => $request->matricula,
                    'secuencial' => 1,
                    'nombres' => $request->nombres,
                    'apellidoPaterno' => $request->apellidoPaterno,
                    'apellidoMaterno' => $request->apellidoMaterno,
                    'apellidoEsposo' => $request->apellidoEsposo,
                    'id_estadocivil' => $request->id_estadocivil,
                    'sexo' => $request->sexo,
                    'id_tipoidentificacion' => 1,
                    // 'DocIdentificacion' => $request->DocIdentificacion,
                    'id_departamento' => $request->id_departamento,
                    'id_departamentonac' => $request->id_departamentonac,
                    'id_zona' => 16,
                    'domicilio' => $request->domicilio,
                    'telefonoDomicilio' => $request->telefonoDomicilio,
                    'telefonoCelular' => $request->telefonoCeluar,
                    'id_gruposanguineo' => 9,
                    'alergias' => $request->alergias,
                    'telefonocontacto' => $request->telefonocontacto,
                    'detallecontacto' => $request->detallecontacto,
                    'observaciones' => $request->observaciones,
                    'id_estadoAfiliado' => 1,
                    'idUsuario' => 251,
                ]);
                $actualizado = Afiliado::where('DocIdentificacion', 'like', $request->DocIdentificacion)->first(); //where('DocIdentificacion', $request->DocIdentificacion)->first();
                // dd($actualizado);
                if (!$actualizado) {
                    return response()->json(
                        [
                            'success' => false,
                            'message' => 'Fallo al actualizar Afiliado',
                            'data' => $actualizado,
                        ],
                        500,
                    );
                }
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'El afiliado ya existe datos actualizados.',
                        'status' => 201,
                        'data' => $actualizado
                    ],
                    502,
                );
            } else {
                $data = Afiliado::create([
                    'id_tipoafiliado' => $request->id_tipoafiliado,
                    'fechaNacimiento' => Carbon::parse($request->fechaNacimeinto)->format('d-m-Y'),
                    'fechaRegistro' => Carbon::parse($request->fechaRegistro)->format('d-m-Y'),
                    'matricula' => $request->matricula,
                    'secuencial' => 1,
                    'nombres' => $request->nombres,
                    'apellidoPaterno' => $request->apellidoPaterno,
                    'apellidoMaterno' => $request->apellidoMaterno,
                    'apellidoEsposo' => $request->apellidoEsposo,
                    'id_estadocivil' => $request->id_estadocivil,
                    'sexo' => $request->sexo,
                    'id_tipoidentificacion' => 1,
                    'DocIdentificacion' => $request->DocIdentificacion,
                    'id_departamento' => $request->id_departamento,
                    'id_departamentonac' => $request->id_departamentonac,
                    'id_zona' => 16,
                    'domicilio' => $request->domicilio,
                    'telefonoDomicilio' => $request->telefonoDomicilio,
                    'telefonoCelular' => $request->telefonoCeluar,
                    'id_gruposanguineo' => 9,
                    'alergias' => $request->alergias,
                    'telefonocontacto' => $request->telefonocontacto,
                    'detallecontacto' => $request->detallecontacto,
                    'observaciones' => $request->observaciones,
                    'id_estadoAfiliado' => 1,
                    'idUsuario' => 251,
                ]);

                if (!$data) {
                    return response()->json(
                        [
                            'success' => false,
                            'message' => 'Fallo al crear Afiliado',
                            'data' => $data,
                        ],
                        500,
                    );
                } else {
                    return response()->json(
                        [
                            'success' => true,
                            'message' => 'afiliado creado satisfactoriamente',
                            'data' => $data,
                        ],
                        201,
                    );
                }
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el afiliado',
                'data' => $th
            ], 500);
        }
    }
    public function obtenerAfiliado($id)
    {
        $data = Afiliado::where('id_afiliado', $id)->first();
        // $data = Afiliado::find($id);
        // dd($data);
        if (!$data) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'no se encontro el Afiliado',
                ],
                404,
            );
        }
        return response()->json(
            [
                'success' => true,
                'message' => 'Afiliado encontrado',
                'data' => $data,
            ],
            200,
        );
    }
    public function obtenerAfiliadoPor_Carnet($carnet)
    {
        $data = Afiliado::where('DocIdentificacion', 'like', $carnet)->first();
        // $data = Afiliado::find($id);
        // dd($data);
        if (!$data) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'no se encontro el Afiliado',
                ],
                404,
            );
        }
        return response()->json(
            [
                'success' => true,
                'message' => 'Afiliado encontrado',
                'data' => $data,
            ],
            200,
        );
    }
    public function obtenerAfiliadoTitular($carnet)
    {
        $data1 = Afiliado::where('DocIdentificacion', 'like', $carnet)->first();
        // dd($data1['id_afiliado']);
        $data = Titular::where('id_afiliado', '=', $data1->id_afiliado)->first();
        // dd($data['id_titular']);
        // $data = Afiliado::find($id);
        if (!$data) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'no se encontro el Afiliado',
                ],
                404,
            );
        }
        return response()->json(
            [
                'success' => true,
                'message' => 'Afiliado encontrado',
                'data' => $data,
            ],
            200,
        );
    }
    public function listarAfiliado(Request $request)
    {
        $data = Afiliado::all();
        if (!$data) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'no se encontro lista Afiliado',
                ],
                500,
            );
        }
        return response()->json(
            [
                'success' => true,
                'message' => 'listado Afiliado',
                'data' => $data,
            ],
            200,
        );
    }
    public function actualizarGrupoSanguineo(Request $request)
    {


        try {
            // Validar que los campos requeridos estén presentes en la solicitud

            $validator = Validator::make($request->all(), [
                'DocIdentificacion' => 'required',
                'id_gruposanguineo' => 'required',
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
            // Verificar si existe un afiliado con la identificación proporcionada
            $afiliado = Afiliado::where('DocIdentificacion', 'like', $request->DocIdentificacion)->first();
            if (!$afiliado) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró el Afiliado',
                ], 404);
            }

            // Actualizar el grupo sanguíneo del afiliado
            $actualizado = Afiliado::where('DocIdentificacion', 'like', $request->DocIdentificacion)->update([
                'id_gruposanguineo' => $request->id_gruposanguineo,
            ]);
            // dd($actualizado);
            $afiliadoActualizado = Afiliado::where('DocIdentificacion', 'like', $request->DocIdentificacion)->first();
            if ($actualizado) {

                return response()->json([
                    'success' => true,
                    'message' => 'Grupo sanguíneo actualizado correctamente',
                    'data' => $afiliadoActualizado
                ], 200);
            }
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Fallo al Actualizar el grupo sanguineo del Afiliado',
                    'data' => $afiliadoActualizado,
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
