<?php
require_once("Database.php");

class Usuario {
    private $username;
    private $nombre;
    private $primer_apellido;
    private $segundo_apellido;
    private $correo;
    private $password;
    private $id_rol;

    const ROL_CLIENTE = 2;
    const ROL_ADMIN = 1;

    public function __construct() {
        // Constructor vacío
    }

    // Getters
    public function getUsername() { return $this->username; }
    public function getNombre() { return $this->nombre; }
    public function getPrimerApellido() { return $this->primer_apellido; }
    public function getSegundoApellido() { return $this->segundo_apellido; }
    public function getCorreo() { return $this->correo; }
    public function getIdRol() { return $this->id_rol; }

    // Setters
    public function setUsername($username) { $this->username = $username; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setPrimerApellido($primer_apellido) { $this->primer_apellido = $primer_apellido; }
    public function setSegundoApellido($segundo_apellido) { $this->segundo_apellido = $segundo_apellido; }
    public function setCorreo($correo) { $this->correo = $correo; }
    public function setIdRol($id_rol) { $this->id_rol = $id_rol; }

    public function registro($username, $nombre, $primer_apellido, $segundo_apellido, $correo, $password, $es_admin) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $id_rol = $es_admin ? self::ROL_ADMIN : self::ROL_CLIENTE;
        $query = "INSERT INTO usuario (username, nombre, primer_apellido, segundo_apellido, correo, password, id_rol) 
                  VALUES ('$username', '$nombre', '$primer_apellido', '$segundo_apellido', '$correo', '$hashedPassword', $id_rol)";
        return Database::getData($query);
    }

    public function login($username, $password) {
        $query = "SELECT * FROM usuario WHERE username = '$username'";
        $resultado = Database::getData($query);
        
        if (!empty($resultado) && password_verify($password, $resultado[0]['password'])) {
            $this->setUsername($resultado[0]['username']);
            $this->setNombre($resultado[0]['nombre']);
            $this->setPrimerApellido($resultado[0]['primer_apellido']);
            $this->setSegundoApellido($resultado[0]['segundo_apellido']);
            $this->setCorreo($resultado[0]['correo']);
            $this->setIdRol($resultado[0]['id_rol']);
            return true;
        }
        return false;
    }

    public static function obtenerPorUsername($username) {
        $query = "SELECT * FROM usuario WHERE username = '$username'";
        $resultado = Database::getData($query);
    
        if (!empty($resultado)) {
            $data = $resultado[0];
            $usuario = new Usuario();
            $usuario->setUsername($data['username']);
            $usuario->setNombre($data['nombre']);
            $usuario->setPrimerApellido($data['primer_apellido']);
            $usuario->setSegundoApellido($data['segundo_apellido']);
            $usuario->setCorreo($data['correo']);
            $usuario->setIdRol($data['id_rol']);
            return $usuario;
        }
        return null;
    }
    

    public static function obtenerRoles() {
        return [
            self::ROL_CLIENTE => 'Cliente',
            self::ROL_ADMIN => 'Administrador'
        ];
    }

    public function actualizarPerfil($nombre, $primer_apellido, $segundo_apellido, $correo) {
        $query = "UPDATE usuario SET 
                  nombre = '$nombre', 
                  primer_apellido = '$primer_apellido', 
                  segundo_apellido = '$segundo_apellido', 
                  correo = '$correo' 
                  WHERE username = '$this->username'";
        return Database::getData($query);
    }
    
    public function cambiarPassword($nueva_password) {
        $hashedPassword = password_hash($nueva_password, PASSWORD_DEFAULT);
        $query = "UPDATE usuario SET password = '$hashedPassword' WHERE username = '$this->username'";
        return Database::getData($query);
    }

    public static function listarUsuarios() {
        $query = "SELECT username, nombre, primer_apellido, segundo_apellido, correo, id_rol FROM usuario";
        return Database::getData($query);
    }

    public function eliminarCuenta() {
        $query = "DELETE FROM usuario WHERE username = '$this->username'";
        return Database::getData($query);
    }

    public function obtenerHistorialVenta() {
        // Construir la consulta para llamar al procedimiento almacenado
        $query = "CALL ObtenerHistorialVenta('{$this->username}')";
        
        // Ejecutar la consulta usando el método getData
        $result = Database::getData($query);
    
        // Verificar si el resultado es un array
        if (is_array($result)) {
            return $result;
        } else {
            return []; // Retornar un array vacío en caso de error
        }
    }
    
    
    
    
    
    
    
    

}
?>