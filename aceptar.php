<?php
require "auth.php";
requireLogin();
timeSesion();

$conexion = mysqli_connect("localhost","cyberbuild","Admin1234","faltas");

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

    $sql_update = "UPDATE ausencia SET aceptar = '$nuevo_estado', dni_usuario_cubridor = '" . $_SESSION['user']['dni'] . "' WHERE id_a = $id_a";
    if ($conexion->query($sql_update)) {
        echo "<script>alert('Gracias por cubrir esta ausencia. Puedes ver las guardias cubiertas anteriormente en Guardias Personales.');window.location='main.php'</script>";
    } else {
        echo "Error al actualizar el estado: " . $conexion->error;
    }
}
?> 