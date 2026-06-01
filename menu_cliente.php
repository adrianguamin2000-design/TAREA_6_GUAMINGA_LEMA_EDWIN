<?php

session_start();

include 'conexion.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'Client'){

    die("Acceso denegado");

}

$mensaje = "";

if(isset($_POST['pedir'])){

    $dish_id = $_POST['dish_id'];

    $user_id = $_SESSION['user_id'];

    $conn->query("
    INSERT INTO orders
    (user_id,dish_id,quantity,status)
    VALUES
    ($user_id,$dish_id,1,'Pendiente')
    ");

    $mensaje = "
    <div class='alert alert-success'>
        ✅ Pedido realizado con éxito.
    </div>
    ";
}

$platos = $conn->query("SELECT * FROM dishes");

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Menú del Restaurante</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow-lg border-0">

<div class="card-header bg-success text-white">

<h2 class="mb-0">
🍽 Menú del Restaurante
</h2>

</div>

<div class="card-body">

<?= $mensaje ?>


<div class="table-responsive">

<table class="table table-hover table-bordered align-middle">

<thead class="table-dark">

<tr>

<th>🍽 Plato</th>
<th>📝 Descripción</th>
<th>💲 Precio</th>
<th>🛒 Acción</th>

</tr>

</thead>

<tbody>

<?php while($p = $platos->fetch_assoc()): ?>

<tr>

<td>

<strong>

<?php echo $p['name']; ?>

</strong>

</td>

<td>

<?php echo $p['description']; ?>

</td>

<td>

<span class="badge bg-success fs-6">

$<?php echo number_format($p['price'],2); ?>

</span>

</td>

<td>

<form method="POST">

<input
type="hidden"
name="dish_id"
value="<?php echo $p['id']; ?>">

<button
type="submit"
name="pedir"
class="btn btn-primary btn-sm">

🛒 Pedir

</button>

</form>

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
<div class="mb-3">

<a href="dashboard.php"
class="btn btn-secondary">

⬅ Volver al Panel

</a>

</div>
</body>

</html>