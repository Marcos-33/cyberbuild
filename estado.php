<?php
$conexion = mysqli_connect("192.168.14.187","cyberbuild","Admin1234","faltas");
// Establecemos conexion con la base de datos.

if (!$conexion) {
    die("Conexion fallida: " . mysqli_connect_error());
}   
// Si la conexion falla muestra un mensaje de error.

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_a = $_POST["id_a"];
    $accion = $_POST["accion"];
    // Cogemos el id de la ausencia y la accion a realizar (aceptar o rechazar).

    if ($accion === "aceptar") {
        $nuevo_estado = "Aceptada";
    // Si el valor de la accion es aceptar, el nuevo estado sera Aceptada.

    } elseif ($accion === "rechazar") {
        $nuevo_estado = "Rechazada"; 
    // Si el valor de la accion es rechazar, el nuevo estado sera Rechazada.

    } else {
        die("Acción no válida.");
    }
    // Si el valor de la accion no es ni aceptar ni rechazar, muestra un mensaje de error.
    
    $sql_update = "UPDATE ausencia SET estado = ? WHERE id_a = ?";
    // Hacemos una consulta SQL para actualizar el 'estado' en el 'id_a' correspondiente en la tabla 'ausencia'.
    $stmt_update = $conexion->prepare($sql_update);
    // Preparamos una consulta SQL
    $stmt_update->bind_param("si", $nuevo_estado, $id_a);
    // Vinculamos los parámetros a la consulta preparada. 

    if ($stmt_update->execute()) {
        header("Location: admin_panel.php");
        exit();
    // Si la consulta se ejecuta correctamente, redirige a 'admin_panel.php'
    } else {
        echo "Error al actualizar el estado: " . $conexion->error;
    }
}
?> 