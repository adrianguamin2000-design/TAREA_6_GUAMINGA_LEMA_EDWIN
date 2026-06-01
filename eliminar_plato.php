<?php
include 'conexion.php';
$id = $_GET['id'];
$conn->query("DELETE FROM dishes WHERE id = $id");
header("Location: admin_menu.php"); // Regresa a la lista
?>