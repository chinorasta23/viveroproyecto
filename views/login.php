<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Vivero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 60px;
        }
        .login-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 15px;
        }
        .btn-register {
            display: block;
            width: 100%;
            margin-top: 10px;
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
            Nombre de usuario o contraseña incorrectos.
        </div>
        <?php endif; ?>
        <?php if(isset($_GET['registered']) && $_GET['registered'] == 1): ?>
        <div class="alert alert-success text-center">
            Registro exitoso. Por favor, inicia sesión.
        </div>
        <?php endif; ?>
        <form class="login-form" action="../controllers/AuthControllers.php?action=login" method="POST">
            <h2 class="text-center mb-4">Iniciar Sesión</h2>
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Nombre de usuario" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Iniciar Sesión</button>
            <a href="register.php" class="btn btn-outline-success btn-register">Regístrate aquí</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>