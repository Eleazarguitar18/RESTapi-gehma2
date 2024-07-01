<?php

namespace App\Models\AfiliacionGehma1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFIzona extends Model
{
    use HasFactory;
    protected $table = 'dbo.AFIzona';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_zona',
        'descripcionZona',
    ];
}
