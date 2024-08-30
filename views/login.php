<?php
session_start();
$error_message = isset($_SESSION['error_login']) ? $_SESSION['error_login'] : '';
unset($_SESSION['error_login']); // Limpiamos el mensaje de error después de usarlo
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assetts/fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../assetts/fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../assetts/fontawesome/css/solid.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .error-message {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-success">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="#"><i class="fas fa-leaf"></i></a>
        </div>
    </nav>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Iniciar Sesión</h2>
            <?php if (!empty($error_message)): ?>
                <div class="error-message">
                    Contraseña o usuario incorrecto
                </div>
            <?php endif; ?>
            <form action="../controllers/AuthControllers.php" method="post">
                <input type="hidden" name="action" value="login">
               
                <div class="mb-3">
                    <label for="username" class="form-label">Nombre de usuario:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
               
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
               
                <button type="submit" class="btn btn-success w-100">Iniciar Sesión</button>
            </form>
            <div class="text-center mt-3">
                <p>¿No tienes una cuenta?</p>
                <a href="register.php" class="btn btn-outline-success">Registrarse</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>