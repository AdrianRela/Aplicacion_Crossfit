<?php 

require_once __DIR__ . '/includes/app.php';
use Controllers\LoginController;
use Controllers\DashboardController;
use Controllers\TarifaController;
use Controllers\APIController;
use Controllers\PaypalController;
use Controllers\ResPaypalController;
use Controllers\HorariosController;
use Controllers\MisDatosController;
use Controllers\ResultadosController;
use MVC\Router;

$router = new Router();

// //Iniciar Sesión
$router->map( 'GET', '/AppCrossfit/', function() {
    LoginController::login();
});
$router->map( 'POST', '/AppCrossfit/login', function() {
    LoginController::login();
});

// //Crear Cuenta
$router->map( 'GET', '/AppCrossfit/crear-cuenta', function() {
    LoginController::crear();
});
$router->map( 'POST', '/AppCrossfit/crear-cuenta', function() {
    LoginController::crear();
});

// //Cierre Sesion
$router->map( 'GET', '/AppCrossfit/logout', function() {
    LoginController::logout();
});

// //Recuperar Password
$router->map( 'GET', '/AppCrossfit/olvide', function() {
    LoginController::olvide();
});
$router->map( 'POST', '/AppCrossfit/olvide', function() {
    LoginController::olvide();
});
$router->map( 'GET', '/AppCrossfit/recuperar', function() {
    LoginController::recuperar();
});
$router->map( 'POST', '/AppCrossfit/recuperar', function() {
    LoginController::recuperar();
});

//Confirmar Cuenta
$router->map('GET',"/AppCrossfit/confirmar-cuenta", function() {
    LoginController::confirmar();
});

$router->map('GET',"/AppCrossfit/mensaje", function() {
    LoginController::mensaje();
});

$router->map('GET',"/AppCrossfit/mensaje-password", function() {
    LoginController::mensajePassword();
});

//Área Privada
$router->map('GET',"/AppCrossfit/dashboard", function() {
    DashboardController::index();
});
//Área Privada
$router->map('POST',"/AppCrossfit/dashboard", function() {
    DashboardController::index();
});

//Página de Contacto
$router->map('GET',"/AppCrossfit/dashboard-contacto", function() {
    DashboardController::contacto();
});
$router->map('POST',"/AppCrossfit/dashboard-contacto", function() {
    DashboardController::contacto();
});

//Página de Horarios
$router->map('GET',"/AppCrossfit/dashboard-horarios", function() {
    HorariosController::index();
});
$router->map('POST',"/AppCrossfit/dashboard-horarios", function() {
    HorariosController::index();
});

//Área Privada
$router->map('GET',"/AppCrossfit/tarifa", function() {
    TarifaController::index();
});
$router->map('POST',"/AppCrossfit/tarifa", function() {
    TarifaController::index();
});

//Conexion API
$router->map('GET',"/AppCrossfit/api/servicios", function() {
    APIController::index();
});
$router->map('GET',"/AppCrossfit/api/horarios", function() {
    APIController::horarios();
});
$router->map('GET',"/AppCrossfit/api/reservas", function() {
    APIController::reservas();
});
$router->map('GET',"/AppCrossfit/api/lista-reservas", function() {
    APIController::listaReservas();
});
$router->map('GET',"/AppCrossfit/api/suscripcion", function() {
    APIController::suscripcion();
});
$router->map('GET',"/AppCrossfit/api/resultados", function() {
    APIController::resultados();
});

//Conexion Paypal
$router->map('GET',"/AppCrossfit/paypal", function() {
    PaypalController::index();
});

//Conexion Paypal
$router->map('POST',"/AppCrossfit/paypal", function() {
    PaypalController::index();
});

//Respuesta Paypal
$router->map('GET',"/AppCrossfit/confirmacion", function() {
    ResPaypalController::index();
});
$router->map('GET',"/AppCrossfit/cancelacion", function() {
    ResPaypalController::cancelacion();
});

//Página Mis Datos
$router->map('GET',"/AppCrossfit/dashboard-misdatos", function() {
    MisDatosController::index();
});
$router->map('POST',"/AppCrossfit/dashboard-misdatos", function() {
    MisDatosController::index();
});
$router->map('GET',"/AppCrossfit/dashboard-resultados", function() {
    ResultadosController::index();
});
$router->map('POST',"/AppCrossfit/dashboard-resultados", function() {
    ResultadosController::index();
});

$router->run();