<?php
// Iniciar sesión solo si no está activa (evita warnings)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "auth.php";
require_once "funciones.php";

requireAdmin();
timeSesion();

$errores = [];

// Solo procesar si se accede por POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header('Location: crear_usuarios.php');
    exit;
}

// Campos requeridos
$required = ['dni','contrasena','rol','nombre','apellido','gmail','familia'];

// Guardar los datos enviados
$old = $_POST;
unset($old['contrasena']); // por seguridad

foreach ($required as $field) {
    if (empty($_POST[$field])) {
        $errores[] = "El campo $field es obligatorio";
    }
}

$dni       = trim($_POST["dni"]);
$contrasena = $_POST["contrasena"];
$rol       = trim($_POST["rol"]);
$nombre    = trim($_POST["nombre"]);
$ape       = trim($_POST["apellido"]);
$gmail     = trim($_POST["gmail"]);
$familia   = trim($_POST["familia"]);

// Validar rol esperado
$allowedRoles = ['user', 'admin'];
if (!in_array($rol, $allowedRoles, true)) {
    $errores[] = "Rol no válido";
}

// Validar DNI en mayúsculas
if ($dni !== strtoupper($dni)) {
    $errores[] = "El DNI debe estar en mayúsculas";
} elseif (!validarDNI($dni)) {
    $errores[] = "DNI no válido";
}

// Validar correo
if (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "Email no válido";
} else {
    $dominio = strtolower(substr(strrchr($gmail, "@"), 1)); // extrae dominio
    if ($dominio !== '') {
        if (preg_match("/@gmail\./i", $gmail)) {
            if ($dominio !== "gmail.com") {
                $errores[] = "Correo Gmail mal escrito. Debe ser @gmail.com";
            }
        } else {
            if (!checkdnsrr($dominio, "MX")) {
                $errores[] = "El dominio del correo no existe o no puede recibir emails";
            }
        }
    }
}

// Conexión a la base de datos
$conexion = mysqli_connect("localhost","cyberbuild","Admin1234","faltas");
if (!$conexion) {
    $errores[] = "No hay conexión a la base de datos";
} else {
    $conexion->set_charset('utf8mb4');

    // Comprobar duplicado DNI
    $sql = "SELECT 1 FROM usuario WHERE dni = '$dni' LIMIT 1";
    $res = $conexion->query($sql);
    if (!$res) {
        $errores[] = "Error en la consulta: " . $conexion->error;
    } else {
        if ($res->num_rows > 0) {
            $errores[] = "Este DNI ya está registrado";
        }
        $res->free();
    }
}

// Si hay errores, guardarlos y volver al formulario
if (!empty($errores)) {
    $_SESSION['errores'] = $errores;
    $_SESSION['old'] = $old;
    header("Location: crear_usuarios.php");
    exit;
}

// Guardar usuario
$pass_fuerte = password_hash($contrasena, PASSWORD_DEFAULT);
$sql = "INSERT INTO usuario (dni, contrasena, nombre, apellido, gmail, familia, rol) VALUES ('$dni', '$pass_fuerte', '$nombre', '$ape', '$gmail', '$familia', '$rol')";
if ($conexion->query($sql)) {
    $mensaje = json_encode("Usuario registrado: $nombre $ape");
    echo "<script>alert($mensaje);window.location='main.php'</script>";
} else {
    $errores[] = "Error al registrar usuario: " . $conexion->error;
    $_SESSION['errores'] = $errores;
    $_SESSION['old'] = $old;
    header("Location: crear_usuarios.php");
}

$conexion->close();
?>