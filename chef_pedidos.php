<?php
session_start();
include 'conexion.php';
// Validar que sea Chef
if ($_SESSION['role'] !== 'Chef') die("Acceso denegado");

// Procesar actualización de estado
if (isset($_POST['update_status'])) {
    $id = $_POST['order_id'];
    $nuevo_estado = $_POST['status'];
    $conn->query("UPDATE orders SET status='$nuevo_estado' WHERE id=$id");
}

$pedidos = $conn->query("SELECT o.*, d.name as plato FROM orders o JOIN dishes d ON o.dish_id = d.id");
?>

<table class="table">
    <tr><th>Plato</th><th>Cantidad</th><th>Estado Actual</th><th>Acción</th></tr>
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

<div class="card-header bg-dark text-white">

<h2 class="mb-0">👨‍🍳 Gestión de Pedidos - Chef</h2>

</div>

<div class="card-body">


<div class="table-responsive">

<table class="table table-hover table-bordered align-middle">

<thead class="table-dark">

<tr>

<th>🍽 Plato</th>
<th>🔢 Cantidad</th>
<th>📌 Estado Actual</th>
<th>⚙ Acción</th>

</tr>

</thead>

<tbody>

<?php while($o = $pedidos->fetch_assoc()): ?>

<tr>

<td>
<strong><?php echo $o['plato']; ?></strong>
</td>

<td>
<span class="badge bg-primary">
<?php echo $o['quantity']; ?>
</span>
</td>

<td>

<?php
if($o['status'] == 'Preparing'){
    echo '<span class="badge bg-warning text-dark">Preparando</span>';
}
elseif($o['status'] == 'Ready to serve'){
    echo '<span class="badge bg-success">Listo para Servir</span>';
}
else{
    echo '<span class="badge bg-secondary">'.$o['status'].'</span>';
}
?>

</td>

<td>

<form method="POST" class="d-flex gap-2">

<input
type="hidden"
name="order_id"
value="<?php echo $o['id']; ?>">

<select
name="status"
class="form-select">

<option value="Preparing">

👨‍🍳 Preparing

</option>

<option value="Ready to serve">

✅ Ready to serve

</option>

</select>

<button
type="submit"
name="update_status"
class="btn btn-primary">

Actualizar

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

<a href="dashboard.php" class="btn btn-secondary">

⬅ Volver al Panel

</a>

</div>
</body>

</html>
    <?php while($o = $pedidos->fetch_assoc()): ?>
    <tr>
        <td><?php echo $o['plato']; ?></td>
        <td><?php echo $o['quantity']; ?></td>
        <td><?php echo $o['status']; ?></td>
        <td>
            <form method="POST">
                <input type="hidden" name="order_id" value="<?php echo $o['id']; ?>">
                <select name="status">
                    <option value="Preparing">Preparing</option>
                    <option value="Ready to serve">Ready to serve</option>
                </select>
                <button type="submit" name="update_status" class="btn btn-sm btn-primary">Actualizar</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

