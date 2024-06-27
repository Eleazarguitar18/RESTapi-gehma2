<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Afiliacion\Afiliado;

class Departamento extends Model
{
    use HasFactory;
    protected $table = 'dbo.tbl_afiliacion_departamento';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_departamento',
        'Departamento',
        'codigoDepartamento',
    ];
    public function afiliadoDepartamento()
    {
        return $this->hasMany(Afiliado::class, 'id_departamento');
    }
}
