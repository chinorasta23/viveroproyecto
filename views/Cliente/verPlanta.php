<?php
    require_once("../../controllers/inventarioController.php");

    session_start();
    $username = isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']) : 'Invitado';


    $id_planta = isset($_GET['id']) ? intval($_GET['id']) : 0;

    $plantaData = inventarioController::ctrlgetPlantaId($id_planta);

    if (!$plantaData || !isset($plantaData[0])) {
        echo "Producto no encontrado.";
        exit;
    }

    $planta = $plantaData[0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
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

    <div class="container mt-4">
        <div class="container container-fluid">
            <div class="row my-5 py-5">
                <a class="btn btn-dark col-1" href="tienda.php"><i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <img src="<?= htmlspecialchars($planta['img']) ?>" class="img-fluid" alt="<?= htmlspecialchars($planta['nombre_popular']) ?>">
            </div>
            <div class="col-md-6">
                <h2><?=$planta['nombre_popular']?></h2>
                <p><strong>Nombre popular:</strong> <?= isset($planta['nombre_popular']) ? htmlspecialchars($planta['nombre_popular']) : 'No disponible' ?></p>
                <p><strong>Nombre científico:</strong> <?= isset($planta['nombre_cientifico']) ? htmlspecialchars($planta['nombre_cientifico']) : 'No disponible' ?></p>
                <p><strong>Clima:</strong> <?= isset($planta['clima']) ? htmlspecialchars($planta['clima']) : 'No disponible' ?></p>
                <p><strong>Descripción:</strong> <?= isset($planta['descripcion']) ? htmlspecialchars($planta['descripcion']) : 'No disponible' ?></p>
                <p><strong>Precio:</strong> <?= isset($planta['precio']) ? htmlspecialchars($planta['precio']) : 'No disponible' ?> colones</p> 


                <form action="tienda.php?accion=comprar" method="post">
                    <input type="hidden" name="Id" value="<?=$planta['id_planta']?>">
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad:</label>
                        <input type="number" min="1" step="1" class="form-control" id="cantidad" name="Cantidad" value="1">
                    </div>
                    <button type="submit" class="btn btn-success">Comprar</button>
                </form>
            </div>
        </div>
</div>
</body>
</html>
