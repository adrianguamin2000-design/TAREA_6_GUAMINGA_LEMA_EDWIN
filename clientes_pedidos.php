<?php
session_start();
include 'conexion.php';
if ($_SESSION['role'] !== 'Client') die("Solo para clientes");

// Procesar nuevo pedido
if (isset($_POST['hacer_pedido'])) {
    $dish_id = $_POST['dish_id'];
    $user_id = $_SESSION['user_id'];
    $conn->query("INSERT INTO orders (user_id, dish_id, quantity, status) VALUES ($user_id, $dish_id, 1, 'Pending')");
}

$menu = $conn->query("SELECT * FROM dishes");
$mis_pedidos = $conn->query("SELECT o.*, d.name as plato, o.status FROM orders o JOIN dishes d ON o.dish_id = d.id WHERE o.user_id = " . $_SESSION['user_id']);
?>

<h3>Menú del Restaurante</h3>
<?php while($d = $menu->fetch_assoc()): ?>
    <form method="POST">
        <input type="hidden" name="dish_id" value="<?php echo $d['id']; ?>">
        <?php echo $d['name']; ?> - $<?php echo $d['price']; ?>
        <button type="submit" name="hacer_pedido">Pedir</button>
    </form>
<?php endwhile; ?>

<h3>Mis Pedidos</h3>
<ul>
    <?php while($p = $mis_pedidos->fetch_assoc()): ?>
        <li><?php echo $p['plato']; ?> - <b>Estado: <?php echo $p['status']; ?></b></li>
    <?php endwhile; ?>
</ul>