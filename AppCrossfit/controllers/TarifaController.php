<?php

namespace Controllers;

use MVC\Router;

class TarifaController {

    public static function index() {
        
        session_start();
        $alertas = [];
        $router = new Router();

        if(isset($_SESSION['nombre'])) {

            $router->render('tarifa/index', [
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
?>