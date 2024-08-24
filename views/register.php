<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Vivero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 60px;
        }
        .register-form {
            max-width: 500px;
            margin: 0 auto;
            padding: 15px;
        }
        .login-option {
            margin-top: 20px;
            text-align: center;
        }
        .error-message {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid transparent;
            border-radius: .25rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-success fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="#">Vivero</a>
        </div>
    </nav>
    <div class="container">
        <?php if(isset($_GET['error']) && $_GET['error'] == 1): ?>
        <div class="error-message">
            Error al registrar el usuario. Por favor, inténtalo de nuevo.
        </div>
        <?php endif; ?>
        <form class="register-form" action="../controllers/AuthControllers.php?action=register" method="POST">
            <h2 class="text-center mb-4">Registro</h2>
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Nombre de usuario" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Registrar</button>
        </form>
        <div class="login-option">
            <p>¿Ya tienes una cuenta?</p>
            <a href="login.php" class="btn btn-outline-success">Iniciar Sesión</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>