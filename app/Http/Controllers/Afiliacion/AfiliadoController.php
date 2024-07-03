<?php

namespace App\Http\Controllers\Afiliacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Afiliacion\Afiliado;
use Illuminate\Support\Facades\Validator;


class AfiliadoController extends Controller
{
    //
    public function crearAfiliado(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_tipoafiliado' => 'required',
            'matricula' => 'required',
            'nombres' => 'required',
            'apellidoPaterno' => 'required',
            'apellidoMaterno' => 'required',
            //apellido esposo
            'fechaNacimiento' => 'required|date_format:Y-m-d',
            'id_estadocivil' => 'required',
            'sexo' => 'required', // M o F
            'DocIdentificacion' => 'required',
            'id_departamento' => 'required',
            'id_departamentonac' => 'required',
            'domicilio' => 'required',
            'telefonoDomicilio' => 'required',
            'telefonoCelular' => 'required',
            'fechaRegistro' => 'required|date_format:Y-m-d',
            'id_gruposanguineo' => 'required',
            'alergias' => 'required',
            'telefonocontacto' => 'required',
            'detallecontacto' => 'required',
            'observaciones' => 'required',
            'id_estadoAfiliado' => 'required',
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
        $existe = Afiliado::where('DocIdentificacion', $request->DocIdentificacion)->exists();
        if ($existe) {
            return response()->json([
                'success' => false,
                'message' => 'El afiliado ya existe.',
                'status' => 502
            ], 502);
        }
        $data = Afiliado::create([
            'id_tipoafiliado' => trim($request->id_tipoafiliado),
            'matricula' => trim($request->matricula),
            'secuencial' => 1,
            'nombres' => trim($request->nombres),
            'apellidoPaterno' => trim($request->apellidoPaterno),
            'apellidoMaterno' => trim($request->apellidoMaterno),
            'apellidoEsposo' => trim($request->apellidoEsposo),
            'fechaNacimiento' => trim($request->fechaNacimiento),
            'id_estadocivil' => trim($request->id_estadocivil),
            'sexo' => trim($request->sexo),
            'id_tipoidentificacion' => 1,
            'DocIdentificacion' => trim($request->DocIdentificacion),
            'id_departamento' => trim($request->id_departamento),
            'id_departamentonac' => trim($request->id_departamentonac),
            'id_zona' => 16,
            'domicilio' => trim($request->domicilio),
            'telefonoDomicilio' => trim($request->telefonoDomicilio),
            'telefonoCelular' => trim($request->telefonoCeluar),
            'fechaRegistro' => trim($request->fechaRegistro),
            'id_gruposanguineo' => trim($request->id_gruposanguineo),
            'alergias' => trim($request->alergias),
            'telefonocontacto' => trim($request->telefonocontacto),
            'detallecontacto' => trim($request->detallecontacto),
            'observaciones' => trim($request->observaciones),
            'id_estadoAfiliado' => trim($request->id_estadoAfiliado),
            'idUsuario' => 251,
        ]);
        // dd($data->id_afiliado);
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Fallo al crear Afiliado'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'afiliado creado satisfactoriamente',
            'data' => $data
        ], 201);
    }
    public function obtenerAfiliado($id)
    {
        $data = Afiliado::where('id_afiliado', $id)->first();
        // $data = Afiliado::find($id);
        // dd($data);
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'no se encontro el Afiliado'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Afiliado encontrado',
            'data' => $data
        ], 200);
    }
    public function listarAfiliado(Request $request)
    {
        $data = Afiliado::all();
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'no se encontro lista Afiliado'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'listado Afiliado',
            'data' => $data
        ], 200);
    }
}
