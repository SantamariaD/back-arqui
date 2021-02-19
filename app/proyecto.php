<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proyecto extends Model
{
    protected $table = 'proyectos';
    protected $fillable = [
        'nombre', 'imagen','descripcion', 'created_at', 'updated_at',
    ];
}
