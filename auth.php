<?php 
session_start();
$conexion = mysqli_connect("192.168.14.187", "cyberbuild", "Admin1234", "faltas");

// Cualquier usuario logueado
function requireLogin() { 
    if (!isset($_SESSION["user"]) || !is_array($_SESSION["user"])) {
        header("Location: index.html");
        exit;
    }
}

// Solo admins
function requireAdmin() {
    // combrueba que este logueado
    if (!isset($_SESSION["user"]) || !is_array($_SESSION["user"])) {
        header("Location: main.php");
        exit;
    }
 
    // 2. Comprueba su rol, entonces si las dos son correctas te deja entrar, si no, no
    if ($_SESSION["user"]["rol"] !== "admin") { 
        http_response_code(403);
        die("Acceso denegado: No tienes los permisos necesarios");
    }
}
