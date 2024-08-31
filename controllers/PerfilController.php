<?php
require_once("../../model/usuario.php");

class PerfilController {
    
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function obtenerUsuarioActual() {
        if (isset($_SESSION['usuario'])) {
            $username = $_SESSION['usuario'];
            $usuario = Usuario::obtenerPorUsername($username);
            return $usuario;
        }
        return null;
    }
    
    public function actualizarPerfil($nombre, $primer_apellido, $segundo_apellido, $correo) {
        if (isset($_SESSION['usuario'])) {
            $username = $_SESSION['usuario'];
            $usuario = Usuario::obtenerPorUsername($username);
            
            if ($usuario) {
                $usuario->actualizarPerfil($nombre, $primer_apellido, $segundo_apellido, $correo);
                header("Location: cuenta.php");
                exit();
            }
        }
        return "Error al actualizar el perfil.";
    }

    public function eliminarCuenta() {
        if (isset($_SESSION['usuario'])) {
            $username = $_SESSION['usuario'];
            $usuario = Usuario::obtenerPorUsername($username);
            
            if ($usuario) {
                $usuario->eliminarCuenta();
                session_destroy();
                header("Location: ../goodbye.php");
                exit();
            }
        }
        return "Error al eliminar la cuenta.";
    }
    

    public function obtenerHistorialVenta() {
        $usuario = $this->obtenerUsuarioActual();

        if ($usuario) {
            return $usuario->obtenerHistorialVenta();
        }
        return [];
    }
    
    
    



}
?>
