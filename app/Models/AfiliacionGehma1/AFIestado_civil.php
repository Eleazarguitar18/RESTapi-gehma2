<?php

namespace App\Models\AfiliacionGehma1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFIestado_civil extends Model
{
    use HasFactory;
    protected $table = 'dbo.AFIestado_civil';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_estado_civil',
        'nombreEstado',
        'codigoEstado',
    ];
}
