<?php

namespace Model;

class Contacto extends ActiveRecord {

    protected static $tabla = 'mensajes';
    protected static $columnasDB = ['id_mensaje','id_client', 'mensaje'];

    public $id_mensaje;
    public $id_client;
    public $mensaje;

    public function __construct($args = []) {

        $this->id_mensaje = $args['id_mensaje'] ?? null;
        $this->id_client = $args['id_client'] ?? null;
        $this->mensaje = $args['mensaje'] ?? null;
        
    }
    public static function insertarMensaje($id_client, $mensaje, $telefono) {

        $patron = "/^[679]\d{8}$/";

        if (!preg_match($patron, $telefono)) {
            self::$alertas['error'][] = "Número Incorrecto, debe tener 9 números y comenzar por 6, 7 o 9";
            return self::$alertas;
        }
        
        if($mensaje == "" || $telefono == "") {
            self::$alertas['error'][] = "Faltan datos a completar, rellénelos";
            return self::$alertas;
        }
        self::$alertas['exito'][] = "Su mensaje se ha enviado correctamente";
        $query = "INSERT INTO mensajes (id_mensaje, id_client, mensaje) VALUES (NULL, $id_client, '{$mensaje}')";
        self::$db->query($query);
        return self::$alertas;
    }
    
}