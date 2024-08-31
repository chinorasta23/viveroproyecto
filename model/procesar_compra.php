<?php
require_once("database.php");
require_once("inventarioModel.php");

// Verificar si el usuario está autenticado
session_start(); // Asegúrate de que la sesión esté iniciada
if (!isset($_SESSION['usuario'])) {
    die("No estás autenticado.");
}

// Verificar si el carrito tiene productos
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    die("El carrito está vacío.");
}

// Calcular el total
$total = 0;
foreach ($_SESSION['carrito'] as $id_planta => $item) {
    $planta = inventarioModel::getPlantaID($id_planta);
    if ($planta && isset($planta[0])) {
        $planta = $planta[0];
        $precio = $planta['precio'];
        $total += $precio * $item['cantidad'];
    }
}

// Insertar la venta
$username = $_SESSION['usuario'];
$query = "INSERT INTO venta (username, total) VALUES ('$username', $total)";
$resultado = database::getData($query);

if ($resultado['exito']) {
    // Limpiar el carrito después de la compra
    unset($_SESSION['carrito']);
    header("Location: ../views/success.php");
} else {
    echo "Error al completar la compra: " . $resultado['error'];
}
?>
