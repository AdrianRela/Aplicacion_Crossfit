<?php

namespace Model;

class Horarios extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'clases';
    protected static $columnasDB = ['id_clase', 'Hora', 'Dia', 'nombre'];

    public $id_clase;
    public $Hora;
    public $Dia;
    public $nombre;
    

    public function __construct($args = []) {
        $this->id_clase = $args['id_clase'] ?? null;
        $this->Hora = $args['Hora'] ?? '';
        $this->Dia = $args['Dia'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
       
    }
}

?>