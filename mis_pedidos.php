<?php

session_start();

include 'conexion.php';

if(!isset($_SESSION['user_id'])){

    die("Acceso denegado");

}

$user_id = $_SESSION['user_id'];

$historial = $conn->query("
SELECT

o.*,

d.name as nombre_plato

FROM orders o

INNER JOIN dishes d
ON o.dish_id = d.id

WHERE o.user_id = $user_id

ORDER BY o.created_at DESC
");

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Mis Pedidos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow-lg border-0">

<div class="card-header bg-primary text-white">

<h2 class="mb-0">
📋 Historial de Mis Pedidos
</h2>

</div>

<div class="card-body">

<div class="mb-3">

<a href="dashboard.php"
class="btn btn-secondary">

⬅ Volver al Panel

</a>

</div>

<div class="table-responsive">

<table class="table table-hover table-bordered align-middle">

<thead class="table-dark">

<tr>

<th>🍽 Plato</th>
<th>📅 Fecha</th>
<th>📌 Estado</th>

</tr>

</thead>

<tbody>

<?php while($p = $historial->fetch_assoc()): ?>

<tr>

<td>

<strong>

<?php echo $p['nombre_plato']; ?>

</strong>

</td>

<td>

<?php echo $p['created_at']; ?>

</td>

<td>

<?php

if($p['status'] == 'Pendiente'){

    echo '<span class="badge bg-warning text-dark">⏳ Pendiente</span>';

}elseif($p['status'] == 'Preparing'){

    echo '<span class="badge bg-info">👨‍🍳 Preparando</span>';

}elseif($p['status'] == 'Ready to serve'){

    echo '<span class="badge bg-success">✅ Listo para Servir</span>';

}elseif($p['status'] == 'Listo'){

    echo '<span class="badge bg-success">✅ Listo</span>';

}else{

    echo '<span class="badge bg-secondary">'.$p['status'].'</span>';

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

</body>

</html>