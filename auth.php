<?php
// Evitar warning si ya se inició la sesión antes
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$conexion = mysqli_connect("localhost", "cyberbuild", "Admin1234", "faltas");

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

// Controla el tiempo de sesión para evitar sesiones expuestas
function timeSesion(int $timeoutSeconds = 1800) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeoutSeconds) {
        session_unset();
        session_destroy();
        header('Location: index.html');
        exit;
    }

    $_SESSION['LAST_ACTIVITY'] = time();
}

