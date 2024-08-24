<?php
session_start();
require_once '../model/usuario.php';
require_once '../model/database.php';

class AuthControllers {
    private $userModel;
    private $db;

    public function __construct() {
        global $conexion;
        $this->db = $conexion;
        $this->userModel = new User($this->db);
    }

    public function login($username, $password) {
        $user = $this->userModel->login($username, $password);
        if ($user) {
            $_SESSION['user'] = $user;
            header('Location: ../index.php');
            exit();
        } else {
            header('Location: ../views/login.php?error=1');
            exit();
        }
    }

    public function register($username, $email, $password) {
        if ($this->userModel->register($username, $email, $password)) {
            header('Location: ../views/login.php?registered=1');
            exit();
        } else {
            header('Location: ../views/register.php?error=1');
            exit();
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: ../views/login.php');
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