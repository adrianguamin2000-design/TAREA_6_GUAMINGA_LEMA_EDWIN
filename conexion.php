<?php
$host = 'localhost';
$db = 'restaurante_db';
$user = 'root';
$pass = '';
$port = 3308; // Puerto configurado en tu XAMPP

$conn = new mysqli($host, $user, $pass, $db, $port);

// ESTO ES LO QUE TE DIRÁ SI FALLA
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
// echo "Conectado"; // Descomenta esto solo para probar
?>