<?php

namespace Model;

class Tarifa extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'tarifas';
    protected static $columnasDB = ['id_bono', 'precio', 'nombre','num_clases'];

    public $id_bono;
    public $precio;
    public $nombre;
    public $num_clases;

    public function __construct($args = []) {
        $this->id_bono = $args['id_bono'] ?? null;
        $this->precio = $args['precio'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->num_clases = $args['num_clases'] ?? '';
    }

    public function datosTarifa () {

        $query = "SELECT * FROM " . self::$tabla . " WHERE id_bono = '" . $this->id_bono."';";
        $resultado = self::$db->query($query);
    }
}

?>