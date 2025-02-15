<?php
session_start();
require 'db.php';
// Verifico si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Agrego una nueva tarea si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("INSERT INTO tasks (user_id, title) VALUES (?, ?)");
    $stmt->execute([$_SESSION['user_id'], $_POST['task']]);
}

// Obtengo las tareas del usuario
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$tasks = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tareas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Tareas</h1>
    <form method="POST">
        <input type="text" name="task" placeholder="Nueva tarea" required>
        <button type="submit">Agregar una tarea</button>
    </form>
    <h2>Tareas pendientes:</h2>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li><?php echo htmlspecialchars($task['title']); ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>