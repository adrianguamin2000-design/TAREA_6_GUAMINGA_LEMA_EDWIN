<?php
session_start();
include 'conexion.php';
// Solo permitir acceso a Administrador o Chef
if (!in_array($_SESSION['role'], ['Administrator', 'Chef'])) die("Acceso denegado");

$pedidos = $conn->query("SELECT o.*, u.username, d.name as plato 
                         FROM orders o 
                         JOIN users u ON o.user_id = u.id 
                         JOIN dishes d ON o.dish_id = d.id");
?>
<table class="table">
    <tr><th>Usuario</th><th>Plato</th><th>Cant</th><th>Estado</th></tr>
    <!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Gestión de Pedidos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow-lg border-0">

<div class="card-header bg-primary text-white">

<h2 class="mb-0">📋 Gestión de Pedidos</h2>

</div>

<div class="card-body">

<div class="mb-3">


<div class="table-responsive">

<table class="table table-hover table-bordered align-middle">

<thead class="table-dark">

<tr>

<th>👤 Usuario</th>
<th>🍽 Plato</th>
<th>🔢 Cantidad</th>
<th>📌 Estado</th>

</tr>

</thead>

<tbody>

<?php while($o = $pedidos->fetch_assoc()): ?>

<tr>

<td>

<strong>

<?php echo $o['username']; ?>

</strong>

</td>

<td>

<?php echo $o['plato']; ?>

</td>

<td>

<span class="badge bg-primary">

<?php echo $o['quantity']; ?>

</span>

</td>

<td>

<?php

if($o['status'] == 'Pending'){

    echo '<span class="badge bg-warning text-dark">Pendiente</span>';

}elseif($o['status'] == 'Preparing'){

    echo '<span class="badge bg-info">Preparando</span>';

}elseif($o['status'] == 'Ready to serve'){

    echo '<span class="badge bg-success">Listo para Servir</span>';

}else{

    echo '<span class="badge bg-secondary">'.$o['status'].'</span>';

}

?>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>

<div class="card-footer text-center text-muted">

Sistema de Gestión de Restaurante

</div>

</div>

</div>
<a href="dashboard.php" class="btn btn-secondary">

⬅ Volver al Panel

</a>

</div>

</body>

</html>
    <?php while($o = $pedidos->fetch_assoc()): ?>
        
    <tr>
        <td><?php echo $o['username']; ?></td>
        <td><?php echo $o['plato']; ?></td>
        <td><?php echo $o['quantity']; ?></td>
        <td><?php echo $o['status']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>
