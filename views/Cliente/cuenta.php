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
    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        $primer_apellido = $_POST['primer_apellido'];
        $segundo_apellido = $_POST['segundo_apellido'];
        $correo = $_POST['correo'];

        $mensaje = $PerfilController->actualizarPerfil($nombre, $primer_apellido, $segundo_apellido, $correo);
    } elseif (isset($_POST['eliminar'])) {
        $mensaje = $PerfilController->eliminarCuenta();
    }
}

if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
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
                    <?php if (isset($_SESSION['usuario'])): ?>
                        <a class="btn btn-light text-dark dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo htmlspecialchars($username); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <?php if ($esAdmin): ?>
                                <a href="../Administrador/administrador.php" class="dropdown-item">Panel</a>
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="cuenta.php">Mi Cuenta</a></li>
                            <li><a class="dropdown-item" href="../../controllers/AuthControllers.php?action=logout">Cerrar sesión</a></li>
                        </ul>
                    <?php else: ?>
                        <a class="btn btn-light text-dark" href="../login.php">Iniciar sesión</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

<div class="sidebar mt-5">
    <h4 class="text-center">Mi Cuenta</h4>
    <div class="text-center my-2">
        <a href="cuenta.php" class="btn btn-success text-light d-grid mb-2">Perfil</a>
        <a href="pedidos.php" class="btn btn-success mb-2 text-light d-grid">Pedidos</a>
        <a href="../../controllers/AuthControllers.php?action=logout" class="btn mb-2 btn-success text-light d-grid">Cerrar Sesión</a>
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
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario->getNombre()); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="primer_apellido" class="form-label">Primer Apellido</label>
                        <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="<?php echo htmlspecialchars($usuario->getPrimerApellido()); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                        <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="<?php echo htmlspecialchars($usuario->getSegundoApellido()); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" value="<?php echo htmlspecialchars($usuario->getCorreo()); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <form action="" method="post" class="mt-3">
                    <button type="submit" name="eliminar" class="btn btn-danger">Eliminar Cuenta</button>
                </form> 
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
