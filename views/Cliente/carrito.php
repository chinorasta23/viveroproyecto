<?php
session_start();
require_once("../../controllers/inventarioController.php");

$username = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';

// Procesa la eliminación de productos
if (isset($_POST['action']) && $_POST['action'] === 'remove') {
    $id_planta = $_POST['id_planta'];
    inventarioController::ctrlRemoveFromCart($id_planta);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Procesa la actualización de cantidades
if (isset($_POST['action']) && $_POST['action'] === 'update') {
    $id_planta = $_POST['id_planta'];
    $cantidad = (int)$_POST['cantidad'];

    if ($cantidad > 0) {
        $_SESSION['carrito'][$id_planta]['cantidad'] = $cantidad;
    } else {
        // Si la cantidad es 0 o menor, eliminamos el producto del carrito
        unset($_SESSION['carrito'][$id_planta]);
    }

    // Elimina el producto si la cantidad es 0
    if (empty($_SESSION['carrito'][$id_planta])) {
        unset($_SESSION['carrito'][$id_planta]);
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Obtén los datos de cada planta en el carrito
$carrito = $_SESSION['carrito'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../../assetts/fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../../assetts/fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../../assetts/fontawesome/css/solid.css" rel="stylesheet" />
    <title>Vivero - Mi Carrito</title>
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

<div class="container container-fluid mt-5 pt-4">
    <div class="text-center">
        <h2>Mi Carrito</h2>
    </div>
    <div class="row row-cols-2">
        <div class="col-6">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;

                    foreach ($carrito as $id_planta => $item) {
                        // Obtén los detalles de la planta
                        $planta = inventarioModel::getPlantaID($id_planta);
                        
                        if ($planta && isset($planta[0])) {
                            $planta = $planta[0];
                            $nombre = $planta['nombre_popular'];
                            $precio = $planta['precio'];
                        } else {
                            $nombre = "Nombre no disponible";
                            $precio = 0;
                        }

                        $cantidad = $item['cantidad'];
                        $subtotal = $precio * $cantidad;
                        $total += $subtotal;
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($nombre); ?></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="id_planta" value="<?php echo htmlspecialchars($id_planta); ?>">
                                <input type="hidden" name="action" value="update">
                                <input type="number" name="cantidad" value="<?php echo htmlspecialchars($cantidad); ?>" min="1" class="form-control form-control-sm">
                                <button type="submit" class="btn btn-primary btn-sm mt-1">Actualizar</button>
                            </form>
                        </td>
                        <td>₡ <?php echo number_format($precio, 2); ?></td>
                        <td>₡ <?php echo number_format($subtotal, 2); ?></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="id_planta" value="<?php echo htmlspecialchars($id_planta); ?>">
                                <input type="hidden" name="action" value="remove">
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card text-center bg-success">
                    <h1 class="text-light">Total: <h1 class="text-light">₡ <?php echo number_format($total, 2); ?></h1></h1>
                </div>
                <div class="row row-cols-2 my-2">
                    <div class="col d-grid">
                        <a class="btn btn-warning" href="tienda.php">Regresar</a>
                    </div>
                    <div class="col d-grid">
                        <form action="../../model/procesar_compra.php" method="post">
                            <button class="btn btn-success" type="submit">Comprar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
