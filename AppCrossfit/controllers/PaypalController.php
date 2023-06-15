<?php

namespace Controllers;

use MVC\Router;

use Model\Tarifa;
use Model\Usuario;
use Model\Cupon;

class PaypalController {

    public static function index() {

        session_start();
        $alertas = [];
        $alertas2 = [];
        $usuario = Usuario::where('email', $_SESSION["email"]);
        $cupon = new Cupon(['id_client' => $usuario->id]);
        $alertas = $cupon->cuponActivo();
        $alertas2 = $cupon->comprobarNumClases();

        if($alertas || $alertas2) {

            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                $tarifa = Tarifa::where('id_bono', $_POST['tarifa']);
                $_SESSION['id_bono'] = $_POST['tarifa'];
                $_SESSION['num_clases'] = $tarifa->num_clases;
            }


            // Credenciales de PayPal Sandbox
            define('CLIENT_ID', 'AVmj9R58iJwP0gZBUZMaLA3UnGi2YzQJnlPx4zgJdXskHbdCzj-2NrtzOxT-hUEKaH44CbeBbA9_VJ2T');
            define('SECRET_KEY', 'EIHoTEQThXKMKu0gjGL0vrjTLAwNpbEnKANA_M79eKj42_JVkzzj2NmY7j_lStTayKpaK7v18iV2Sm2h');
            // Datos del pago
            $paymentData = array(
                'intent' => 'sale',
                'payer' => array(
                    'payment_method' => 'paypal'
                ),
                'transactions' => array(
                    array(
                        'amount' => array(
                            'total' => $tarifa->precio,
                            'currency' => 'EUR'
                        ),
                        'description' => 'Compra de prueba',
                        'item_list' => array(
                            'items' => array(
                                array(
                                    'name' => $tarifa->nombre,
                                    'quantity' => 1,
                                    'price' => $tarifa->precio,
                                    'currency' => 'EUR'
                                )
                            )
                        )
                    )
                ),
                'redirect_urls' => array(
                    'return_url' => 'http://localhost/AppCrossfit/confirmacion',
                    'cancel_url' => 'http://localhost/AppCrossfit/cancelacion'
                )
            );
            // Conexión con la API de PayPal
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.paypal.com/v1/payments/payment');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode(CLIENT_ID . ':' . SECRET_KEY)
            ]);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            // Decodificación de la respuesta JSON
            $response = json_decode($response);

            // Redireccionamiento a PayPal para completar el pago
            header('Location: ' . $response->links[1]->href);
        }
        else{
            $router = new Router();
            $datos = $cupon->datosCompletos();

            $partesfecha = explode("-", $datos['fecha_suscripcion']);
            $datos['fecha_suscripcion'] = $partesfecha[2] . "-" . $partesfecha[1] . "-" .$partesfecha[0];

            $partesfecha = explode("-", $datos['fecha_finalizacion']);
            $datos['fecha_finalizacion'] = $partesfecha[2] . "-" . $partesfecha[1] . "-" .$partesfecha[0];

            $router->render('tarifa/confirmacion', [
                'num_clases' =>$datos['num_clases'],
                'fecha_suscripcion' =>$datos['fecha_suscripcion'],
                'fecha_finalizacion' =>$datos['fecha_finalizacion']
                
            ]);
        }
    }
}

?>