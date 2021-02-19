<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//MODELO DE CONTACTO
class datosContacto extends Model
{
    protected $table = 'contactos';
    protected $fillable = [
        'nombre', 'email','telefono', 'mensaje', 'created_at', 'updated_at',
    ];
}
