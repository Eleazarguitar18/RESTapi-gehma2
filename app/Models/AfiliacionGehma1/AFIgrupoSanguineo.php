<?php

namespace App\Models\AfiliacionGehma1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFIgrupoSanguineo extends Model
{
    use HasFactory;
    protected $table = 'dbo.AFIgrupoSanguineo';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_gsanguineo',
        'descripcion',
    ];
}
