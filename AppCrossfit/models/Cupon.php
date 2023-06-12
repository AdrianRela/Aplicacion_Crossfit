<?php

namespace Model;

class Cupon extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'cupon_cliente';
    protected static $columnasDB = ['id_cupon', 'id_client', 'id_bono', 'estado', 'num_clases','fecha_suscripcion', 'fecha_finalizacion'];
    
    public $id_cupon;
    public $id_client;
    public $id_bono;
    public $estado;
    public $num_clases;
    public $fecha_suscripcion;
    public $fecha_finalizacion;

    public function __construct($args = []) {

        $this->id_cupon = $args['id_cupon'] ?? null;
        $this->id_client = $args['id_client'] ?? null;
        $this->id_bono = $args['id_bono'] ?? null;
        $this->estado = $args['estado'] ?? 0;
        $this->num_clases = $args['num_clases'] ?? 0;
        $this->fecha_suscripcion = $args['fecha_suscripcion'] ?? null;
        $this->fecha_finalizacion = $args['fecha_finalizacion'] ?? null;
    }

    //Revisa si el usuario ya tiene un cupón activo
    public function cuponActivo() {

        $query = "SELECT * FROM " . self::$tabla . " WHERE id_client = '" . $this->id_client."';";

        $resultado = self::$db->query($query);
        if($resultado->num_rows == 0) {
            self::$alertas['error'][] = "No ha comprado ningún bono.";
        }
        else{

            $query = "SELECT * FROM " . self::$tabla . " WHERE id_client = '" . $this->id_client."' AND estado = 1;";
            $resultado = self::$db->query($query);
            
            if($resultado->num_rows == 0) {
                self::$alertas['error'][] = "No tiene un bono activo.";
            }
            else{
                $query = "SELECT * FROM " . self::$tabla . " WHERE id_client = '" . $this->id_client."' AND fecha_finalizacion >= CURDATE() AND estado = 1;";
                $resultado = self::$db->query($query);

                if($resultado->num_rows == 0) {
                    self::$alertas['error'][] = "Su bono ha caducado.";
                    $query = "UPDATE cupon_cliente SET estado = 0 WHERE fecha_finalizacion <= CURDATE() AND estado = 1 AND
                    id_client = '" . $this->id_client."';";
                    $resultado = self::$db->query($query);

                }
                
            }
        }
        return self::$alertas;
    }
    public function datosCompletos() {

        $query = "SELECT * FROM " . self::$tabla . " WHERE id_client = '" . $this->id_client."' AND estado = 1;";
        $resultado = self::$db->query($query);

        $datos = $resultado->fetch_assoc();
        return $datos;
    }

    public function actualizarClases() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        // Consulta SQL
        $query = "UPDATE " . self::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id_cupon = '" . self::$db->escape_string($this->id_cupon) . "' ";
        $query .= " LIMIT 1 "; 

        // Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }
    public function comprobarNumClases() {
        
        $query = "SELECT * FROM " . self::$tabla . " WHERE id_client = '" . $this->id_client."' AND estado = 1 AND num_clases = 0;";
        $resultado = self::$db->query($query);
        
        if($resultado->num_rows == 1) {
            self::$alertas['error'][] = "No tiene créditos disponibles.";
        }
        return self::$alertas;
    }
}

?>