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
}
?>
