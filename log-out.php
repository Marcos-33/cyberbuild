<?php
session_start();

// Vaciar variables de sesión
$_SESSION = [];

// Borrar la sesión 
session_destroy();
// Redirigir al login 
header("Location: index.html");
exit; 