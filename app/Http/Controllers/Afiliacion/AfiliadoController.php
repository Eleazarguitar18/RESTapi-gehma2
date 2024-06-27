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
        $agregar = Afiliado::craete([
            'id_afiliado' => $request->id_afiliado,
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
    }
}
