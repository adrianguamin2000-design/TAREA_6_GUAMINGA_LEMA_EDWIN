<?php

session_start();

include 'conexion.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'Waiter'){

    die("Acceso denegado");

}

if(isset($_GET['finalizar'])){

    $id = (int)$_GET['finalizar'];

    $conn->query("
    UPDATE orders
    SET status='Entregado'
    WHERE id=$id
    ");

}

$pedidos = $conn->query("

SELECT

o.*,

d.name AS plato,

u.username AS cliente

FROM orders o

INNER JOIN dishes d
ON o.dish_id = d.id

INNER JOIN users u
ON o.user_id = u.id

WHERE o.status != 'Entregado'

");

?>

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

<div class="card-header bg-success text-white">

<h2 class="mb-0">
🍽 Gestión de Pedidos - Camarero
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

<th>👤 Cliente</th>
<th>🍽 Plato</th>
<th>📌 Estado</th>
<th>⚙ Acción</th>

</tr>

</thead>

<tbody>

<?php while($p = $pedidos->fetch_assoc()): ?>

<tr>

<td>

<strong>

<?php echo $p['cliente']; ?>

</strong>

</td>

<td>

<?php echo $p['plato']; ?>

</td>

<td>

<?php

if($p['status'] == 'Pendiente'){

    echo '<span class="badge bg-warning text-dark">⏳ Pendiente</span>';

}
elseif($p['status'] == 'Preparing'){

    echo '<span class="badge bg-info">👨‍🍳 Preparando</span>';

}
elseif($p['status'] == 'Ready to serve'){

    echo '<span class="badge bg-success">✅ Listo para Servir</span>';

}
else{

    echo '<span class="badge bg-secondary">'.$p['status'].'</span>';

}

?>

</td>

<td>

<a
href="?finalizar=<?php echo $p['id']; ?>"
class="btn btn-success btn-sm"
onclick="return confirm('¿Marcar este pedido como entregado?')">

✔ Marcar Entregado

</a>

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