<?php 
require "auth.php";
requireLogin();
timeSesion();

$conexion = mysqli_connect("localhost", "cyberbuild", "Admin1234", "faltas");

if($conexion->connect_errno) {
    echo "No hay conexión : (" . $conexion->connect_error . ")";
    exit();
}
$dni = $_SESSION['user']['dni'];
// LUNES
$ml1 = $_POST['modulol1'];
$cl1 = $_POST['clasel1'];

$ml2 = $_POST['modulol2'];
$cl2 = $_POST['clasel2'];

$ml3 = $_POST['modulol3'];
$cl3 = $_POST['clasel3'];

$ml4 = $_POST['modulol4'];
$cl4 = $_POST['clasel4'];

$ml5 = $_POST['modulol5'];
$cl5 = $_POST['clasel5'];

$ml6 = $_POST['modulol6'];
$cl6 = $_POST['clasel6'];
// MARTES
$mm1 = $_POST['modulom1'];
$cm1 = $_POST['clasem1'];

$mm2 = $_POST['modulom2'];
$cm2 = $_POST['clasem2'];

$mm3 = $_POST['modulom3'];
$cm3 = $_POST['clasem3'];

$mm4 = $_POST['modulom4'];
$cm4 = $_POST['clasem4'];

$mm5 = $_POST['modulom5'];
$cm5 = $_POST['clasem5'];

$mm6 = $_POST['modulom6'];
$cm6 = $_POST['clasem6'];
// MIERCOLES 
$mx1 = $_POST['modulox1'];
$cx1 = $_POST['clasex1'];

$mx2 = $_POST['modulox2'];
$cx2 = $_POST['clasex2'];

$mx3 = $_POST['modulox3'];
$cx3 = $_POST['clasex3'];

$mx4 = $_POST['modulox4'];
$cx4 = $_POST['clasex4'];

$mx5 = $_POST['modulox5'];
$cx5 = $_POST['clasex5'];

$mx6 = $_POST['modulox6'];
$cx6 = $_POST['clasex6'];
// JUEVES
$mj1 = $_POST['moduloj1'];
$cj1 = $_POST['clasej1'];

$mj2 = $_POST['moduloj2'];
$cj2 = $_POST['clasej2'];

$mj3 = $_POST['moduloj3'];
$cj3 = $_POST['clasej3'];

$mj4 = $_POST['moduloj4'];
$cj4 = $_POST['clasej4'];

$mj5 = $_POST['moduloj5'];
$cj5 = $_POST['clasej5'];

$mj6 = $_POST['moduloj6'];
$cj6 = $_POST['clasej6'];
// VIERNES
$mv1 = $_POST['modulov1'];
$cv1 = $_POST['clasev1'];

$mv2 = $_POST['modulov2'];
$cv2 = $_POST['clasev2'];

$mv3 = $_POST['modulov3'];
$cv3 = $_POST['clasev3'];

$mv4 = $_POST['modulov4'];
$cv4 = $_POST['clasev4'];

$mv5 = $_POST['modulov5'];
$cv5 = $_POST['clasev5'];

$mv6 = $_POST['modulov6'];
$cv6 = $_POST['clasev6'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $queryregistrar = "INSERT INTO horario 
    (modulo, aula, id_hora, dni_usuario)
    VALUES 
        /*VALORES DE LUNES*/
    ('$ml1', '$cl1', 'L1', '$dni'),
    ('$ml2', '$cl2', 'L2', '$dni'),
    ('$ml3', '$cl3', 'L3', '$dni'),
    ('$ml4', '$cl4', 'L4', '$dni'),
    ('$ml5', '$cl5', 'L5', '$dni'),
    ('$ml6', '$cl6', 'L6', '$dni'),
        /*VALORES DE MARTES*/
    ('$mm1', '$cm1', 'M1', '$dni'),
    ('$mm2', '$cm2', 'M2', '$dni'),
    ('$mm3', '$cm3', 'M3', '$dni'),
    ('$mm4', '$cm4', 'M4', '$dni'),
    ('$mm5', '$cm5', 'M5', '$dni'),
    ('$mm6', '$cm6', 'M6', '$dni'),
        /*VALORES DE MIERCOLES*/
    ('$mx1', '$cx1', 'X1', '$dni'),
    ('$mx2', '$cx2', 'X2', '$dni'),
    ('$mx3', '$cx3', 'X3', '$dni'),
    ('$mx4', '$cx4', 'X4', '$dni'),
    ('$mx5', '$cx5', 'X5', '$dni'),
    ('$mx6', '$cx6', 'X6', '$dni'),
        /*VALORES DE JUEVES*/
    ('$mj1', '$cj1', 'J1', '$dni'),
    ('$mj2', '$cj2', 'J2', '$dni'),
    ('$mj3', '$cj3', 'J3', '$dni'),
    ('$mj4', '$cj4', 'J4', '$dni'),
    ('$mj5', '$cj5', 'J5', '$dni'),
    ('$mj6', '$cj6', 'J6', '$dni'),
        /*VALORES DE VIERNES*/
    ('$mv1', '$cv1', 'V1', '$dni'),
    ('$mv2', '$cv2', 'V2', '$dni'),
    ('$mv3', '$cv3', 'V3', '$dni'),
    ('$mv4', '$cv4', 'V4', '$dni'),
    ('$mv5', '$cv5', 'V5', '$dni'),
    ('$mv6', '$cv6', 'V6', '$dni')
";

    if(mysqli_query($conexion, $queryregistrar)) {
        echo "<script>alert('Horario implementado correctamente');window.location='main.php'</script>";
    } else {
        echo "Error en SQL: " . mysqli_error($conexion);
    }
}