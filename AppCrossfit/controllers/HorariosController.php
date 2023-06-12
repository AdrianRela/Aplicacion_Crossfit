<?php

namespace Controllers;

use Model\Reservas;
use Model\Cupon;
use Model\Horarios;
use MVC\Router;

class HorariosController {

    public static function index() {

        session_start();
        $router = new Router();

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if($_POST['id_clase'] == "") {
                $alertas['error'][] = "No ha seleccionado ninguna clase";
            }
            if(!$alertas) {

                $partes = explode("/",$_POST['fecha_actividad']);
                $fecha_actividad = $partes[2] . "-" . $partes[1] . "-" . $partes[0];
                $fecha_reserva = date("Y-m-d");
                $id_cliente = $_SESSION['id'];
                $partes = explode("-", $_POST['id_clase']);
                $id_clase = $partes[1];

                $datos_reserva = ['id_cliente' => $id_cliente, 'id_clase' => $id_clase, 'fecha_reserva' => $fecha_reserva, 'fecha_actividad' => $fecha_actividad];
                
                $reserva = new Reservas($datos_reserva);
                
                
                $cupon = new Cupon(['id_client' => $id_cliente]);
                $cuponCliente = $cupon->datosCompletos();

                $clase = Horarios::where('id_clase', $id_clase);
                
                // debuguear($clase);

                if($cuponCliente['num_clases'] < 1) {
                    Cupon::setAlerta('error', 'Créditos Agotados');
                    
                }
                if($cuponCliente['fecha_finalizacion'] < $fecha_reserva) {
                    Cupon::setAlerta('error', 'Tú suscripción ha caducado');
                }
                $alertas = Cupon::getAlertas();

                if(!$alertas) {

                    $alertas = $reserva->comprobarReserva($clase->Hora);

                    if(!$alertas) {
                        $cupon = new Cupon($cuponCliente);
                        $cupon->num_clases--;
                        $cupon->actualizarClases();
                        if ($cupon->num_clases == 1) {
                            Reservas::setAlerta('error', 'Solo le queda 1 crédito disponible');
                        }
                        if ($cupon->num_clases == 0) {
                            Reservas::setAlerta('error', 'Se le han agotado los créditos');
                        }
                        // debuguear($cupon);
                        $reserva->crear();
                        Reservas::setAlerta('exito', 'Ha reservado su clase correctamente');
                        $alertas = Reservas::getAlertas();
                        
                    }
                }
            }
            
        }
        if(isset($_SESSION['nombre'])) {

            $router->render('dashboard/horarios', [
                'nombre'=>$_SESSION['nombre'],
                'email' =>$_SESSION['email'],
                'alertas' =>$alertas
                
            ]);
        }
        else{
            $router->render('auth/login', [
                'alertas' =>$alertas
            ]);
        }
         
    }

}
?>