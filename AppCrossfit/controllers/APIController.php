<?php

namespace Controllers;

use Model\Tarifa;
use Model\Horarios;
use Model\Cupon;
use Model\Usuario;
use Model\Reservas;
use Model\Ejercicios;
use Model\Resultados;

class APIController {

    public static function index() {

        $tarifas = Tarifa::all();
        echo json_encode($tarifas);
    }

    public static function horarios() {

        $horarios = Horarios::all();
        echo json_encode($horarios);
    }

    public static function reservas() {

        $reservas = Reservas::all();
        echo json_encode($reservas);
    }
    public static function suscripcion() {
        session_start();
        $suscripcion = [];

        $cupon = new Cupon(['id_client' => $_SESSION['id']]);
        $cupones = $cupon -> datosCompletos();
        $partesfecha_fi = explode('-', $cupones['fecha_finalizacion']);
        $partesfecha_sus = explode('-', $cupones['fecha_suscripcion']);

        $fecha_finalizacion = $partesfecha_fi[2] . '/' . $partesfecha_fi[1] . '/' . $partesfecha_fi[0];
        $fecha_suscripcion = $partesfecha_sus[2] . '/' . $partesfecha_sus[1] . '/' . $partesfecha_sus[0];;
        
        $tarifa = Tarifa::where ('id_bono', $cupones['id_bono']);

        $utilizados = $tarifa->num_clases - $cupones['num_clases'];

        $suscripcion  = ['creditos_utilizados' => $utilizados, 'creditos_disponibles' => intval($cupones['num_clases']), 'fecha_finalizacion' => $fecha_finalizacion, 'fecha_suscripcion' => $fecha_suscripcion];
    
        echo json_encode($suscripcion);
    }

    public static function ListaReservas() {
        session_start();
        $Lista_reservas = [];

        $reservas = new Reservas(['id_cliente' => $_SESSION['id']]);
        $Lista_reservas = $reservas -> reservasCliente();

        $horaActual = date("H:i:s");
        $fechaActual = date("Y-m-d");

        foreach ($Lista_reservas as $key => $reserva) {

            $horario = Horarios::where ('id_clase', $reserva['id_clase']);
            if ($horario->Hora < $horaActual && $fechaActual == $reserva['fecha_actividad']) {
                unset($Lista_reservas[$key]);
            }
            else{
                $nuevaReserva = array(
                    'id_clase' => $reserva['id_clase'],
                    'fecha_actividad' => $reserva['fecha_actividad'],
                    'hora' => $horario->Hora,
                    'tipo' => $horario->nombre
                );
                
                $Lista_reservas[$key] = $nuevaReserva;
                // $Lista_reservas [$key] ['hora'] = $horario->Hora;
                // $Lista_reservas [$key] ['tipo'] = $horario->nombre;
            }
        }
        $Lista_reservas = array_values($Lista_reservas);
        echo json_encode($Lista_reservas);
    }

    public static function resultados() {
        session_start();
        $resultados = [];
        
        $ejercicios = Ejercicios::all(); 
        
        foreach ($ejercicios as $key => $ejercicio) {
            $res = new Resultados (['id_cliente' => $_SESSION['id'], 'id_ejercicio'=>$ejercicio->id_ejercicio]);
            $datosResultado = $res->comprobarResultado();
            if (!$datosResultado) {
                $nuevoEjercicio = array(
                    'id_ejercicio' => $ejercicio->id_ejercicio,
                    'nombre' => $ejercicio->nombre,
                    'resultado' => '-',
                    'fecha' => '-',
                    'RM' => '-',
                    'opciones'=>""
                    
                );
                
                $ejercicios[$key] = $nuevoEjercicio;
            }
            else{

                $partes_fecha = explode("-", $datosResultado['fecha_realizacion']);
                $fecha_cambiada = $partes_fecha[2] . "-" . $partes_fecha[1] . "-" . $partes_fecha[0];
                $nuevoEjercicio = array(
                    'id_ejercicio' => $ejercicio->id_ejercicio,
                    'nombre' => $ejercicio->nombre,
                    'resultado' => $datosResultado['series'] . "x" . $datosResultado['reps'] . " @ " . $datosResultado['peso'] . " KG",
                    'fecha' => $fecha_cambiada,
                    'RM' => $datosResultado['RM'] . " KG",
                    'opciones'=>"",
                    'id_resultado'=>$datosResultado['id_resultado']
                );
                $ejercicios[$key] = $nuevoEjercicio;
            }
        }
        echo json_encode($ejercicios);
    }

    public static function IdsConsulta() {
        
        if($_GET['tabla'] == "Usuario") {
            $clientes = Usuario::all();
            echo json_encode($clientes);
        }
        if($_GET['tabla'] == "Clases") {
            $clases = Horarios::all();
            echo json_encode($clases);
        }
        if($_GET['tabla'] == "Cupon") {
            $cupon = Cupon::all();
            if(!$cupon) {
                $cupon [] = array (
                    "id_cupon"=>"",
                    "id_client"=>"",
                    "id_bono"=>"",
                    "estado"=>"",
                    "num_clases"=>"",
                    "fecha_suscripcion"=>"",
                    "fecha_finalizacion"=>""
                );
            }
            echo json_encode($cupon);
            
        }
        if($_GET['tabla'] == "Ejercicios") {
            $ejercicio = Ejercicios::all();
            echo json_encode($ejercicio);
        }
        if($_GET['tabla'] == "Resultados") {
            $resultado = Resultados::all();
            if(!$resultado) {
                $resultado [] = array (
                    "id_resultado" => "",
                    "id_cliente" => "",
                    "id_ejercicio" => "",
                    "series" => "",
                    "reps" => "",
                    "peso" => "",
                    "RM" => "",
                    "fecha_realizacion" => ""
                );
            }
            echo json_encode($resultado);
        }
        if($_GET['tabla'] == "Tarifas") {
            $tarifa = Tarifa::all();
            echo json_encode($tarifa);
        }
    }

}

?>