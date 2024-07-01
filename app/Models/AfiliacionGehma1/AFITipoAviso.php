<?php

namespace App\Models\AfiliacionGehma1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFITipoAviso extends Model
{
    use HasFactory;
    protected $table = 'dbo.AFITipoAviso';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_tipoAviso',
        'descripcion',
    ];
}
