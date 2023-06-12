<?php

namespace Model;

class Usuario extends ActiveRecord {

    //Base de datos
    protected static $tabla = 'clientes';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];


    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []){

        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? null;
        $this->confirmado = $args['confirmado'] ?? null;
        $this->token = $args['token'] ?? '';
    }

    //Mensajes de validacion para la creación de una cuenta
    public function validarNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas ['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas ['error'][] = 'El Apellido es Obligatorio';
        }
        if(!$this->email) {
            self::$alertas ['error'][] = 'El Email es Obligatorio';
        }
        if(!$this->password) {
            self::$alertas ['error'][] = 'La Contraseña es Obligatoria';
        }
        if(strlen($this->password) < 8) {
            self::$alertas ['error'][] = 'La Contraseña debe tener al menos 8 caracteres';
        }

        return self::$alertas;
    }

    //Mensajes de validacion del inicio de sesión
    public function validarLogin() {
        
        if(!$this->email) {
            self::$alertas ['error'][] = 'El Email es Obligatorio';
        }
        if(!$this->password) {
            self::$alertas ['error'][] = 'La Contraseña es Obligatoria';
        }

        return self::$alertas;
    }

    public function validarEmail() {

        if(!$this->email) {

            self::$alertas ['error'][] = 'El Email es Obligatorio';
        }
        
        return self::$alertas;
    }

    public function validarPassword() {

        if(!$this->password) {
            self::$alertas ['error'][] = 'La Contraseña es Obligatoria';
        }
        
        if(strlen($this->password) < 8) {
            self::$alertas ['error'][] = 'La Contraseña debe tener al menos 8 caracteres';
        }

        return self::$alertas;
    }

    //Revisa si el usuario ya existe
    public function existeUsuario() {

        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado->num_rows) {
            self::$alertas['error'][] = "El Usuario ya esta resgitrado";
        }

        return $resultado;
    }

    public function hashPassword() {

        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() {

        $this->token = uniqid();
    }

    public function ComprobarPassAndConfirmado($password) {

        $resultado = password_verify($password, $this->password);
        if (!$this->confirmado){
            self::$alertas['error'][] = "Aún no ha confirmado su cuenta, revise su email";
        }
        if (!$resultado){
            self::$alertas['error'][] = "La contraseña es incorrecta";
        }
        return self::$alertas;
    }

    public function actualizarTelefono($telefono) {

        $patron = "/^[679]\d{8}$/";

        if (!preg_match($patron, $telefono)) {
            self::$alertas['error'][] = "Número Incorrecto, debe tener 9 números y comenzar por 6, 7 o 9";
            return self::$alertas;
        }
        
        $query = "UPDATE clientes SET telefono = '{$telefono}' WHERE id = '" . $this->id . "';";
        $resultado = self::$db->query($query);

        if($resultado) {
            
            self::$alertas['exito'][] = "Teléfono Actualizado Correctamente";
            $_SESSION['telefono'] = $telefono;
        }
        else{
            self::$alertas['error'][] = "Hubo un problema al actualizar su teléfono";
        }
        return self::$alertas;
    
    }

}