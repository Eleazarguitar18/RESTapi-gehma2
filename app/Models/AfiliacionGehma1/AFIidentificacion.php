<?php

namespace App\Models\AfiliacionGehma1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFIidentificacion extends Model
{
    use HasFactory;
    protected $table = 'dbo.AFIidentificacion';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_identificacion',
        'Identificacion',
        'siglaIdentificacion',
    ];
}
