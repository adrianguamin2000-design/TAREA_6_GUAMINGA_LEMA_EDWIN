<?php
include 'conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $n = $_POST['nombre'];
    $d = $_POST['descripcion'];
    $p = $_POST['precio'];
    
    $sql = "UPDATE dishes SET name='$n', description='$d', price=$p WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_menu.php");
    } else {
        echo "Error actualizando: " . $conn->error;
    }
}
?>