<?php

namespace App\Models\AfiliacionGehma1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFIdepartamento extends Model
{
    use HasFactory;
    protected $table = 'dbo.AFIdepartamento';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_departamento',
        'nombreDepartamento',
        'codigoDepartamento',
    ];
}
