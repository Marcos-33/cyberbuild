<?php

require "auth.php";
requireLogin();
timeSesion();

$conexion = mysqli_connect("localhost","cyberbuild","Admin1234","faltas");

if (!$conexion) {
    die("Conexion fallida: " . mysqli_connect_error());
}   

$dni = $_SESSION['user']['dni'];

if($dni = $conexion->query("SELECT dni_usuario FROM horario WHERE dni_usuario = '$dni'")){
    if($dni->num_rows > 0){
        echo "<script>alert('Ya has registrado tu horario');window.location='main.php'</script>";
    }
}

if($conexion->connect_error) {
    echo "No hay conexión : (" . $conexion->connect_error . ")";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
    <link rel="stylesheet" href="css.css">
    <link rel="icon" href="media/logo.PNG">
</head> 
<body>
    <header>
        <h1>Cyberbuild</h1>
        <a href="main.php">
        <img id="cpifp" src="media/logo_cpifp.png">
        </a>
    </header>
        <?php include "navpub.php"; ?>
    <main>
        <p>No tienes que escribir el nombre de la clase si tienes guardia a esa hora.</p>
        <p>Este formulario solo se enviara una vez al principio del trimestre, si ha ocurrido algún error, pongase en contacto con un administrador</p>
        <form action="procesar_clase.php" method="post">
            <!-- Estoy seguro que hay una forma mejor de hacer esto, pero no se como hacerlo. Disculpen mi incompetencia. -DRR -->
            <div class="some">
                <h2>Lunes</h2>

                <label name="L1">1º Hora</label><br>
                <input type="text" name="modulol1" required placeholder="Modulo"><br>
                <input type="text" name="clasel1" placeholder="Clase"><br>

                <label name="L2">2º Hora</label><br>
                <input type="text" name="modulol2" required placeholder="Modulo"><br>
                <input type="text" name="clasel2" placeholder="Clase"><br>

                <label name="L3">3º Hora</label><br>
                <input type="text" name="modulol3" required placeholder="Modulo"><br>
                <input type="text" name="clasel3" placeholder="Clase"><br>

                <label name="L4">4º Hora</label><br>
                <input type="text" name="modulol4" required placeholder="Modulo"><br>
                <input type="text" name="clasel4" placeholder="Clase"><br>

                <label name="L5">5º Hora</label><br>
                <input type="text" name="modulol5" required placeholder="Modulo"><br>
                <input type="text" name="clasel5" placeholder="Clase"><br>

                <label name="L6">6º Hora</label><br>
                <input type="text" name="modulol6" required placeholder="Modulo"><br>
                <input type="text" name="clasel6" placeholder="Clase"><br>
            </div>
            <div class="some">
                <h2>Martes</h2>

                <label name="M1">1º Hora</label><br>
                <input type="text" name="modulom1" required placeholder="Modulo"><br>
                <input type="text" name="clasem1" placeholder="Clase"><br>

                <label name="M2">2º Hora</label><br>
                <input type="text" name="modulom2" required placeholder="Modulo"><br>
                <input type="text" name="clasem2" placeholder="Clase"><br>

                <label name="M3">3º Hora</label><br>
                <input type="text" name="modulom3" required placeholder="Modulo"><br>
                <input type="text" name="clasem3" placeholder="Clase"><br>

                <label name="M4">4º Hora</label><br>
                <input type="text" name="modulom4" required placeholder="Modulo"><br>
                <input type="text" name="clasem4" placeholder="Clase"><br>

                <label name="M5">5º Hora</label><br>
                <input type="text" name="modulom5" required placeholder="Modulo"><br>
                <input type="text" name="clasem5" placeholder="Clase"><br>

                <label name="M6">6º Hora</label><br>
                <input type="text" name="modulom6" required placeholder="Modulo"><br>
                <input type="text" name="clasem6" placeholder="Clase"><br>
            </div>
            <div class="some">
                <h2>Miercoles</h2>

                <label name="X1">1º Hora</label><br>
                <input type="text" name="modulox1" required placeholder="Modulo"><br>
                <input type="text" name="clasex1" placeholder="Clase"><br>

                <label name="X2">2º Hora</label><br>
                <input type="text" name="modulox2" required placeholder="Modulo"><br>
                <input type="text" name="clasex2" placeholder="Clase"><br>
                
                <label name="X3">3º Hora</label><br>
                <input type="text" name="modulox3" required placeholder="Modulo"><br>
                <input type="text" name="clasex3" placeholder="Clase"><br>

                <label name="X4">4º Hora</label><br>
                <input type="text" name="modulox4" required placeholder="Modulo"><br>
                <input type="text" name="clasex4" placeholder="Clase"><br>

                <label name="X5">5º Hora</label><br>
                <input type="text" name="modulox5" required placeholder="Modulo"><br>
                <input type="text" name="clasex5" placeholder="Clase"><br>

                <label name="X6">6º Hora</label><br>
                <input type="text" name="modulox6" required placeholder="Modulo"><br>
                <input type="text" name="clasex6" placeholder="Clase"><br>
            </div>
            <div class="some"> 
                <h2>Jueves</h2>

                <label name="J1">1º Hora</label><br>
                <input type="text" name="moduloj1" required placeholder="Modulo"><br>
                <input type="text" name="clasej1" placeholder="Clase"><br>

                <label name="J2">2º Hora</label><br>
                <input type="text" name="moduloj2" required placeholder="Modulo"><br>
                <input type="text" name="clasej2" placeholder="Clase"><br>

                <label name="J3">3º Hora</label><br>
                <input type="text" name="moduloj3" required placeholder="Modulo"><br>
                <input type="text" name="clasej3" placeholder="Clase"><br>

                <label name="J4">4º Hora</label><br>
                <input type="text" name="moduloj4" required placeholder="Modulo"><br>
                <input type="text" name="clasej4" placeholder="Clase"><br>

                <label name="J5">5º Hora</label><br>
                <input type="text" name="moduloj5" required placeholder="Modulo"><br>
                <input type="text" name="clasej5" placeholder="Clase"><br>

                <label name="J6">6º Hora</label><br>
                <input type="text" name="moduloj6" required placeholder="Modulo"><br>
                <input type="text" name="clasej6" placeholder="Clase"><br>
            </div>
            <div class="some">
                <h2>Viernes</h2>
                <label name="V1">1º Hora</label><br>
                <input type="text" name="modulov1" required placeholder="Modulo"><br>
                <input type="text" name="clasev1" placeholder="Clase"><br>

                <label name="V2">2º Hora</label><br>
                <input type="text" name="modulov2" required placeholder="Modulo"><br>
                <input type="text" name="clasev2" placeholder="Clase"><br>

                <label name="V3">3º Hora</label><br>
                <input type="text" name="modulov3" required placeholder="Modulo"><br>
                <input type="text" name="clasev3" placeholder="Clase"><br>

                <label name="V4">4º Hora</label><br>
                <input type="text" name="modulov4" required placeholder="Modulo"><br>
                <input type="text" name="clasev4" placeholder="Clase"><br>

                <label name="V5">5º Hora</label><br>
                <input type="text" name="modulov5" required placeholder="Modulo"><br>
                <input type="text" name="clasev5" placeholder="Clase"><br>
                
                <label name="V6">6º Hora</label><br>
                <input type="text" name="modulov6" required placeholder="Modulo"><br>
                <input type="text" name="clasev6" placeholder="Clase"><br>
            </div>
            <br>
            <input type="submit" value="Enviar" id="boton">
        </form>
    </main>
</body>
</html>