<?php

namespace Controllers;

use Classes\Email;
use Model\Cupon;
use Model\Usuario;
use Model\Contacto;
use MVC\Router;

class DashboardController {

    public static function index() {

        session_start();
        $router = new Router();

        if(isset($_SESSION['nombre'])) {

            $usuario = Usuario::where('email', $_SESSION["email"]);
            $cupon = new Cupon(['id_client' => $usuario->id]);
            $alertas = $cupon->cuponActivo();

            if($alertas) {
                
                $router->render('tarifa/index', [
                    'nombre'=>$_SESSION['nombre'],
                    'email' =>$_SESSION['email'],
                    'alertas' => $alertas
                ]);
            }
         
            else{
                $router->render('dashboard/index', [
                    'nombre'=>$_SESSION['nombre'],
                    'email' =>$_SESSION['email'],
                    
                ]);
            }
        }
        else{
            $alertas = [];
            $router->render('auth/login', [
                'alertas' => $alertas
            ]);
        }
    }
    public static function contacto() {
        session_start();
        $router = new Router();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $sugerencia = $_POST;
            $usuario = Usuario::where('email', $_SESSION["email"]);
            $alertas = Contacto::insertarMensaje($usuario->id, $sugerencia['mensaje'], $sugerencia['telefono']);

            if (!isset($alertas['error'])) {
                $email = new Email($_SESSION["email"], $_SESSION ['nombreSolo'], '');
                $email->enviarSugerencia($sugerencia['mensaje'], $_SESSION["email"]);
            }
            
        }

        if(isset($_SESSION['nombre'])) {

            $router->render('dashboard/contacto',[
                'nombre'=>$_SESSION['nombre'],
                'nombreSolo'=>$_SESSION['nombreSolo'],
                'apellidos'=>$_SESSION['apellidos'],
                'email' =>$_SESSION['email'],
                'alertas' => $alertas
            ]);
        }
        else{
            $router->render('auth/login',[
                'alertas' => $alertas
            ]);
        }
    }

}
?>