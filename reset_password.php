<?php
$conexion = mysqli_connect("localhost","cyberbuild","Admin1234","faltas");
if (!$conexion) {
    die("No se pudo conectar a la base de datos: " . mysqli_connect_error());
}

// mostrar formulario o procesar actualización
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['token'])) {
    $token = $_GET['token'];
    $sql    = "SELECT dni, expires_at FROM password_resets WHERE token = '$token'";
    $result = $conexion->query($sql);
    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (strtotime($row['expires_at']) > time()) {
            // mostrar formulario de nueva contraseña
            ?>
            <!DOCTYPE html>
            <html lang="es">
            <head><meta charset="utf-8"><title>Restablecer contraseña</title></head>
            <body>
            <form method="POST" action="reset_password.php">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                <input type="password" name="contrasena" placeholder="Nueva contraseña" required>
                <button type="submit">Cambiar contraseña</button>
            </form>
            </body>
            </html>
            <?php
            exit;
        } else {
            echo "El enlace ha caducado.";
            exit;
        }
    } else {
        echo "Token inválido.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['token'], $_POST['contrasena'])) {
    $token = $_POST['token'];
    $newpass = $_POST['contrasena'];

    $sql    = "SELECT dni, expires_at FROM password_resets WHERE token = '$token'";
    $result = $conexion->query($sql);
    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (strtotime($row['expires_at']) > time()) {
            $dni = $row['dni'];
            $hash = password_hash($newpass, PASSWORD_DEFAULT);
            $sql2 = "UPDATE usuario SET contrasena = '$hash' WHERE dni = '$dni'";
            $conexion->query($sql2);
            // invalidar token
            $sqlDel = "DELETE FROM password_resets WHERE token = '$token'";
            $conexion->query($sqlDel);
            echo "✅ Contraseña actualizada correctamente.";
            exit;
        } else {
            echo "El enlace ha caducado.";
            exit;
        }
    }
    echo "Token inválido.";
}
?>