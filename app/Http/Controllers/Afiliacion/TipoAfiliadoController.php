<?php

namespace App\Http\Controllers\Afiliacion;

use App\Http\Controllers\Controller;
use App\Models\Afiliacion\Afiliado;
use Illuminate\Http\Request;
use App\Models\Afiliacion\TipoAfiliado;

class TipoAfiliadoController extends Controller
{
    //
    public function listar(Request $request)
    {
        $data = TipoAfiliado::all();
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'no se encontro lista tipo Afiliado'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'listado tipo Afiliado',
            'data' => $data
        ], 200);
    }
}
