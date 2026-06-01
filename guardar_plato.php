<?php
include 'conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $n = $_POST['nombre'];
    $d = $_POST['descripcion'];
    $p = $_POST['precio'];
    $conn->query("INSERT INTO dishes (name, description, price) VALUES ('$n', '$d', $p)");
    header("Location: admin_menu.php");
}
?>