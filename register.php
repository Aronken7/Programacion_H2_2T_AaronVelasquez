<?php
session_start();
require 'db.php';

// Verifico si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verifico si el correo ya está en uso
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
        echo "El correo ya lo estan usando";
        } else {
        // Registro del nuevo usuario
        $stmt = $pdo->prepare("INSERT INTO users (username, email,
        password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        echo "Inicia sesion";
        }
        }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Registro</h1>
    <form method="POST">
        <input type="text" name="username" placeholder="Nombre de usuario" required>
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>