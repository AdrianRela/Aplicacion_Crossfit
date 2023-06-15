<?php

namespace Model;

use Model\Horarios;

class Reservas extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'reservas';
    protected static $columnasDB = ['id_cliente', 'id_clase', 'fecha_reserva', 'fecha_actividad'];

    public $id_cliente;
    public $id_clase;
    public $fecha_reserva;
    public $fecha_actividad;
    

    public function __construct($args = []) {
        $this->id_cliente = $args['id_cliente'] ?? null;
        $this->id_clase = $args['id_clase'] ?? '';
        $this->fecha_reserva = $args['fecha_reserva'] ?? '';
        $this->fecha_actividad = $args['fecha_actividad'] ?? '';
       
    }
    public function comprobarReserva($hora_clase) {

        $fecha_actividadFinal = $this->fecha_actividad . " " . $hora_clase;
        $hora_actual = date('H:i:s');
        $fecha_limite = date('Y-m-d', strtotime($this->fecha_reserva . ' +2 days')) . " " . $hora_actual;
        $fecha_reservaFinal = $this->fecha_reserva . " " . $hora_actual;
        
        if($fecha_reservaFinal > $fecha_actividadFinal) {
            
            self::$alertas['error'][] = "Esa clase ya ha finalizado";
           
        }
        
        else if($fecha_actividadFinal > $fecha_limite) {
            
            self::$alertas['error'][] = "Solo se puede reservar con 48 horas de antelación";
            
        }
        else{

            $query = "SELECT * FROM " . self::$tabla . " WHERE id_cliente = '" . $this->id_cliente."' AND fecha_actividad = '" . $this->fecha_actividad."' AND id_clase = '" . $this->id_clase."';";
            $resultado = self::$db->query($query);
            if($resultado->num_rows == 1) {
                
                self::$alertas['error'][] = "Ya tiene una reserva para esa clase";
            }
            else{

                $query = "SELECT COUNT(*) AS total_reservas FROM ". self::$tabla . " WHERE id_clase = '" . $this->id_clase."' AND fecha_actividad = '" . $this->fecha_actividad."' GROUP BY id_clase, fecha_actividad";
                $resultado = self::$db->query($query);
                $datos = $resultado->fetch_assoc();

                if($datos) {
                    if ($datos['total_reservas'] > 14) {
                        self::$alertas['error'][] = "La Clase está Completa";
                        
                    }
                }
                
            }
        }
        return self::$alertas;
    }

    public function reservasCliente() {

        $fechaActual = date("Y-m-d");
        $datos = [];
        $query = "SELECT * FROM " . self::$tabla . " WHERE id_cliente = '" . $this->id_cliente."' AND fecha_actividad >= '{$fechaActual}' ORDER BY fecha_actividad;";
        $resultado = self::$db->query($query);
        while($row = $resultado->fetch_assoc()) {
            array_push($datos, $row);
        }
        return $datos;
    }

    public function eliminarReserva(){
        $query = "DELETE FROM " . self::$tabla . " WHERE id_cliente = '" . $this->id_cliente . "' AND fecha_actividad = '" . $this->fecha_actividad . "' AND id_clase = '" . $this->id_clase . "';";
        $resultado = self::$db->query($query);
        if($resultado) {
            self::$alertas['exito'][] = "Reserva Cancelada Correctamente";
        }
        else{
            self::$alertas['error'][] = "Hubo un problema en su cancelación de reserva";
        }
        return self::$alertas;
    }
}

?>