<?php
include 'conexion.php';
$usuarios = $conn->query("SELECT u.id, u.username, u.email, r.name as rol 
                          FROM users u JOIN roles r ON u.role_id = r.id");
?>
<table class="table">
    <!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Gestión de Usuarios</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow-lg border-0">

<div class="card-header bg-danger text-white">

<h2 class="mb-0">👥 Gestión de Usuarios</h2>

</div>


<div class="table-responsive">

<table class="table table-hover table-bordered align-middle">

<thead class="table-dark">

<tr>

<th>👤 Usuario</th>
<th>📧 Email</th>
<th>🔑 Rol</th>
<th>⚙ Acción</th>

</tr>

</thead>

<tbody>

<?php while($u = $usuarios->fetch_assoc()): ?>

<tr>

<td>

<strong>

<?php echo $u['username']; ?>

</strong>

</td>

<td>

<?php echo $u['email']; ?>

</td>

<td>

<?php

if($u['rol'] == 'Administrator'){

    echo '<span class="badge bg-danger">Administrador</span>';

}elseif($u['rol'] == 'Chef'){

    echo '<span class="badge bg-success">Chef</span>';

}elseif($u['rol'] == 'Waiter'){

    echo '<span class="badge bg-primary">Mesero</span>';

}else{

    echo '<span class="badge bg-secondary">'.$u['rol'].'</span>';

}

?>

</td>

<td>

<a
href="eliminar_usuario.php?id=<?php echo $u['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('¿Está seguro de eliminar este usuario?')">

🗑 Eliminar

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
    <tr><th>Usuario</th><th>Email</th><th>Rol</th><th>Acción</th></tr>
    <?php while($u = $usuarios->fetch_assoc()): ?>
    <tr>
        <td><?php echo $u['username']; ?></td>
        <td><?php echo $u['email']; ?></td>
        <td><?php echo $u['rol']; ?></td>
        <td><a href="eliminar_usuario.php?id=<?php echo $u['id']; ?>" class="btn btn-danger">Eliminar</a></td>
    </tr>
    <?php endwhile; ?>
</table>
<div class="mb-4">
    <a href="dashboard.php" class="btn btn-secondary">← Volver al Panel de Administrador</a>
</div>