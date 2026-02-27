<?php 
require "auth.php";
requireLogin();

$conexion = mysqli_connect("192.168.14.187", "cyberbuild", "Admin1234", "faltas");

if($conexion->connect_errno) {
    echo "No hay conexión : (" . $conexion->connect_error . ")";
    exit();
}

$dni = $_SESSION['user']['dni'];
$rol = $_SESSION['user']['rol'];
$dia = $_POST["dia"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Importante: Si 'hora' no existe en el form, le damos un valor vacío para que no de error
    $hora = isset($_POST["hora"]) ? $_POST["hora"] : "";
    $id_horario = isset($_POST["horario"]) ? $_POST["horario"] : null; 
    
    if (empty($id_horario)) {
        echo "<script>alert('Error: Debe seleccionar un horario válido');window.history.back();</script>";
        exit();
    }
    
    $carpetaDestino = "C:/xampp/htdocs/reto3/Imagenes/";

    // --- 1. PROCESAR JUSTIFICANTE ---
    $valorJustificanteBD = "Sin archivo adjunto";
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === 0) {
        $nombreLimpio = time() . "_just_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $_FILES['archivo']['name']);
        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $carpetaDestino . $nombreLimpio)) {
            $urlWeb = "http://192.168.14.187/reto3/Imagenes/" . $nombreLimpio;
            $valorJustificanteBD = "<a href='$urlWeb' target='_blank' style='color:blue; font-weight:bold;'>Ver Justificante</a>";
        }
    }

    // --- 2. PROCESAR TAREA (Aquí estaba el fallo) ---
    $valorTareaBD = "Sin tarea"; 
    // Comprobamos si el archivo 'tarea' ha llegado correctamente
    if (isset($_FILES['tarea']) && $_FILES['tarea']['error'] === 0) {
        $nombreTareaLimpio = time() . "_tarea_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $_FILES['tarea']['name']);
        if (move_uploaded_file($_FILES['tarea']['tmp_name'], $carpetaDestino . $nombreTareaLimpio)) {
            $urlWebTarea = "http://192.168.14.187/reto3/Imagenes/" . $nombreTareaLimpio;
            $valorTareaBD = "<a href='$urlWebTarea' target='_blank' style='color:blue; font-weight:bold;'>Ver Tarea</a>";
        }
    }

    $justificanteSeguro = mysqli_real_escape_string($conexion, $valorJustificanteBD);
    $tareaSegura = mysqli_real_escape_string($conexion, $valorTareaBD);

$queryregistrar = "INSERT INTO ausencia 
    (dia_a, tipo, justificante, hora_a, tarea, id_horario, dni_generador, estado, aceptar)
    VALUES ('$dia', '$rol', '$justificanteSeguro', '$hora', '$tareaSegura', '$id_horario', '$dni', 'pendiente', 'NO')";

    if(mysqli_query($conexion, $queryregistrar)) {
        echo "<script>alert('Falta registrada correctamente');window.location='main.php'</script>";
    } else {
        echo "Error en SQL: " . mysqli_error($conexion);
    }
}
?>