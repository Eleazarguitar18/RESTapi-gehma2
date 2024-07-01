<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Afiliacion\AreaAfiliado;
use App\Models\Afiliacion\HorarioTitular;
use App\Models\Afiliacion\Titularidad;
use App\Models\Afiliacion\Titular;

class InstitucionTitular extends Model
{
    use HasFactory;
    protected $table = 'tbl_afiliacion_institucion_titular';
    protected $fillable = [
        'id_InstitucionTitular',
        'id_titular',
        'id_institucion',
        'item',
        'salario',
        'telefonoOficina',
        'id_area',
        'id_horario',
        'fechaIngreso',
        'id_titularidad',
        'cargaActual',
        'oficina',
    ];
    public $timestamps = false;

    public function areaInstitucionTitular()
    {
        return $this->belongsTo(AreaAfiliado::class, 'id_area');
    }
    public function horarioTitularInstitucionTitular()
    {
        return $this->belongsTo(HorarioTitular::class, 'id_horario');
    }
    public function titularidadInstitucionTitular()
    {
        return $this->belongsTo(Titularidad::class, 'id_titularidad');
    }
    public function titularInstitucionTitular()
    {
        return $this->belongsTo(Titular::class, 'id_titular');
    }
}
