<?php
    require_once("../../controllers/inventarioController.php");

    // Iniciar la sesión y obtener el nombre de usuario
    session_start();
    $username = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';

    $inventario = inventarioController::ctrlGetPlantas();

    require_once("../../model/usuario.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
        $plantaId = $_POST['id_planta'];
        $cantidad = 1; // For simplicity, we add one item at a time
        inventarioController::ctrlAddToCart($plantaId, $cantidad);
        header("Location: tienda.php");
        exit;
    }



    if (isset($_SESSION['usuario'])) {
        $rol = $_SESSION['id_rol'];
        
        $esAdmin = $rol == Usuario::ROL_ADMIN;
    } else {
        $esAdmin = false;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vivero - Tienda</title>
    <link rel="stylesheet" href="../../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../../assetts/fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../../assetts/fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../../assetts/fontawesome/css/solid.css" rel="stylesheet" />
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
                <a class="nav-link text-light mx-4" href="carrito.php"><i class="fas fa-cart-plus    "></i></a>
    
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

    <div class="row text-center mt-5 pt-5">
                        <h2>Tienda</h2>
        </div>

    <div class="row row-cols-1 row-cols-md-3 g-4" style="padding: 1%; padding-right: 15%; padding-left: 15%;">
        <?php
            foreach($inventario as $planta){
        ?>
        <div class="col">
            <div class="card h-100" >
            <img src="<?= htmlspecialchars($planta['img']) ?>" class="img-fluid card-img-top" alt="<?= htmlspecialchars($planta['nombre_popular']) ?>">
                <div class="card-body">
                    <h5 class="card-title text-center"><?=$planta['nombre_popular']?></h5>
                </div>
                <div class="row text-center">
                        <p>₡ <?=$planta['precio']?></p>
                        <span>Stock: (<?=$planta['stock']?>)</span>
                    </div>
                <div class="card-footer text-center">
                        <a class="btn btn-success col" href="verPlanta.php?id=<?=$planta['id_planta']?>">Ver Detalles</a>
                    <form method="POST" action="">
                        <input type="hidden" name="id_planta" value="<?= $planta['id_planta'] ?>">
                        <button type="submit" name="add_to_cart" class="btn btn-success col">Añadir al Carrito <i class="fas fa-cart-plus"></i></button>
                    </form>
                </div>
            </div>
        </div>

        <?php
            }
        ?>
    </div>

    <footer>
        <div class="row row-cols-4 bg-success p-3">
            <div class="col text-center">
                <h4 class="text-light">Vivero</h4>
                <div class="border-bottom"></div>
                <div class="p-3">
                    <p class="text-light">Nuestro vivero cuenta con gran variedad de plantas y flores de la mas alta calidad y totalmente organico</p>
                </div>
            </div>
            <div class="col text-center">
                <h4 class="text-light">Acerca De</h4>
                <div class="border-bottom"></div>
                <div class="p-3">
                    <p class="text-light">Somos un negocio familiar que impregna su pasion y amor por las plantas en cada entrega hacia nuestros clientes</p>
                </div>
            </div>
            <div class="col text-center">
                <h4 class="text-light">Contacto</h4>
                <div class="border-bottom"></div>
                <div class="p-3">
                    <p class="text-light">Tel. 8888-8888</p>
                </div>
            </div>
            <div class="col text-center">
                <h4 class="text-light">Redes Sociales</h4>
                <div class="border-bottom"></div>
                <div class="p-3">
                    <p class="text-light">@Stardew</p>
                </div>
            </div>
        </div>
        <div class="row text-center p-3 bg-green-darker">
            <span class="text-light" >Copyright 2024 - Vivero</span>
        </div>
    </footer>
</body>
</html>