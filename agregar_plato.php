
<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Nuevo Plato</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-8">

<div class="card shadow-lg border-0">

<div class="card-header bg-success text-white">

<h2 class="mb-0">🍽 Registrar Nuevo Plato</h2>

</div>

<div class="card-body">

<form action="guardar_plato.php" method="POST">

<div class="mb-3">

<label class="form-label">

Nombre del Plato

</label>

<input
type="text"
name="nombre"
class="form-control"
placeholder="Ej: Arroz con Pollo"
required>

</div>

<div class="mb-3">

<label class="form-label">

Descripción

</label>

<textarea
name="descripcion"
class="form-control"
rows="3"
placeholder="Ingrese una descripción del plato"></textarea>

</div>

<div class="mb-3">

<label class="form-label">

Precio ($)

</label>

<input
type="number"
step="0.01"
name="precio"
class="form-control"
placeholder="Ej: 12.50"
required>

</div>

<div class="text-center">

<button
type="submit"
class="btn btn-success">

💾 Guardar Plato

</button>

<a
href="dashboard.php"
class="btn btn-secondary">

⬅ Volver

</a>

</div>

</form>

</div>

<div class="card-footer text-center text-muted">

Sistema de Gestión de Restaurante

</div>

</div>

</div>

</div>

</div>

</body>

</html>