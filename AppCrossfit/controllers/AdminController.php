<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\Horarios;
use Model\Cupon;
use Model\Ejercicios;
use Model\Resultados;
use Model\Tarifa;

class AdminController {

    public static function index() {
        
        session_start();
        $alertas = [];
        $datosCliente = [];
        $datosActualizar = [];
        $router = new Router();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            if($_POST['accion'] == "consultar") {

                if($_POST['tabla'] == "Usuario") {
                    $datosCliente = Usuario::where('id', $_POST['IdConsulta']);
                    
                }
                if($_POST['tabla'] == "Clases") {
                    $datosCliente = Horarios::where('id_clase', $_POST['IdConsulta']);
                    
                }
                if($_POST['tabla'] == "Cupon") {
                    $datosCliente = Cupon::where('id_cupon', $_POST['IdConsulta']);
                    
                }
                if($_POST['tabla'] == "Ejercicios") {
                    $datosCliente = Ejercicios::where('id_ejercicio', $_POST['IdConsulta']);
                    
                }
                if($_POST['tabla'] == "Resultados") {
                    $datosCliente = Resultados::where('id_resultado', $_POST['IdConsulta']);
                    
                }
                if($_POST['tabla'] == "Tarifas") {
                    $datosCliente = Tarifa::where('id_bono', $_POST['IdConsulta']);
                    
                }
                $router->render('admin/consultas', [
                    'nombre'=>$_SESSION['nombre'],
                    'email' =>$_SESSION['email'],
                    'datosCliente' => $datosCliente,
                    'datosActualizar'=> $datosActualizar
                ]);
            }
            if($_POST['accion'] == "borrar") {
                if($_POST['tabla'] == "Usuario") {
                    $resultado = Usuario::eliminar('id', $_POST['IdConsulta']);
                    if($resultado) {
                        Usuario::setAlerta('exito', 'Cliente borrado con exito');
                        $alertas = Usuario::getAlertas();
                    }
                    
                }
                if($_POST['tabla'] == "Clases") {
                    $resultado = Horarios::eliminar('id_clase', $_POST['IdConsulta']);
                    if($resultado) {
                        Horarios::setAlerta('exito', 'Clase borrada con exito');
                        $alertas = Horarios::getAlertas();
                    }
                    
                }
                if($_POST['tabla'] == "Cupon") {
                    $resultado = Cupon::eliminar('id_cupon', $_POST['IdConsulta']);
                    if($resultado) {
                        Cupon::setAlerta('exito', 'Cupón borrado con exito');
                        $alertas = Cupon::getAlertas();
                    }
                    
                }
                if($_POST['tabla'] == "Ejercicios") {
                    $resultado = Ejercicios::eliminar('id_ejercicio', $_POST['IdConsulta']);
                    if($resultado) {
                        Ejercicios::setAlerta('exito', 'Ejercicio borrado con exito');
                        $alertas = Ejercicios::getAlertas();
                    }
                    
                }
                if($_POST['tabla'] == "Resultados") {
                    $resultado = Resultados::eliminar('id_resultado', $_POST['IdConsulta']);
                    if($resultado) {
                        Resultados::setAlerta('exito', 'Resultado borrado con exito');
                        $alertas = Resultados::getAlertas();
                    }
                    
                }
                if($_POST['tabla'] == "Tarifas") {
                    $resultado = Tarifa::eliminar('id_bono', $_POST['IdConsulta']);
                    if($resultado) {
                        Tarifa::setAlerta('exito', 'Tarifa borrada con exito');
                        $alertas = Tarifa::getAlertas();
                    }
                    
                }
                $router->render('admin/admin', [
                    'nombre'=>$_SESSION['nombre'],
                    'email' =>$_SESSION['email'],
                    'alertas'=>$alertas
                    
                ]);
                
            }
            if ($_POST['accion'] == "actualizar") {
                // debuguear($_POST);

                if($_POST['tabla'] == "Usuario") {
                    $datosActualizar = Usuario::where('id', $_POST['IdConsulta']);
                    
                }
                if($_POST['tabla'] == "Clases") {
                    $datosActualizar = Horarios::where('id_clase', $_POST['IdConsulta']);
                    
                }
                if($_POST['tabla'] == "Cupon") {
                    $datosActualizar = Cupon::where('id_cupon', $_POST['IdConsulta']);
                    
                }
                if($_POST['tabla'] == "Ejercicios") {
                    $datosActualizar = Ejercicios::where('id_ejercicio', $_POST['IdConsulta']);
                    
                }
                if($_POST['tabla'] == "Resultados") {
                    $datosActualizar = Resultados::where('id_resultado', $_POST['IdConsulta']);
                    
                }
                if($_POST['tabla'] == "Tarifas") {
                    $datosActualizar = Tarifa::where('id_bono', $_POST['IdConsulta']);
                    
                }

                $router->render('admin/consultas', [
                    'nombre'=>$_SESSION['nombre'],
                    'email' =>$_SESSION['email'],
                    'datosCliente' => $datosCliente,
                    'datosActualizar'=> $datosActualizar,
                    'tabla'=> $_POST['tabla']
                ]);
            }
        }
        else{

            if(isset($_SESSION['nombre'])) {

                $router->render('admin/admin', [
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

    public static function actualizarAdmin() {

        session_start();
        $alertas = [];
        $router = new Router();

        if($_POST ['tabla'] == "Usuario") {
            $usuario = new Usuario($_POST);
            $resultado = $usuario->actualizar('id');
            if($resultado) {
                Usuario::setAlerta('exito', 'Cliente actualizado con exito');
                $alertas = Usuario::getAlertas();
            }
        }

        if($_POST ['tabla'] == "Clases") {
            $clase = new Horarios($_POST);
            $resultado = $clase->actualizar('id_clase');
            if($resultado) {
                Horarios::setAlerta('exito', 'Clase actualizada con exito');
                $alertas = Horarios::getAlertas();
            }
        }
        if($_POST ['tabla'] == "Cupon") {
            $cupon = new Cupon($_POST);
            $resultado = $cupon->actualizar('id_cupon');
            if($resultado) {
                Cupon::setAlerta('exito', 'Cupon actualizado con exito');
                $alertas = Cupon::getAlertas();
            }
        }
        if($_POST ['tabla'] == "Ejercicios") {
            $ejercicios = new Ejercicios($_POST);
            $resultado = $ejercicios->actualizar('id_ejercicio');
            if($resultado) {
                Ejercicios::setAlerta('exito', 'Ejercicio actualizado con exito');
                $alertas = Ejercicios::getAlertas();
            }
        }
        if($_POST ['tabla'] == "Resultados") {
            $res = new Resultados($_POST);
            $resultado = $res->actualizar('id_resultado');
            if($resultado) {
                Resultados::setAlerta('exito', 'Resultado actualizado con exito');
                $alertas = Resultados::getAlertas();
            }
        }
        if($_POST ['tabla'] == "Tarifas") {
            $tarifa = new Tarifa($_POST);
            $resultado = $tarifa->actualizar('id_bono');
            if($resultado) {
                Tarifa::setAlerta('exito', 'Tarifa actualizada con exito');
                $alertas = Tarifa::getAlertas();
            }
        }


        $router->render('admin/admin', [
            'nombre'=>$_SESSION['nombre'],
            'email' =>$_SESSION['email'],
            'alertas'=>$alertas
            
        ]);
    }

    public static function insertarAdmin() {

        session_start();
        $alertas = [];
        $router = new Router();

        if($_POST ['tabla'] == "Usuario") {
            $usuario = new Usuario($_POST);
            $res = Usuario::where('id', $usuario->id);
            if($res) {
                Horarios::setAlerta('error', 'Ya existe ese id de Cliente');
            }
            else{
                $resultado = $usuario->crear();
                if($resultado) {
                    Usuario::setAlerta('exito', 'Cliente insertado con exito');
                    
                }
            }
            $alertas = Usuario::getAlertas();
            
        }

        if($_POST ['tabla'] == "Clases") {
            $clase = new Horarios($_POST);
            $res = Horarios::where('id_clase', $clase->id_clase);
            if($res) {
                Horarios::setAlerta('error', 'Ya existe ese id de Clase');
            }
            else{
                $resultado = $clase->crear();
                if($resultado) {
                    Horarios::setAlerta('exito', 'Clase insertado con exito');
                    
                }
            }
            $alertas = Horarios::getAlertas();
            
        }
        if($_POST ['tabla'] == "Cupon") {
            $cupon = new Cupon($_POST);
            $res = Cupon::where('id_cupon', $cupon->id_cupon);
            if($res) {
                Cupon::setAlerta('error', 'Ya existe ese id de Cupon');
            }
            else{
                $resultado = $cupon->crear();
                if($resultado) {
                    Cupon::setAlerta('exito', 'Cupon insertado con exito');
                    
                }
            }
            $alertas = Cupon::getAlertas();
        }
        if($_POST ['tabla'] == "Ejercicios") {
            $ejercicios = new Ejercicios($_POST);
            $res = Ejercicios::where('id_ejercicio', $ejercicios->id_ejercicio);
            if($res) {
                Ejercicios::setAlerta('error', 'Ya existe ese id de Ejercicio');
            }
            else{
                $resultado = $ejercicios->crear();
                if($resultado) {
                    Ejercicios::setAlerta('exito', 'Ejercicio insertado con exito');
                    
                }
            }
            $alertas = Ejercicios::getAlertas();
            
        }
        if($_POST ['tabla'] == "Resultados") {
            $res = new Resultados($_POST);
            $resul = Resultados::where('id_resultado', $res->id_resultado);
            if($resul) {
                Resultados::setAlerta('error', 'Ya existe ese id de Resultado');
            }
            else{
                $resultado = $res->crear();
                if($resultado) {
                    Resultados::setAlerta('exito', 'Resultado insertado con exito');
                    
                }
            }
            $alertas = Resultados::getAlertas();
        }
        if($_POST ['tabla'] == "Tarifas") {
            $tarifa = new Tarifa($_POST);
            $res = Tarifa::where('id_bono', $tarifa->id_bono);
            if($res) {
                Tarifa::setAlerta('error', 'Ya existe ese id de Tarifa');
            }
            else{
                $resultado = $tarifa->crear();
                if($resultado) {
                    Tarifa::setAlerta('exito', 'Tarifa insertado con exito');
                    
                }
            }
            $alertas = Tarifa::getAlertas();
        }


        $router->render('admin/admin', [
            'nombre'=>$_SESSION['nombre'],
            'email' =>$_SESSION['email'],
            'alertas'=>$alertas
            
        ]);
    }
    
}
?>