<?php

namespace App\Models\AfiliacionGehma1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFItipoBeneficiario extends Model
{
    use HasFactory;
    protected $table = 'dbo.AFItipoBeneficiario';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_tipo_beneficiario',
        'nombreTipoBeneficiario',
        'padre',
    ];
}
