<?php
session_start();
include 'conexion.php';

if ($_SESSION['role'] !== 'Waiter') die("Acceso denegado");

// Procesar el pedido
if (isset($_POST['pedir_por_cliente'])) {
    $cliente_id = $_POST['user_id'];
    $plato_id = $_POST['dish_id'];

    $conn->query("INSERT INTO orders (user_id, dish_id, quantity, status) 
                  VALUES ($cliente_id, $plato_id, 1, 'Pendiente')");

    $mensaje = "Pedido registrado con éxito para el cliente.";
}

// Datos
$clientes = $conn->query("SELECT id, username FROM users WHERE role_id = 4");
$platos   = $conn->query("SELECT id, name FROM dishes");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registrar Pedido</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background: #f4f6f9;
    }

    .card-custom {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .header-title {
        font-weight: 700;
        color: #2c3e50;
    }

    .form-label {
        font-weight: 600;
    }
</style>

</head>

<body>

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card card-custom p-4">

                <div class="text-center mb-4">
                    <h2 class="header-title">🍽 Registrar Pedido</h2>
                    <p class="text-muted">Mesero - Asignación de pedidos a clientes</p>
                </div>

                <?php if(isset($mensaje)): ?>
                    <div class="alert alert-success text-center">
                        <?= $mensaje ?>
                    </div>
                <?php endif; ?>

                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label">Seleccionar Cliente</label>
                        <select name="user_id" class="form-select" required>
                            <option value="">-- Elige un cliente --</option>
                            <?php while($c = $clientes->fetch_assoc()): ?>
                                <option value="<?= $c['id'] ?>">
                                    <?= $c['username'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Seleccionar Plato</label>
                        <select name="dish_id" class="form-select" required>
                            <option value="">-- Elige un plato --</option>
                            <?php while($p = $platos->fetch_assoc()): ?>
                                <option value="<?= $p['id'] ?>">
                                    <?= $p['name'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" name="pedir_por_cliente" class="btn btn-primary btn-lg">
                            Registrar Pedido
                        </button>

                        <a href="mesero_pedidos.php" class="btn btn-outline-secondary">
                            Volver a la lista
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>

</div>

</body>
</html>