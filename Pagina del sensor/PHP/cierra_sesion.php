<?php
//ni siquiera he hecho esto para son de cafe pero
//al parecer es mucho mas sensillo

// Inicia sesión
session_start();

// Destruye la sesión
session_destroy();

// Redirige al inicio de sesion
header('Location: inicio_sesion.php');
exit();
?>
