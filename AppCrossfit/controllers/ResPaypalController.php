<?php

namespace Controllers;

use MVC\Router;

use Model\Usuario;
use Model\Cupon;

class ResPaypalController {

    public static function index() {
        session_start();
        $router = new Router();
        $alertas = [];
        if(isset($_SESSION["email"])) {

            
            $usuario = Usuario::where('email', $_SESSION["email"]);
            
            $paymentId = $_GET['paymentId'];
            $payerId = $_GET['PayerID'];

            // Credenciales de PayPal Sandbox
            define('CLIENT_ID', 'AVmj9R58iJwP0gZBUZMaLA3UnGi2YzQJnlPx4zgJdXskHbdCzj-2NrtzOxT-hUEKaH44CbeBbA9_VJ2T');
            define('SECRET_KEY', 'EIHoTEQThXKMKu0gjGL0vrjTLAwNpbEnKANA_M79eKj42_JVkzzj2NmY7j_lStTayKpaK7v18iV2Sm2h');

            // Obtener el token de acceso
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.paypal.com/v1/oauth2/token');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Accept-Language: en_US'
            ]);
            curl_setopt($ch, CURLOPT_USERPWD, CLIENT_ID . ':' . SECRET_KEY);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $accessToken = json_decode($response)->access_token;

            // Obtener los detalles de la transacción
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.paypal.com/v1/payments/payment/' . $paymentId);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $accessToken
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $transactionDetails = json_decode($response);

            // Detalles de la transacción
            $idTransaccion = $transactionDetails->id;
            $precioTotal = $transactionDetails->transactions[0]->amount->total . ' ' . $transactionDetails->transactions[0]->amount->currency;
            $fechaCreacion = $transactionDetails->create_time;
            $fechaCreacion = substr($fechaCreacion, 0, 10);
            $fechaCaducidad = date('Y-m-d', strtotime($fechaCreacion . ' +30 days')); 
            $nombre = $transactionDetails->transactions[0]->item_list->items[0]->name;
            
            $cupon = new Cupon(['id_client' => $usuario->id]);
            $datos = $cupon->datosCompletos();
            $cupon = new Cupon($datos);
            $cupon->estado = 0;
            $cupon->actualizarClases();

            $cupon = new Cupon(['id_cupon' => null, 'id_client' => $usuario->id, 'id_bono' => $_SESSION['id_bono'], 'estado' => 1, 'num_clases' => $_SESSION['num_clases'], 'fecha_suscripcion' => $fechaCreacion,'fecha_finalizacion' => $fechaCaducidad]);
            $cupon->crear();

            $partesfecha = explode("-", $fechaCreacion);
            $fechaCreacion = $partesfecha[2] . "-" . $partesfecha[1] . "-" .$partesfecha[0];

            $router->render('tarifa/confirmacion', [
                'idTransaccion' =>$idTransaccion,
                'precioTotal' =>$precioTotal,
                'fechaCreacion' =>$fechaCreacion,
                'nombre'=>$nombre
                
            ]);
        }
        else{
            $router->render('auth/login', [
                
                'alertas'=>$alertas
            ]);
        }
       
    }
    public static function cancelacion() {
        session_start();
        
        $router = new Router();
        $alertas = [];

        if(isset($_SESSION["email"])) {

            $alertas ['error'][]= 'Ha cancelado la compra';

            $router->render('tarifa/cancelacion', [
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

?>