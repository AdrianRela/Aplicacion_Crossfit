<?php

namespace Controllers;

use MVC\Router;
use Model\Resultados;

class ResultadosController {

    public static function index() {
        
        session_start();
        $alertas = [];
        $router = new Router();

        if(isset($_SESSION['nombre'])) {

            if($_SERVER['REQUEST_METHOD'] === 'POST') {

                if(isset($_POST['id_resultado'])) {
                    $resultado = new Resultados(['id_cliente'=>$_SESSION['id'], 'id_resultado' =>$_POST['id_resultado']]);
                    $alertas = $resultado->borrarResultado();
                }

                else if(isset($_POST['id_ejercicio']) && !isset($_POST['series'])) {
                    $resultado = new Resultados(['id_cliente'=>$_SESSION['id'], 'id_ejercicio' =>$_POST['id_ejercicio']]);
                    $alertas = $resultado->borrarTodosResultado();
                }

                else{
                    $_POST['id_cliente'] = $_SESSION['id'];
                    $resultado = new Resultados($_POST);
                    $alertas = $resultado->insertarResultado();
                }
            }

            $router->render('dashboard/resultados', [
                'nombre'=>$_SESSION['nombre'],
                'email' =>$_SESSION['email'],
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