<?php
session_start();

require_once('../../model/usuario.php');

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}
$username = $_SESSION['usuario'];

if (isset($_SESSION['usuario'])) {
    $rol = $_SESSION['id_rol'];
    
    $esAdmin = $rol == Usuario::ROL_ADMIN;
} else {
    $esAdmin = false;
}
?>

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
                    <?php if ($esAdmin): ?>
                        <a href="../Administrador/administrador.php" class="dropdown-item">Panel</a>
                    <?php endif; ?>
                        <li><a class="dropdown-item" href="cuenta.php">Mi Cuenta</a></li>
                        <li><a class="dropdown-item" href="../../controllers/AuthControllers.php?action=logout">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <section class="mt-4">
        <div class="container-fluid background-image">
            <div class="row text-center py-5">
                <h1 class="text-light">Bienvenidos</h1>
            </div>
        </div>
    </section>

    <section>
        <div class="container container-fluid my-4">
            <div class="text-center mb-3">
                <h2>¿Por que elegirnos?</h2>
            </div>
            <div class="row row-cols-3">
                <div class="col">
                    <div class="text-center">
                        <h3><i class="fas fa-check"></i> Excelencia</h3>
                        <div class="border-bottom"></div>
                        <div class="px-3">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="text-center">
                        <h3><i class="fas fa-star"></i> Calidad</h3>
                        <div class="border-bottom"></div>
                        <div class="px-3">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="text-center">
                        <h3><i class="fas fa-money-bill"></i> Precio</h3>
                        <div class="border-bottom"></div>
                        <div class="px-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-green-light">
        <div class="row row-cols-3 p-3">
            <div class="col text-center">
                <h3>Nuestros Servicios</h3>
                <img src="https://png.pngtree.com/png-vector/20231115/ourmid/pngtree-bedding-plants-nursery-plants-png-image_10606653.png" alt="">
            </div>
            <div class="m-5 col-5">
                <p>En Stardew, creemos en un futuro verde. Cultivamos nuestras plantas de manera sostenible, utilizando técnicas que respetan el medio ambiente y promueven la biodiversidad. Nuestras prácticas incluyen:
    <br><br>Producción orgánica: Utilizamos fertilizantes naturales y evitamos el uso de pesticidas químicos, garantizando así plantas sanas y libres de residuos tóxicos.
    <br><br>Riego eficiente: Hemos implementado sistemas de riego inteligentes que optimizan el consumo de agua, un recurso cada vez más escaso.
    <br><br>Plantas nativas: Promovemos el uso de plantas nativas, adaptadas a nuestro clima y que contribuyen a la conservación de los ecosistemas locales.
    <br><br>Reciclaje y compostaje: Reciclamos todos los materiales posibles y utilizamos el compost para enriquecer nuestro suelo, creando un ciclo de vida sostenible.
    <br><br>Al elegir nuestras plantas, estás contribuyendo a un mundo más verde y saludable. Visítanos y descubre cómo puedes crear un jardín que sea un refugio para la vida silvestre y una fuente de inspiración para todos.
                </p>
            </div>
        </div>
    </section>

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
                    <p class="text-light">@vivero</p>
                </div>
            </div>
        </div>
        <div class="row text-center p-3 bg-green-darker">
            <span class="text-light" >Copyright 2024 - Vivero</span>
        </div>
    </footer>

</body>
</html>
