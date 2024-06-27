<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Afiliacion\Departamento;
use App\Models\Afiliacion\DocIdentificacion;
use App\Models\Afiliacion\GrupoSanguineo;
use App\Models\Afiliacion\FotoAfiliado;
use App\Models\Afiliacion\Zona;
use App\Models\Afiliacion\EstadoAfiliado;
use App\Models\Afiliacion\TipoAfiliado;
use App\Models\Afiliacion\EstadoCivil;

class Afiliado extends Model
{
    use HasFactory;
    protected $table = 'dbo.tbl_afiliacion_afiliado';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_afiliado',
        'id_tipoafiliado',
        'matricula',
        'secuencial',
        'nombres',
        'apellidoPaterno',
        'apellidoMaterno',
        'apellidoEsposo',
        'fechaNacimiento',
        'id_estadocivil',
        'sexo',
        'id_tipoidentificacion',
        'DocIdentificacion',
        'id_departamento',
        'id_departamentonac',
        'id_zona',
        'domicilio',
        'telefonoDomicilio',
        'telefonoCeluar',
        'fechaRegistro',
        'id_gruposanguineo',
        'alergias',
        'telefonocontacto',
        'detallecontacto',
        'observaciones',
        'id_estadoAfiliado',
        'idUsuario',
    ];
    public function departametoAfiliado()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento');
    }
    public function docIdentificacionAfiliado()
    {
        return $this->belongsTo(DocIdentificacion::class, 'DocIdentificacion');
    }
    public function grupoSanguineoAfiliado()
    {
        return $this->belongsTo(GrupoSanguineo::class, 'id_gruposanguineo');
    }
    public function zonaAfiliado()
    {
        return $this->belongsTo(Zona::class, 'id_zona');
    }
    public function estadoAfiliadoAfiliado()
    {
        return $this->belongsTo(EstadoAfiliado::class, 'id_estadoAfiliado');
    }
    public function tipoAfiliadoAfiliado()
    {
        return $this->belongsTo(TipoAfiliado::class, 'id_tipoafiliado');
    }
    public function estadoCivilAfiliado()
    {
        return $this->belongsTo(EstadoCivil::class, 'id_estadocivil');
    }
    // * Relaciones con otras tablas
    public function fotoAfiliadoAfiliado()
    {
        return $this->hasOne(FotoAfiliado::class, 'id');
    }
}
