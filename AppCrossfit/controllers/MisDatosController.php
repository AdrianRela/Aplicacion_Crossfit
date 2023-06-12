<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\Cupon;
use Model\Reservas;

class MisDatosController {

    public static function index() {
        
        session_start();
        $alertas = [];
        $router = new Router();

        if(isset($_SESSION['nombre'])) {


            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $usuario = Usuario::where('email', $_SESSION['email']);
                // debuguear($_POST);
                if(isset($_REQUEST['id_clase'])) {
                    $_POST ['id_cliente'] = $usuario->id;
                    // $_POST ['id_clase'] = intval($_POST ['id_clase']);
                    // $_POST ['fecha_actividad'] = date($_POST ['fecha_actividad']);
                    // debuguear($_POST);
                    $reserva = new Reservas ($_POST);
                    $alertas = $reserva->eliminarReserva();

                    if(isset($alertas['exito'])) {
                        $cupon = new Cupon(['id_client' => $usuario->id]);
                        $datos = $cupon->datosCompletos();
                        $cupon = new Cupon($datos);
                        $cupon->num_clases ++;
                        $cupon->actualizarClases();
                    }

                    $router->render('dashboard/datos', [
                        'nombre'=>$_SESSION['nombre'],
                        'nombreSolo'=>$_SESSION['nombreSolo'],
                        'apellidos'=>$_SESSION['apellidos'],
                        'email' =>$_SESSION['email'],
                        'telefono' =>$_SESSION['telefono'],
                        'alertas'=>$alertas
                    ]);
                    
                }
                else{

                    $telefono = $_POST['telefono'];
                    $alertas = $usuario->actualizarTelefono($telefono);

                    $router->render('dashboard/datos', [
                        'nombre'=>$_SESSION['nombre'],
                        'nombreSolo'=>$_SESSION['nombreSolo'],
                        'apellidos'=>$_SESSION['apellidos'],
                        'email' =>$_SESSION['email'],
                        'telefono' =>$_SESSION['telefono'],
                        'alertas'=>$alertas
                    ]);
                }
            }

            $router->render('dashboard/datos', [
                'nombre'=>$_SESSION['nombre'],
                'nombreSolo'=>$_SESSION['nombreSolo'],
                'apellidos'=>$_SESSION['apellidos'],
                'email' =>$_SESSION['email'],
                'telefono' =>$_SESSION['telefono'],
                'alertas'=>$alertas
            ]);
        }
        else{
            $router->render('auth/login', [
                
                'alertas'=>$alertas
            ]);
        }
    }
}
?>