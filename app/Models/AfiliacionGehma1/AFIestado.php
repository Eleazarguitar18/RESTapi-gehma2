<?php

namespace App\Models\AfiliacionGehma1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFIestado extends Model
{
    use HasFactory;
    protected $table = 'dbo.AFIestado';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_estado',
        'descripcionEstado',
    ];
}
