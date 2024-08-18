<?php session_start(); ?>
<nav class="navbar navbar-expand-lg bg-success fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="#">Vivero</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-light" href="#"><?php echo $_SESSION['user']['correo']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="../controllers/AuthController.php?action=logout">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>