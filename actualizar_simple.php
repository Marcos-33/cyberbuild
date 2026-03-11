<?php

$conn = new mysqli("localhost", "cyberbuild", "Admin1234", "faltas");

$dni = $_POST['dni'] ?? '';
$gmail = $_POST['gmail'] ?? '';
$nueva_password = $_POST['cont'] ?? '';

// Verificamos que exista el usuario con ese DNI y correo
$sql = "SELECT * FROM usuario WHERE dni='$dni' AND gmail='$gmail'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {

    $pass_fuerte = password_hash($nueva_password, PASSWORD_DEFAULT);

    // Actualizamos contraseña
    $sql2 = "UPDATE usuario SET contrasena='$pass_fuerte' WHERE dni='$dni' AND gmail='$gmail'";
    if ($conn->query($sql2)) {
        echo "✅ Contraseña actualizada correctamente.";
    }
}
else {
    echo "❌ DNI o correo incorrectos.";
}

$conn->close();

?>