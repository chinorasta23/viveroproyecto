<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

require_once("../../controllers/PerfilController.php");
$PerfilController = new PerfilController();
$usuario = $PerfilController->obtenerUsuarioActual();
$username = isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']) : 'Invitado';


$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = $authController->actualizarPerfil($_POST);
    if ($resultado['exito']) {
        $mensaje = "Datos actualizados correctamente";
    } else {
        $mensaje = "Error al actualizar los datos: " . $resultado['error'];
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assetts/fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../../assetts/fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../../assetts/fontawesome/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-success fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-light"><i class="fas fa-leaf"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="tienda.php">Tienda</a>
                    </li>
                </ul>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo htmlspecialchars($username); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../controllers/AuthControllers.php?action=logout">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="sidebar mt-5">
        <h4 class="text-center">Mi Cuenta</h4>
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">Perfil</a>
            <a href="carrito.php" class="list-group-item list-group-item-action">Carrito</a>
            <a href="../../controllers/AuthControllers.php?action=logout" class="list-group-item list-group-item-action text-danger">Cerrar Sesión</a>
        </div>
    </div>

    <div class="content mt-5">
        <div class="container">
            <?php if ($mensaje): ?>
                <div class="alert alert-info" role="alert">
                    <?php echo htmlspecialchars($mensaje); ?>
                </div>
            <?php endif; ?>
            
            <div class="card">
                <div class="card-header">
                    <h5>Actualizar Información</h5>
                </div>
                <div class="card-body">
                    <form action="../../controllers/AuthControllers.php" method="post">
                        <input type="hidden" name="action" value="actualizarPerfil">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="primer_apellido" class="form-label">Primer Apellido</label>
                            <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="<?php echo htmlspecialchars($usuario['primer_apellido']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                            <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="<?php echo htmlspecialchars($usuario['segundo_apellido']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="<?php echo htmlspecialchars($usuario['correo']); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>