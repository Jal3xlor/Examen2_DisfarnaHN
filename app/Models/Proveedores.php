<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $fillable = [
        'rtn',
        'empresa',
        'contacto',
        'telefono',
        'categoria',
        'limite_credito',
        'dias_credito',
        'estado',
        'fecha_registro'
    ];
}
