<?php
require "auth.php";
requireLogin();

$conexion = mysqli_connect("192.168.14.187","cyberbuild","Admin1234","faltas");

if (!$conexion) {
    die("Conexion fallida: " . mysqli_connect_error());
}   

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id_a = $_POST["id_a"];
    $accion = $_POST["accion"];

    if ($accion === "aceptar") {
        $nuevo_estado = "SI";
    } else {
        die("Acción no válida.");
    }

    $sql_update = "UPDATE ausencia SET aceptar = ?, dni_usuario_cubridor = ? WHERE id_a = ?";
    $stmt_update = $conexion->prepare($sql_update);
    $stmt_update->bind_param("ssi", $nuevo_estado, $_SESSION['user']['dni'], $id_a);

    if ($stmt_update->execute()) {
        header("Location: main.php");
        exit();
    } else {
        echo "Error al actualizar el estado: " . $conexion->error;
    }
}
?> 