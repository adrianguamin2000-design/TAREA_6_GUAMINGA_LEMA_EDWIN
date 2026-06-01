<?php
include 'conexion.php';
$id = $_GET['id'];
$resultado = $conn->query("SELECT * FROM dishes WHERE id = $id");
$plato = $resultado->fetch_assoc();
?>
<form action="update_plato.php" method="POST" class="container mt-4">
    <input type="hidden" name="id" value="<?php echo $plato['id']; ?>">
    <input type="text" name="nombre" value="<?php echo $plato['name']; ?>" class="form-control mb-2" required>
    <input type="text" name="descripcion" value="<?php echo $plato['description']; ?>" class="form-control mb-2">
    <input type="number" step="0.01" name="precio" value="<?php echo $plato['price']; ?>" class="form-control mb-2" required>
    <button type="submit" class="btn btn-success">Guardar Cambios</button>
</form>
<div class="container mt-4">
    <div class="mb-4">
        <a href="admin_menu.php" class="btn btn-secondary">← Volver al Menú</a>
    </div>
    <h2>Editar Plato</h2>
    </div>