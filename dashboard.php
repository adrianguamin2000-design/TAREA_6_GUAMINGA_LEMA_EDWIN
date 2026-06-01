<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$rol = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Control - <?php echo $rol; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand">Panel de Control: <?php echo $rol; ?></span>
        <a href="logout.php" class="btn btn-outline-danger btn-sm">Cerrar Sesión</a>
    </div>
</nav>

<div class="container">
    
    <?php if ($rol == 'Administrator'): ?>
        <h2 class="mb-4">Opciones de Administrador</h2>
        <div class="row g-4">
            <div class="col-md-4"><div class="card h-100 shadow-sm border-primary"><div class="card-body"><h5 class="card-title text-primary">Gestión de Menú</h5><a href="admin_menu.php" class="btn btn-primary w-100">Acceder</a></div></div></div>
            <div class="col-md-4"><div class="card h-100 shadow-sm border-info"><div class="card-body"><h5 class="card-title text-info">Monitorear Pedidos</h5><a href="monitor_pedidos.php" class="btn btn-info w-100 text-white">Acceder</a></div></div></div>
            <div class="col-md-4"><div class="card h-100 shadow-sm border-warning"><div class="card-body"><h5 class="card-title text-warning">Gestionar Usuarios</h5><a href="gestionar_usuarios.php" class="btn btn-warning w-100">Acceder</a></div></div></div>
        </div>

    <?php elseif ($rol == 'Chef'): ?>
        <h2 class="mb-4">Opciones de Chef</h2>
        <div class="row">
            <div class="col-md-4"><div class="card shadow-sm border-success"><div class="card-body"><h5 class="card-title text-success">Gestionar Pedidos</h5><a href="chef_pedidos.php" class="btn btn-success w-100">Ver Estado</a></div></div></div>
        </div>

    <?php elseif ($rol == 'Waiter'): ?>
        <h2 class="mb-4">Opciones de Mesero</h2>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card shadow-sm border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Servir Pedidos</h5>
                        <a href="mesero_pedidos.php" class="btn btn-primary w-100">Entregar Pedidos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-success">
                    <div class="card-body">
                        <h5 class="card-title">Nuevo Pedido</h5>
                        <a href="nuevo_pedido_mesero.php" class="btn btn-success w-100">Atender Cliente</a>
                    </div>
                </div>
            </div>
        </div>

    <?php elseif ($rol == 'Client'): ?>
        <h2 class="mb-4">Opciones de Cliente</h2>
        <div class="row g-4">
            <div class="col-md-4"><div class="card shadow-sm border-primary"><div class="card-body"><h5 class="card-title">Ver Menú</h5><a href="menu_cliente.php" class="btn btn-primary w-100">Realizar Pedido</a></div></div></div>
            <div class="col-md-4"><div class="card shadow-sm border-info"><div class="card-body"><h5 class="card-title">Mis Pedidos</h5><a href="mis_pedidos.php" class="btn btn-info w-100 text-white">Ver Historial</a></div></div></div>
        </div>

    <?php else: ?>
        <div class="alert alert-warning">No tienes permisos configurados para este usuario. Contacta al administrador.</div>
    <?php endif; ?>
</div>

</body>
</html>