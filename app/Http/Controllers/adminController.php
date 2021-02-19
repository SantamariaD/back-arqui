<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\datosContacto;
use App\servicio;
use App\cambio;
use App\proyecto;

class adminController extends Controller
{
    //INICIO BORRAR CONTACTO
    public function borrarContacto($id)
    {
        //Conseguir OBJETO del contacto con el $id
        $contacto = datosContacto::find($id);
        //Comprobar si el id esta en la base de datos
        if ($contacto) {
            //Eliminar comentario
            $contacto->delete();
            //mensaje respuesta
            $respuesta = array(
                'status' => 'correcto',
                'mensaje' => 'El contacto fue borrado.'
            );
        } else {
            //mensaje error
            $respuesta = array(
                'status' => 'error',
                'mensaje' => 'El contacto no se encontro en la base de datos.'
            );
        }
        //Retornar respuesta
        return response()->json($respuesta);
    }
    //FIN BORRAR CONTACTO

    //INICIO GUARDAR IMAGEN
    public function guardarImagen(Request $request)
    {
        //Recoger los datos que llegan
        $imagen = $request->file('file0');
        //Validar que sea una imagen
        $validador = \Validator::make($request->all(), [
            'file0' => 'required | image | mimes:jpg,jpeg,png,gif'
        ]);

        if (!$imagen || $validador->fails()) {
            //error
            $respuesta = array(
                'status' => 'error',
                'mensaje' => 'Las extenciones que se aceptan son: jpg, png, jpeg y gif.'
            );
        } else {
            //Traer el nombre de la imagen agragando time en formato unix para que no se repitan nombres
            $imagen_nombre = time() . $imagen->getClientOriginalName();
            //guardar imagen en el storage
            \Storage::disk('servicios')->put($imagen_nombre, \File::get($imagen));
            //Respuesta
            $respuesta = array(
                'status' => 'correcto',
                'mensaje' => 'La imagen se subio correctamente.',
                'imagen' => $imagen_nombre
            );
        }
        //Retornar respuesta
        return response()->json($respuesta);
    }
    //FIN GUARDAR IMAGEN

    //INICIO TRAER IMAGEN
    public function traerImagen($nombre)
    {
        //Comprobar si existe la imagen en el disco
        $isset = \Storage::disk('servicios')->exists($nombre);
        if ($isset) {
            $archivo = \Storage::disk('servicios')->get($nombre);
            return new Response($archivo, 200);
        } else {
            $respuesta = array(
                'status' => 'error',
                'mensaje' => 'Noexiste la imagen en la base de datos.'
            );
            return response()->json($respuesta);
        }
    }
    //FIN TRAER IMAGEN

    //INICIO GUARDAR SERVICIO
    public function guardarServicio(Request $request)
    {
        //Recoger datos por post
        $json = $request->input('json', null);
        $datos_objeto = json_decode($json);
        $datos_array = json_decode($json, true);

        if (!empty($datos_array && $datos_objeto)) {
            //Limpiar datos
            $parametros_array = array_map('trim', $datos_array);

            //Crear servicio con el modelo
            $servicio = new servicio();
            $servicio->nombre = $datos_array['nombre'];
            $servicio->imagen = $datos_array['imagen'];
            $servicio->descripcion = $datos_array['descripcion'];

            //Guardar servicio en la tabla servicios
            $servicio->save();

            //Mensaje de respuesta
            $respuesta = array(
                'status' => 'correcto',
                'codigo' => 200,
                'mensaje' => 'Registro correcto.',
            );
        } else {
            //Error
            $respuesta = array(
                'status' => 'error',
                'mensaje' => 'No se ingresaron datos.'
            );
        }
        //Retornar respuesta
        return response()->json($respuesta);
    }
    //FIN GUARDAR SERVICIO

    //INICIO TRAER SERCIOS
    public function traerServicio()
    {
        //Traer todos los servicios de la base de datos
        $servicio =  servicio::all();
        //Devolver contactos
        return response()->json($servicio);
    }
    //FIN TRAER SERVICIOS

