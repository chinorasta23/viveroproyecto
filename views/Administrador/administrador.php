<?php 
    require_once("../../controllers/inventarioController.php");
    $inventario = inventarioController::ctrlGetPlantas();

    if(isset($_GET['accion'])){
        switch($_GET['accion']){
            case 'guardar':
                inventarioController::ctrlUpdatePlanta($_POST);
                header('Location: administrador.php');
                break;
            case 'borrar':
                inventarioController::ctrlDelPlanta($_GET['id']);
                header('Location: administrador.php');
                break;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../../assetts/fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../../assetts/fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../../assetts/fontawesome/css/solid.css" rel="stylesheet" />
</head>
<body>
        <nav class="navbar navbar-expand-lg bg-success">
            <div class="container-fluid">
                <a class="navbar-brand text-light" href="#"><i class="fas fa-leaf"></i></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active text-light" aria-current="page" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-light" aria-current="page" href="formularioPlanta.php">Agregar</a>
                        </li>
                    </ul>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <!--?php echo htmlspecialchars($username); ?-->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../../controllers/AuthControllers.php?action=logout">Cerrar sesión</a></li>
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
            <div class="card h-100">
                <img src="../../assetts/uploads/<?=$planta['img']?>.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?=$planta['nombre_popular']?></h5>
                    <p class="card-text"><?=$planta['nombre_cientifico']?></p>
                    <p class="card-text"><?=$planta['clima']?></p>
                    <p class="card-text"><?=$planta['descripcion']?></p>
                    <p class="card-text"><?=$planta['precio']?></p>
                    <p class="card-text"><?=$planta['stock']?></p>
                    <div class="d-grid gap-2">
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarModal<?=$planta['id_planta']?>" role="button">Editar</a>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editarModal<?=$planta['id_planta']?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Planta</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="administrador.php?accion=guardar" style="color: white;" method="post">
                            <div class="modal-body main-color">
                                <div style="height: auto; margin-left: auto; margin-right: auto; margin-top: 1%;" class="main-color">
                                    <div style="padding: 10%;">
                                            <div class="mb-3">
                                                <label class="form-label">Id</label>
                                                <input type="text" class="form-control" name="Id" value="<?=$planta['id_planta']?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nombre popular</label>
                                                <input type="text" class="form-control" name="Nombre" value="<?=$planta['nombre_popular']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nombre cientifico</label>
                                                <input type="text" class="form-control" name="Cientifico" value="<?=$planta['nombre_cientifico']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Clima</label>
                                                <input type="text" class="form-control" name="Clima" value="<?=$planta['clima']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Descripcion</label>
                                                <input type="text" class="form-control" name="Descripcion" value="<?=$planta['descripcion']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Precio</label>
                                                <input type="number" min="0" step="1" class="form-control" name="Precio" value="<?=$planta['precio']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Cantidad</label>
                                                <input type="number" min="0" step="1" class="form-control" name="Cantidad" value="<?=$planta['stock']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Imagen</label>
                                                <input type="number" min="0" step="1" class="form-control" name="Imagen" value="<?=$planta['img']?>">
                                            </div>
                                    </div>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button id="guardar_<?=$planta['id_planta']?>" type="submit" class="btn btn-success" data-bs-dismiss="modal">Guardar</button>
                            <button id="borrar_<?=$planta['id_planta']?>" type="button" class="btn btn-danger" data-bs-dismiss="modal">Eliminar</button>
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

<!--Scripts de la pagina-->
    <script>
        var botonesEditar = document.querySelectorAll('[id^="guardar"]');
        var botonesEliminar = document.querySelectorAll('[id^="borrar"]');
        botonesEliminar.forEach(function(boton) {
            boton.addEventListener('click', function() {
                var idProducto = this.id.replace('borrar_', '');
                setTimeout(() => {window.location.href = "administrador.php?accion=borrar&id=" + idProducto},500);

            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>    
</body>
</html>