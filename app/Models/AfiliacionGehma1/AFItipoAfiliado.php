<?php

namespace App\Models\AfiliacionGehma1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFItipoAfiliado extends Model
{
    use HasFactory;
    protected $table = 'dbo.AFItipoAfiliado';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_tipoInstitucion',
        'nombreTipo',
    ];
}
