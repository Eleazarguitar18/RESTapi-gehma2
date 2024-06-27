<?php

namespace App\Http\Controllers\Afiliacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Afiliacion\Departamento;

class DepartamentoController extends Controller
{
    public function listarDepartamentos(Request $request)
    {
        $departamentos = Departamento::all();
        return response()->json($departamentos, 200);
    }
}
