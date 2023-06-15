<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {

    public static function login() {

        $router = new Router();
        //Alertas vacias
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if(empty($alertas)){
                //Comprobar que el usuario no este registrado en la BD
                $usuario = Usuario::where('email', $auth->email);

                if($usuario) {
                    
                    //Verificar Password y cuenta confirmada
                    $alertas = $usuario->ComprobarPassAndConfirmado($auth->password);
                    if(empty($alertas)) {

                        //Autenticar Usuario;
                        session_start();
                        
                        $_SESSION ['id'] = $usuario->id;
                        $_SESSION ['nombre'] = $usuario->nombre . ' ' . $usuario->apellido;
                        $_SESSION ['nombreSolo'] = $usuario->nombre;
                        $_SESSION ['apellidos'] = $usuario->apellido;
                        $_SESSION ['email'] = $usuario->email;
                        $_SESSION ['telefono'] = $usuario->telefono;

                        if($usuario->admin === "1"){
                            $_SESSION ['admin'] = $usuario->admin;
                            //Redirigir panel de administración
                            header ('Location: /AppCrossfit/admin');
                        } else{
                            //Redirigir Páginal principal clientes
                            header ('Location: /AppCrossfit/dashboard');
                        }
                    }
                } else {
                    Usuario::setAlerta('error', "Ese email no esta registrado");
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'alertas'=>$alertas
        ]);
         
    }

    public static function logout() {

        session_start();
        session_destroy();
        $alertas ['exito'][] = 'Conexión cerrada correctamente';
        $router = new Router();
        
        $router->render('auth/login', [
            'alertas'=>$alertas
        ]);
        
    }

    public static function olvide() {
        
        $router = new Router();

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)) {
                
                $usuario = Usuario::where('email', $auth->email);

                if($usuario) {
                    
                    if($usuario->confirmado === "1") {

                        //Gerenar Token y guardarlo en BD
                        $usuario->crearToken();
                        $resultado = $usuario->guardar();

                        //Enviar Email Restableciendo password
                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->enviarInstrucciones();

                        if($resultado) {
                            header ('Location: /AppCrossfit/mensaje-password');
                        }
                    }
                    else {
                        Usuario::setAlerta('error', 'El Email no ha sido Confirmado');
                    }
                }
                else {
                    Usuario::setAlerta('error', 'El Email no esta Registrado');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide-password', [
            'alertas'=>$alertas
        ]);
        
    }

    public static function recuperar() {
        
        $router = new Router();
        
        $alertas = [];
        $error = false;

        //Recogemos valor del Token
        $token = s($_GET['token']);

        //Buscar Usuario por Token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {

            Usuario::setAlerta('error', 'Token no Válido');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Leer nuevo Password y guardarlo
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if(empty($alertas)) {

                //Guardar Nueva Contraseña del Usuario
                $usuario->password = null;
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;
                $resultado = $usuario->guardar();

                //Comprobar que se Guargo Correctamente
                if($resultado) {
                    header('Location: /AppCrossfit');
                }
            }
        }
        

        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar-password', [
            'alertas'=>$alertas,
            'error'=>$error
        ]);
        
    }

    public static function crear() {

        $router = new Router();
        $usuario = new Usuario($_POST);

        //Alertas vacias
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //Revisar que todo el formulario es correcto
            if(empty($alertas)){
                
                //Comprobar que el usuario no este registrado en la BD
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows) {
                    
                    $alertas = Usuario::getAlertas();

                } else {
                    
                    //Hashear Password
                    $usuario->hashPassword();

                    //Generar token único
                    $usuario->crearToken();

                    //Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    //Crear Usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        header ('Location: /AppCrossfit/mensaje');
                    }
                }
            }
            
        }
        
        $router->render('auth/crear-cuenta',[
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);

    }

    public static function mensaje() {
        
        $router = new Router();
        $router->render('auth/mensaje');
    
    }

    public static function mensajePassword() {
    
        $router = new Router();
        $alertas = [];
        $router->render('auth/mensaje-password');
        
    }

    public static function confirmar () {
        $router = new Router();
        $alertas = [];

        if(isset($_GET['token'])) {
            
            $token = s($_GET['token']);
            
            $usuario = Usuario::where('token', $token);

            if(empty($usuario)) {
                //Mostrar mensaje de error
                Usuario::setAlerta('error', 'Token no válido');
            }
            else {
                //Confirmar al usuario
                $usuario->confirmado = '1';
                $usuario->token = null;
                $usuario->guardar();
                Usuario::setAlerta('exito', 'Cuenta Confirmada Correctamente');
            }

            //Obtener Alertas
            $alertas = Usuario::getAlertas();

            //Mostrar Vista
            $router->render('auth/confirmar-cuenta',[
                'alertas' => $alertas
            ]);
        }
        else{
            $router->render('auth/login', [
                'alertas'=>$alertas
            ]);
        }
    }
}