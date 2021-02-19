<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicio extends Model
{
    protected $table = 'servicios';
    protected $fillable = [
        'nombre', 'imagen','descripcion', 'created_at', 'updated_at',
    ];
}
