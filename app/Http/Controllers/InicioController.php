<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    //
    public function funcionInicio(Request $request)
    {
        return ('hola bro, saludando desde el controlador para la api');
    }
}