    //INICIO BORRAR SERVICIO
    public function borrarServicio($id)
    {
        //Conseguir OBJETO del servicio con el $id
        $servicio = servicio::find($id);
        //Comprobar si el id esta en la base de datos
        if ($servicio) {
            //Eliminar comentario
            $servicio->delete();
            //mensaje respuesta
            $respuesta = array(
                'status' => 'correcto',
                'mensaje' => 'El servicio fue borrado.'
            );
        } else {
            //mensaje error
            $respuesta = array(
                'status' => 'error',
                'mensaje' => 'El servicio no se encontro en la base de datos.'
            );
        }
        //Retornar respuesta
        return response()->json($respuesta);
    }
    //FIN BORRAR SERVICIO

    //INICIO TRAER CAMBIOS GENERALES
    public function cambiosGenerales(){
        //Traer cambios generales de la base de datos
        $cambios =  cambio::all();
        //Devolver contactos
        return response()->json($cambios);
    }
    //FIN TRAER CAMBIOS GENERALES

    //INICIO AJUSTAR CAMBIOS GENERALES
     public function actualizarCambios(Request $request)
    {
        //Recoger parametros por post
        $json = $request->input('json', null);
        $parametros_array = json_decode($json, true);

        if (!empty($parametros_array)) {
            //Actualizar campos
        $actualizar = cambio::where('id', 1)->update($parametros_array);

        //Mensaje de atcualización
        $respuesta = array(
            'status'=> 'correcto',
            'mensaje'=> 'Se actualizo correctamente la información.'
        );
        }else{
            //Mensaje de error
        $respuesta = array(
            'status'=> 'error',
            'mensaje'=> 'No se actualizo correctamente la información.'
        );
        }

        //Devolver respuesta
        return response()->json($respuesta);
    }
    //INICIO AJUSTAR CAMBIOS GENERALES

    //INICIO GUARDAR PROYECTO
    public function guardarProyecto(Request $request)
    {
        //Recoger datos por post
        $json = $request->input('json', null);
        $datos_objeto = json_decode($json);
        $datos_array = json_decode($json, true);

        if (!empty($datos_array && $datos_objeto)) {

            //Crear proyecto con el modelo
            $proyecto = new proyecto();
            $proyecto->nombre = $datos_array['nombre'];
            $proyecto->imagen = $datos_array['imagen'];
            $proyecto->descripcion = $datos_array['descripcion'];

            //Guardar proyecto en la tabla proyectos
            $proyecto->save();

            //Mensaje de respuesta
            $respuesta = array(
                'status' => 'correcto',
                'codigo' => 200,
                'mensaje' => 'Proyecto guardado.',
            );
        } else {
            //Error
            $respuesta = array(
                'status' => 'error',
                'mensaje' => 'No se ingresaron datos.'
            );
        }
        //Retornar respuesta
        return response()->json($respuesta);
    }
    //FIN GUARDAR PROYECTO

    //INICIO TRAER PROYECTOS
    public function traerProyectos()
    {
        //Traer todos los servicios de la base de datos
        $proyecto =  proyecto::all();
        //Devolver contactos
        return response()->json($proyecto);
    }
    //FIN TRAER PROYECTOS

    //INICIO BORRAR PROYECTO
    public function borrarProyecto($id)
    {
        //Conseguir OBJETO del proyecto con el $id
        $proyecto = proyecto::find($id);
        //Comprobar si el id esta en la base de datos
        if ($proyecto) {
            //Eliminar comentario
            $proyecto->delete();
            //mensaje respuesta
            $respuesta = array(
                'status' => 'correcto',
                'mensaje' => 'El proyecto fue borrado.'
            );
        } else {
            //mensaje error
            $respuesta = array(
                'status' => 'error',
                'mensaje' => 'El proyecto no se encontro en la base de datos.'
            );
        }
        //Retornar respuesta
        return response()->json($respuesta);
    }
    //FIN BORRAR PROYECTO
}
