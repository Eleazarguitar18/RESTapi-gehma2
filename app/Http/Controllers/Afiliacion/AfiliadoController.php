<?php

namespace App\Http\Controllers\Afiliacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Afiliacion\Afiliado;

class AfiliadoController extends Controller
{
    //
    public function crearAfiliado(Request $request)
    {
        $data = Afiliado::create([
            'id_tipoafiliado' => $request->id_tipoafiliado,
            'matricula' => $request->matricula,
            'secuencial' => $request->secuencial,
            'nombres' => $request->nombres,
            'apellidoPaterno' => $request->apellidoPaterno,
            'apellidoMaterno' => $request->apellidoMaterno,
            'apellidoEsposo' => $request->apellidoEsposo,
            'fechaNacimiento' => $request->fechaNacimiento,
            'id_estadocivil' => $request->id_estadocivil,
            'sexo' => $request->sexo,
            'id_tipoidentificacion' => $request->id_tipoidentificacion,
            'DocIdentificacion' => $request->DocIdentificacion,
            'id_departamento' => $request->id_departamento,
            'id_departamentonac' => $request->id_departamentonac,
            'id_zona' => $request->id_zona,
            'domicilio' => $request->domicilio,
            'telefonoDomicilio' => $request->telefonoDomicilio,
            'telefonoCeluar' => $request->telefonoCeluar,
            'fechaRegistro' => $request->fechaRegistro,
            'id_gruposanguineo' => $request->id_gruposanguineo,
            'alergias' => $request->alergias,
            'telefonocontacto' => $request->telefonocontacto,
            'detallecontacto' => $request->detallecontacto,
            'observaciones' => $request->observaciones,
            'id_estadoAfiliado' => $request->id_estadoAfiliado,
            'idUsuario' => $request->idUsuario,
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
