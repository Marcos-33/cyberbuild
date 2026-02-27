<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a la base de datos
$conexion = new mysqli("192.168.14.187", "cyberbuild", "Admin1234", "faltas");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$dni_usuario = $_POST['dni'];
$nombre = $_POST['nombre'];
$modulo = $_POST['modulo'];  

// Manejo del archivo subido 
$archivo = '';
if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
    $archivo = basename($_FILES['archivo']['name']);
    $ruta_destino = 'uploads/' . $archivo;  
    move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta_destino);
}

// Definir la hora actual como timestamp
$hora = time();
$dia = (int)date('d');

// Verificar si el usuario existe
$checkUsuario = $conexion->prepare("SELECT dni FROM usuario WHERE dni = ?");
$checkUsuario->bind_param("s", $dni_usuario);
$checkUsuario->execute();
$checkUsuario->store_result();

// Obtener id_horario de la tabla horario
$checkHorario = $conexion->prepare("SELECT id_horario FROM horario WHERE modulo = ?");
$checkHorario->bind_param("s", $modulo);
$checkHorario->execute();
$checkHorario->bind_result($id_horario);
$checkHorario->fetch();
$checkHorario->close();

if (!$id_horario) {
    // Insertar horario si no existe

    // Obtener el id_horario recién insertado
    $checkHorario = $conexion->prepare("SELECT id_horario FROM horario WHERE modulo = ?");
    $checkHorario->bind_param("s", $modulo);
    $checkHorario->execute();
    $checkHorario->bind_result($id_horario);
    $checkHorario->fetch();
    $checkHorario->close();
}

// Obtener id_horario de la tabla horario
$checkHorario = $conexion->prepare("SELECT id_horario FROM horario WHERE modulo = ?");
$checkHorario->bind_param("s", $modulo);
$checkHorario->execute();
$checkHorario->bind_result($id_horario);
$checkHorario->fetch();
$checkHorario->close();

if (!$id_horario) {
    // Insertar horario si no existe

    // Obtener el id_horario recién insertado
    $checkHorario = $conexion->prepare("SELECT id_horario FROM horario WHERE modulo = ?");
    $checkHorario->bind_param("s", $modulo);
    $checkHorario->execute();
    $checkHorario->bind_result($id_horario);
    $checkHorario->fetch();
    $checkHorario->close();
}

// Insertar en la tabla 'ausencia'
$stmtAusencia = $conexion->prepare("
    INSERT INTO ausencia (dia_a, tipo, justificante, hora_a, dni_usuario_cubridor, id_horario) 
    VALUES (?, ?, ?, ?, ?, ?)
");
$stmtAusencia->bind_param("issiii", $dia, $modulo, $archivo, $hora, $dni_usuario, $id_horario);

if (!$stmtAusencia->execute()) {
    echo "Gracias por enviar tu falta, por favor, espera a que un administrador la revise.";
} else {
    echo "¡Ausencia registrada correctamente!";
}

$stmtAusencia->close();
$conexion->close();
?>