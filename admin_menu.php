<?php
session_start();
include 'conexion.php';

// Esto verifica si existe y si es administrador, evita el error de "clave indefinida"
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Administrator') {
    die("Acceso denegado. <br> <a href='dashboard.php'>Volver al Panel</a>");
}

$platos = $conn->query("SELECT * FROM dishes");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Gestión de Menú</h2>
    <a href="agregar_plato.php" class="btn btn-success mb-3">Agregar Nuevo Plato</a>
    <table class="table table-bordered">
        <thead>
            <tr><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php while($row = $platos->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>$<?php echo $row['price']; ?></td>
                <td>
                    <a href="eliminar_plato.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
                <td>
                    <a href="editar_plato.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="eliminar_plato.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <div class="mb-4">
        <a href="dashboard.php" class="btn btn-secondary">← Volver al Panel de Administrador</a>
    </div>
</body>
</html>