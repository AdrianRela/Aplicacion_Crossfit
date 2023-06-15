<?php

namespace Model;

class Resultados extends ActiveRecord {

    protected static $tabla = 'resultados';
    protected static $columnasDB = ['id_resultado','id_cliente', 'id_ejercicio', 'series', 'reps', 'peso', 'RM', 'fecha_realizacion'];

    public $id_resultado;
    public $id_cliente;
    public $id_ejercicio;
    public $series;
    public $reps;
    public $peso;
    public $RM;
    public $fecha_realizacion;

    public function __construct($args = []) {

        $this->id_resultado = $args['id_resultado'] ?? null;
        $this->id_cliente = $args['id_cliente'] ?? null;
        $this->id_ejercicio = $args['id_ejercicio'] ?? null;
        $this->series = $args['series'] ?? null;
        $this->reps = $args['reps'] ?? null;
        $this->peso = $args['peso'] ?? null;
        $this->RM = $args['RM'] ?? null;
        $this->fecha_realizacion = $args['fecha_realizacion'] ?? null;
        
    }
    public function comprobarResultado() {
        $query = "SELECT * FROM resultados 
        WHERE id_cliente = '" . $this->id_cliente . "' AND id_ejercicio = '" . $this->id_ejercicio . "'
        ORDER BY RM DESC LIMIT 1;";

        $resultado = self::$db->query($query);
        
        if($resultado->num_rows == 1) {
            $datos = $resultado->fetch_assoc();
            return $datos;
        }
        return false;
    }

    public function borrarResultado() {
        $query = "DELETE FROM resultados WHERE id_resultado = '" . $this->id_resultado . "' AND id_cliente = '" . $this->id_cliente . "';";
        $resultado = self::$db->query($query);

        if($resultado) {
            self::$alertas['exito'][] = "Se ha borrado el registro correctamente";
        }else{
            self::$alertas['error'][] = "Hubo un problema al borrar el registro";
        }
        return self::$alertas;

    }
    public function borrarTodosResultado() {
        $query = "DELETE FROM resultados WHERE id_ejercicio = '" . $this->id_ejercicio . "' AND id_cliente = '" . $this->id_cliente . "';";
        $resultado = self::$db->query($query);

        if($resultado) {
            self::$alertas['exito'][] = "Se han borrado todos los registros correctamente";
        }else{
            self::$alertas['error'][] = "Hubo un problema al borrar los registros";
        }
        return self::$alertas;

    }
    public function insertarResultado() {
        $hoy = date("Y-m-d");

        if ($this->reps == ""){
            self::$alertas['error'][] = "El campo de las repeticiones es obligatorio";
        }
        if($this->series == "") {
            self::$alertas['error'][] = "El campo de las series es obligatorio";
        }
        if($this->peso == "") {
            self::$alertas['error'][] = "El campo del peso es obligatorio";
        }
        if($this->fecha_realizacion == "") {
            self::$alertas['error'][] = "El campo de la fecha es obligatorio";
        }
        if($this->fecha_realizacion > $hoy) {
            self::$alertas['error'][] = "La fecha de realización no puede ser mayor al día actual";
        }
        if(empty(self::$alertas['error'])) {

            if ($this->reps == 1) {
                $RM = intval($this->peso);
            }
            else{
                $RM = intval($this->peso * (1 + ($this->reps / 30)));
            }
            
            $query = "INSERT INTO resultados (id_cliente, id_ejercicio, series, reps, peso, RM, fecha_realizacion)
            VALUES ($this->id_cliente, $this->id_ejercicio, $this->series, $this->reps, $this->peso, $RM, '{$this->fecha_realizacion}')";
            
            $resultado = self::$db->query($query);

            if($resultado) {
                self::$alertas['exito'][] = "Se ha insertado el resultado correctamente";
            }else{
                self::$alertas['error'][] = "Hubo un problema al insertar su resultado";
            }
        }
        return self::$alertas;

    }
}