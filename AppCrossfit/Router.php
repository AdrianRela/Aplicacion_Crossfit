<?php

namespace MVC;

class Router {
    private $routes = array();

    public function map($method, $path, $handler) {
        $this->routes[] = array(
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        );
    }

    public function route($method, $path) {
        foreach ($this->routes as $route) {
            if ($route['method'] == $method && $route['path'] == $path) {
                return $route['handler']();
            }
        }

        return null;
    }

    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];

        if(isset($_SERVER['REDIRECT_URL'])){
            $path = $_SERVER['REDIRECT_URL'];
        }
        else{
            $path = $_SERVER['REQUEST_URI'];
        }
        

        return $this->route($method, $path);
    }

    public function render($view, $datos = [])
    {

        // Leer lo que le pasamos  a la vista
        foreach ($datos as $key => $value) {
            $$key = $value;  // Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, pero al asignarla a otra no la reescribe, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
        }

        ob_start(); // Almacenamiento en memoria durante un momento...

        // entonces incluimos la vista en el layout
        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // Limpia el Buffer
        include_once __DIR__ . '/views/layout.php';
    }
}
