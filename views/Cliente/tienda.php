<?php
    require_once("../../controllers/inventarioController.php");
    $inventario = inventarioController::ctrlGetPlantas();

    if(isset($_GET['accion'])){
        switch($_GET['accion']){
            case 'comprar':
                if(inventarioController::ctrlVerificarCantidad($_POST)){
                    inventarioController::ctrlComprarPlanta($_POST);
                    Utilities::alerta("Comprado con exito");
                }else{
                    Utilities::alerta("No hay stock suficiente");
                }
                break;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vivero</title>
    <link rel="stylesheet" href="../../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../../assetts/fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../../assetts/fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../../assetts/fontawesome/css/solid.css" rel="stylesheet" />
</head>
<body>
<nav class="navbar navbar-expand-lg bg-success">
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
                        <li><a class="dropdown-item" href="controllers/AuthControllers.php?action=logout">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="row row-cols-1 row-cols-md-3 g-4" style="padding: 1%; padding-right: 15%; padding-left: 15%;">
        <?php
            foreach($inventario as $planta){
        ?>
        <div class="col">
            <div class="card h-100" >
                <img src="../../assetts/uploads/<?=$planta['img']?>.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?=$planta['nombre_popular']?></h5>
                    <div class="d-grid gap-2">
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#informacionModal<?=$planta['id_planta']?>" role="button">Detalles</a>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="informacionModal<?=$planta['id_planta']?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?=$planta['nombre_popular']?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="tienda.php?accion=comprar" style="color: white;" method="post">
                            <div class="modal-body main-color">
                                <div style="height: auto; margin-left: auto; margin-right: auto; margin-top: 1%;" class="main-color">
                                    <div style="padding: 10%;">
                                            <div class="mb-3">
                                                <label class="form-label">Nombre cientifico</label>
                                                <input type="text" class="form-control" name="Cientifico" value="<?=$planta['nombre_cientifico']?>" disabled>
                                                <input type="hidden"  name="Id" value="<?=$planta['id_planta']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Clima</label>
                                                <input type="text" class="form-control" name="Clima" value="<?=$planta['clima']?>" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Descripcion</label>
                                                <input type="text" class="form-control" name="Descripcion" value="<?=$planta['descripcion']?>" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Precio</label>
                                                <input type="number" min="0" step="1" class="form-control" name="Precio" value="<?=$planta['precio']?>" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Cantidad</label>
                                                <input type="number" min="1" step="1" class="form-control" name="Cantidad" value=1>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button id="comprar" type="submit" class="btn btn-success" data-bs-dismiss="modal">Comprar</button>
                            <button id="cancelar" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</body>
</html>