<?php 
require "auth.php";
requireLogin();

$conexion = mysqli_connect("192.168.14.187", "cyberbuild", "Admin1234", "faltas");

if($conexion->connect_errno) {
    echo "No hay conexión : (" . $conexion->connect_error . ")";
    exit();
}
$dni = $_SESSION['user']['dni'];

$m1 = $_POST['modulol1'];
$c1 = $_POST['clasel1'];

$m2 = $_POST['modulol2'];
$c2 = $_POST['clase2'];

$m3 = $_POST['modulol3'];
$c3 = $_POST['clase3'];

$m4 = $_POST['modulol4'];
$c4 = $_POST['clase4'];

$m5 = $_POST['modulol5'];
$c5 = $_POST['clase5'];

$m6 = $_POST['modulol6'];
$c6 = $_POST['clase6'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $queryregistrar = "INSERT INTO horario 
    (modulo, aula, id_hora, dni_usuario)
    VALUES 
    ('$m1', '$c1', 'L1', '$dni'),
    ('$m2', '$c2', 'L2', '$dni'),
    ('$m3', '$c3', 'L3', '$dni'),
    ('$m4', '$c4', 'L4', '$dni'),
    ('$m5', '$c5', 'L5', '$dni'),
    ('$m6', '$c6', 'L6', '$dni')";

    if(mysqli_query($conexion, $queryregistrar)) {
        echo "<script>alert('Horario implementado correctamente');window.location='main.php'</script>";
    } else {
        echo "Error en SQL: " . mysqli_error($conexion);
    }
}
