<?php

namespace Model;

class Ejercicios extends ActiveRecord {

    protected static $tabla = 'ejercicios';
    protected static $columnasDB = ['id_ejercicio','nombre'];

    public $id_ejercicio;
    public $nombre;

    public function __construct($args = []) {

        $this->id_ejercicio = $args['id_ejercicio'] ?? null;
        $this->nombre = $args['nombre'] ?? null;
        
    }
}