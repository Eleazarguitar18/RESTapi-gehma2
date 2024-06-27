<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Afiliacion\InstitucionTitular;

class HorarioTitular extends Model
{
    use HasFactory;
    protected $table = 'tbl_afiliacion_horario_titular';
    protected $fillable = [
        'id_horario',
        'descripcionHorario',
    ];
    public function institucionTitularHorarioTitular()
    {
        return $this->hasMany(InstitucionTitular::class, 'id_horario');
    }
}
