<?php

$conn = new mysqli("192.168.14.187", "cyberbuild", "Admin1234", "faltas");

$dni = $_POST['dni'] ?? '';
$gmail = $_POST['gmail'] ?? '';
$nueva_password = $_POST['cont'] ?? '';

// Verificamos que exista el usuario con ese DNI y correo
$stmt = $conn->prepare("SELECT * FROM usuario WHERE dni=? AND gmail=?");
$stmt->bind_param("ss", $dni, $gmail);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){

$pass_fuerte = password_hash($nueva_password, PASSWORD_DEFAULT);

// Actualizamos contraseña
$update = $conn->prepare("UPDATE usuario SET contrasena=? WHERE dni=? AND gmail=?");
$update->bind_param("sss", $pass_fuerte, $dni, $gmail);
$update->execute();
echo "✅ Contraseña actualizada correctamente.";
}
else {
    echo "❌ DNI o correo incorrectos.";
}

$conn->close();

?>