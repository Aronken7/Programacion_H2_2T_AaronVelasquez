<?php
// Empiezo la sesión para poder usar las variables de sesión
session_start();
// Cierro la sesión actual para que el usuario se desconecte
session_destroy();
// Llevo al usuario de vuelta a la página principal
header("Location: index.php");
// Detengo el script para que no se ejecute nada más
exit();
?>