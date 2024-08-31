<?php
session_start();
require_once '../model/usuario.php';
require_once '../config/database.php';

class AuthControllers {
    private $userModel;
    private $db;

    public function __construct() {
        global $conexion;
        $this->db = $conexion;
        $this->userModel = new User($this->db);
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
            header('Location: ../views/login.php?error=1');
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
            header('Location: ../views/register.php?error=1');
            exit();
        }
    }
    
    
    
    
    

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ../views/login.php");
        exit();
    }
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST' || (isset($_GET['action']) && $_GET['action'] == 'logout')) {
    $authController = new AuthControllers();

    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'login':
                $authController->login($_POST['username'], $_POST['password']);
                break;
            case 'register':
                $authController->register($_POST['username'], $_POST['email'], $_POST['password']);
                break;
            case 'logout':
                $authController->logout();
                break;
            default:
                header('Location: ../index.php');
                exit();
        }
    } else {
        header('Location: ../index.php');
        exit();
    }
} else {
    header('Location: ../index.php');
    exit();
}
?>