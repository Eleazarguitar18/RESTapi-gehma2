<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Afiliacion\Afiliado;

class FotoAfiliado extends Model
{
    use HasFactory;
    protected $table = 'tbl_afiliacion_foto_afiliado';
    protected $fillable = [
        'id_foto',
        'id_afiliado',
        'Foto',
    ];
    public $timestamps = false;

    public function afiliadoFotoAfiliado()
    {
        return $this->belongsTo(Afiliado::class, 'id_afiliado');
    }
}
