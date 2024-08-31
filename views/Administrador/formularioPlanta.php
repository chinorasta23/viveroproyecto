<?php
session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../login.php");
        exit();
    }

    require_once("../../controllers/inventarioController.php");
    require_once("../../model/Utilities.php");

    $username = $_SESSION['usuario'];

    if(isset($_POST['agregar'])){
        $img = basename($_FILES["Imagen"]["name"],".jpg");
        $result = inventarioController::ctrlAddPlanta($_POST,$img);
        if($result == true){
                $target = "../../assetts/uploads/" . basename($_FILES["Imagen"]["name"]);
                move_uploaded_file($_FILES["Imagen"]["tmp_name"], $target);
                Utilities::alerta("Articulo agregado correctamente");
            }else{
                Utilities::alerta("No se pudo agregar el articulo");
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active text-light" aria-current="page" href="administrador.php">Inicio</a>
                        </li>
                    </ul>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <!--?php echo htmlspecialchars($username); ?-->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="controllers/AuthControllers.php?action=logout">Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div style="width:600px; height: auto; margin-left: auto; margin-right: auto; margin-top: 50px; border-radius: 5%;" class="main-color">
            <div style="padding: 10%;">
                <form id="Agregar" style="color: white;" action="formularioPlanta.php?action=addPlanta" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Nombre popular</label>
                        <input type="text" class="form-control" name="Nombre">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre cientifico</label>
                        <input type="text" class="form-control" name="Cientifico">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Clima</label>
                        <input type="text" class="form-control" name="Clima">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripcion</label>
                        <input type="text" class="form-control" name="Descripcion">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" min="0" step="1" class="form-control" name="Precio">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" min="0" step="1" class="form-control" name="Cantidad">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Imagen</label>
                        <input type="file" class="form-control" name="Imagen" id="Imagen">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="agregar" class="btn" style="background-color: #ffc120; color: white;">Agregar</button>
                    </div>
                </form>
            </div>
        </div>

<!--Scripts de la pagina-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>    
</body>
</html>