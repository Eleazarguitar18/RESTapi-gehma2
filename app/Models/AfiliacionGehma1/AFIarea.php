<?php

namespace App\Models\AfiliacionGehma1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFIarea extends Model
{
    use HasFactory;
    protected $table = 'dbo.AFIarea';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_area',
        'descripcionArea',
    ];
}
