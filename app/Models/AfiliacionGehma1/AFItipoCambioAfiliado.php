<?php

namespace App\Models\AfiliacionGehma1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFItipoCambioAfiliado extends Model
{
    use HasFactory;
    protected $table = 'dbo.AFItipoCambioAfiliado';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_tipoCambioAfiliado',
        'descripcionCambio',
    ];
}
