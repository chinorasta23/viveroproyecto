<?php
session_start();
require_once("../../controllers/PerfilController.php");

$PerfilController = new PerfilController();
$usuario = $PerfilController->obtenerUsuarioActual();

if (!$usuario) {
    echo "No hay usuario en sesión.";
    exit();
}

$historialPedidos = $usuario->obtenerHistorialVenta();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta - Pedidos</title>
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
                        <?php echo htmlspecialchars($_SESSION['usuario']); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
        <h2 class="my-4">Historial de Pedidos</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($historialPedidos)): ?>
                    <?php foreach ($historialPedidos as $pedido): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($pedido['id_venta']); ?></td>
                            <td><?php echo htmlspecialchars($pedido['total']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">No se encontraron pedidos.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
