<?php
require_once(__DIR__ . "/../model/Usuario.php");

class AuthController {
    private $usuario;

    public function __construct() {
        $this->usuario = new Usuario();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'registro':
                        return $this->registrar($_POST);
                    case 'login':
                        return $this->iniciarSesion($_POST);
                    case 'actualizarPerfil':
                        return $this->actualizarPerfil($_POST);
                }
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'logout':
                        return $this->cerrarSesion();
                    case 'user':
                        return $this->obtenerUsuarioActual();
                }
            }
        }
        return ["error" => "Acción no válida"];
    }

    public function registrar($post) {
        if (empty($post['username']) || empty($post['nombre']) || empty($post['primer_apellido']) || 
            empty($post['correo']) || empty($post['password']) || !isset($post['es_admin'])) {
            $_SESSION['error_registro'] = "Todos los campos son obligatorios";
            header("Location: ../views/register.php");
            exit();
        }

        if (Usuario::obtenerPorUsername($post['username'])) {
            $_SESSION['error_registro'] = "El nombre de usuario ya está en uso";
            header("Location: ../views/register.php");
            exit();
        }

        $es_admin = filter_var($post['es_admin'], FILTER_VALIDATE_BOOLEAN);

        $resultado = $this->usuario->registro(
            $post['username'],
            $post['nombre'],
            $post['primer_apellido'],
            $post['segundo_apellido'] ?? '',
            $post['correo'],
            $post['password'],
            $es_admin
        );

        if ($resultado['exito']) {
            session_start();
            $_SESSION['usuario'] = $post['username'];
            $_SESSION['id_rol'] = $es_admin ? Usuario::ROL_ADMIN : Usuario::ROL_CLIENTE;

            if ($es_admin) {
                header("Location: ../views/Administrador/administrador.php");
            } else {
                header("Location: ../views/cliente/index.php");
            }
            exit();
        } else {
            $_SESSION['error_registro'] = "Error al registrar el usuario: " . $resultado['error'];
            header("Location: ../views/register.php");
            exit();
        }
    }

    public function iniciarSesion($post) {
        if (empty($post['username']) || empty($post['password'])) {
            $_SESSION['error_login'] = "El nombre de usuario y la contraseña son obligatorios";
            header("Location: ../views/login.php");
            exit();
        }

        if ($this->usuario->login($post['username'], $post['password'])) {
            session_start();
            $_SESSION['usuario'] = $this->usuario->getUsername();
            $_SESSION['id_rol'] = $this->usuario->getIdRol();

            if ($_SESSION['id_rol'] == Usuario::ROL_ADMIN) {
                header("Location: ../views/Administrador/administrador.php");
            } else {
                header("Location: ../views/cliente/index.php");
            }
            exit();
        } else {
            $_SESSION['error_login'] = "Nombre de usuario o contraseña incorrectos";
            header("Location: ../views/login.php");
            exit();
        }
    }

    public function cerrarSesion() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../views/login.php");
        exit();
    }

    public function obtenerUsuarioActual() {
        session_start();
        if (isset($_SESSION['usuario'])) {
            return Usuario::obtenerPorUsername($_SESSION['usuario']);
        }
        return null;
    }

    public function estaAutenticado() {
        session_start();
        return isset($_SESSION['usuario']);
    }

    public function obtenerRoles() {
        return Usuario::obtenerRoles();
    }

    public function actualizarPerfil($post) {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            return ["exito" => false, "error" => "Usuario no autenticado"];
        }

        if (empty($post['nombre']) || empty($post['primer_apellido']) || empty($post['correo'])) {
            return ["exito" => false, "error" => "Todos los campos son obligatorios"];
        }

        $username = $_SESSION['usuario'];
        $resultado = $this->usuario->actualizarPerfil(
            $username,
            $post['nombre'],
            $post['primer_apellido'],
            $post['segundo_apellido'] ?? '',
            $post['correo']
        );

        if ($resultado) {
            return ["exito" => true, "mensaje" => "Perfil actualizado con éxito"];
        } else {
            return ["exito" => false, "error" => "Error al actualizar el perfil"];
        }
    }
}

// Uso del controlador
$authController = new AuthController();
$result = $authController->handleRequest();

// Si hay un resultado y es un array, lo convertimos a JSON
if (is_array($result)) {
    header('Content-Type: application/json');
    echo json_encode($result);
}
?>