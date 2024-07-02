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
            'secuencial' => 'required', //opcional
            'nombres' => 'required',
            'apellidoPaterno' => 'required',
            'apellidoMaterno' => 'required',
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
            'id_gruposanguineo' => 'required',
            'alergias' => 'required',
            'telefonocontacto' => 'required',
            'detallecontacto' => 'required',
            'observaciones' => 'required',
            'id_estadoAfiliado' => 'required',
        ]);
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $data = Afiliado::create([
            'id_tipoafiliado' => $request->id_tipoafiliado,
            'matricula' => $request->matricula,
            'secuencial' => $request->secuenciala,
            'nombres' => $request->nombres,
            'apellidoPaterno' => $request->apellidoPaterno,
            'apellidoMaterno' => $request->apellidoMaterno,
            'apellidoEsposo' => $request->apellidoEsposo,
            'fechaNacimiento' => $request->fechaNacimiento,
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
            'fechaRegistro' => $request->fechaRegistro,
            'id_gruposanguineo' => $request->id_gruposanguineo,
            'alergias' => $request->alergias,
            'telefonocontacto' => $request->telefonocontacto,
            'detallecontacto' => $request->detallecontacto,
            'observaciones' => $request->observaciones,
            'id_estadoAfiliado' => $request->id_estadoAfiliado,
            'idUsuario' => env('ID_USUARIO'),
        ]);
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
            ], 500);
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
