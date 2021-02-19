<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\datosContacto;
use App\User;

class generalController extends Controller
{
    //INICIO REGISTRO
    public function registro(Request $request)
    {
        //Recibir datos
        $json = $request->input('json', null);
        $datos_objeto = json_decode($json);
        $datos_array = json_decode($json, true);


        if (!empty($datos_array && $datos_objeto)) {
            //Limpiar datos
            $parametros_array = array_map('trim', $datos_array);

            //Validar datos
            $validador = \Validator::make($parametros_array, [
                'username' => 'required',
                'contrasena' => 'required'
            ]);

            if ($validador->fails()) {
                //Mensaje de error
                $respuesta = array(
                    'status' => 'error',
                    'codigo' => 500,
                    'mensaje' => 'Los datos no son correctos.',
                    'errores' => $validador->errors()
                );
            } else {
                //Encriptar contraseña
                $contra = hash('sha256', $datos_objeto->contrasena);

                //Crear usuario
                $usuario = new User();
                $usuario->username = $parametros_array['username'];
                $usuario->contrasena = $contra;

                //Guardar usuario
                $usuario->save();

                //Mensaje de respuesta
                $respuesta = array(
                    'status' => 'correcto',
                    'codigo' => 200,
                    'mensaje' => 'Registro correcto.',
                );
            }
        } else {
            //Mensaje de error
            $respuesta = array(
                'status' => 'error',
                'codigo' => 500,
                'mensaje' => 'Informacion no valida.',
            );
        }

        //Retorno de respuesta en json
        return response()->json($respuesta);
    }
    //FIN REGISTRO

    //INICIO LOGIN
    public function login(Request $request)
    {

        $jwtAuth = new \JwtAuth();

        //INICIO RECIBIR INFORMACIÓN POR POST
        $json = $request->input('json', null);
        $datos_objeto = json_decode($json);
        $datos_array = json_decode($json, true);
        //INICIO RECIBIR INFORMACIÓN POR POST

        //INICIO VALIDAR QUE LOS DATOS NO ESTAN VACIOS
        if (!empty($datos_array && $datos_objeto)) {
            //Limpiar datos
            $parametros_array = array_map('trim', $datos_array);

            //Validar datos
            $validador = \Validator::make($parametros_array, [
                'username' => 'required',
                'contrasena' => 'required'
            ]);

            if ($validador->fails()) {
                //Mensaje de error
                $respuesta = array(
                    'status' => 'error',
                    'codigo' => 500,
                    'mensaje' => 'Los datos no son correctos.',
                    'errores' => $validador->errors()
                );
            } else {
                //Pasar parametros a provider JwtAuth
                $username = $datos_objeto->username;
                $contrasena = $parametros_array['contrasena'];
                $pwd = hash('sha256', $contrasena);
                //Se manda a provider JwtAuth info para recibir token del usuario
                $resp = response()->json($jwtAuth->iniciarSesion($username, $pwd));
                $respuesta = $resp->original;

                if (!empty($datos_objeto->gettoken)) {
                    //Se manda a provider JwtAuth info para recibir información del usuario
                    $resp = response()->json($jwtAuth->iniciarSesion($username, $pwd, true));
                    $respuesta = $resp->original;
                }
            }
        } else {
            $respuesta = array(
                'status' => 'error',
                'mensaje' => 'No se ingresaron los datos.'
            );
        }

        return response()->json($respuesta);

        //FIN VALIDAR QUE LOS DATOS NO ESTAN VACIOS
    }
    //FIN LOGIN

    //INICIO GUARDAR CONTACTO
    public function guardarCotacto(Request $request)
    {

        //INICIO RECIBIR DATOS POR POST
        $json = $request->input('json', null);
        $datos_objeto = json_decode($json);
        $datos_array = json_decode($json, true);
        //INICIO RECIBIR DATOS POR POST


        if (!empty($datos_array && $datos_objeto)) {
            //Limpiar datos
            $parametros_array = array_map('trim', $datos_array);

            //Validar datos
            $validador = \Validator::make($parametros_array, [
                'nombre' => 'required',
                'email' => 'required|email'
            ]);

            if ($validador->fails()) {
                //Mensaje de error
                $respuesta = array(
                    'status' => 'error',
                    'codigo' => 400,
                    'mensaje' => 'La informacion enviada no es valida.'
                );
            } else {
                //Crear módelo
                $contacto = new datosContacto();
                $contacto->nombre = $parametros_array['nombre'];
                $contacto->email = $parametros_array['email'];
                $contacto->telefono = $parametros_array['telefono'];
                $contacto->mensaje = $parametros_array['mensaje'];

                //Guardar contacto
                $contacto->save();

                //Mensaje de respuesta
                $respuesta = array(
                    'status' => 'correcto',
                    'codigo' => 200,
                    'mensaje' => 'La informacion fue enviada correctamente.'
                );
            }
        } else {
            //Mensaje de error
            $respuesta = array(
                'status' => 'error',
                'codigo' => 400,
                'mensaje' => 'Error en datos del cliente.'
            );
        }

        //Retorno de respuesta en json
        return response()->json($respuesta);
    }
    //FIN GUARDAR CONTACTO

    //INICIO TRAER CONTACTOS
    public function traerContactos()
    {
        //Traer todos los contactos de la base de datos
        $contactos = datosContacto::all();
        //Devolver contactos
        return response()->json($contactos);
    }
    //FIN TRAER CONTACTOS
}
