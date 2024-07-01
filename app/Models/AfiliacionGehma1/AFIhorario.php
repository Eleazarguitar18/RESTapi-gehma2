<?php

namespace App\Models\AfiliacionGehma1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFIhorario extends Model
{
    use HasFactory;
    protected $table = 'dbo.AFIhorario';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_horario',
        'descripcionHorario'
    ];
}
