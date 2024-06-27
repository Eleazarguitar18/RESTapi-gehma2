<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Afiliacion\Afiliado;

class EstadoCivil extends Model
{
    use HasFactory;
    protected $table = 'tbl_afiliacion_estado_civil';
    protected $fillable = [
        'id_estadocivil',
        'nombreEstado',
        'codigoEstado',
    ];
    public function afiliadoEstadoCivil()
    {
        return $this->hasMany(Afiliado::class, 'id_estadocivil');
    }
}
