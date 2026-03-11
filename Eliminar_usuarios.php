<?php
$conexion = mysqli_connect("localhost","cyberbuild","Admin1234","faltas");
// Establece conexion
if (!$conexion) {
    die("Conexion fallida: " . mysqli_connect_error());
}   
// Recibe el ID del usuario a eliminar 
$dni_usuario = $_GET['dni']; 
$sql = "DELETE FROM usuario WHERE dni = $dni_usuario";
$elimina = $conexion->query($sql);
header("Location: admin_panel.php"); 
$conexion->close(); 
?> 