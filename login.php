<?php
session_start();
include 'conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Consulta SQL para obtener usuario y su rol
    $sql = "SELECT u.*, r.name as role_name FROM users u 
            JOIN roles r ON u.role_id = r.id WHERE u.email = '$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Comparamos usando trim() para quitar espacios accidentales en la BD
        if ($password == trim($user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role_name'];
            
            // Redirigir según el rol
            header("Location: dashboard.php");
            exit();
        } else {
            $mensaje = "Contraseña incorrecta.";
        }
    } else {
        $mensaje = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Restaurante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4 card p-4 shadow">
            <h2 class="text-center mb-4">Iniciar Sesión</h2>
            
            <?php if($mensaje != ""): ?>
                <div class='alert alert-danger'><?php echo $mensaje; ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="mb-3">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Contraseña:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>