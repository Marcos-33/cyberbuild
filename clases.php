<?php

require "auth.php";
requireAdmin();

$conexion = mysqli_connect("192.168.14.187","cyberbuild","Admin1234","faltas");

if (!$conexion) {
    die("Conexion fallida: " . mysqli_connect_error());
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
    </header>
    <nav>
        <ul>
            <li class="pina"><a href="form_faltas.php">Solicitar ausencia</a></li>
            <li class="pina"><a href="main.php">Pagina Principal</a></li>
            <li class="pina"><a href="conexion.php">Conexion</a></li>
            <li class="pina"><a href="eliminar.php">Eliminar</a></li>
            <li class="pina"><a href="crear_usuarios.php">Crear usuarios</a></li>
        </ul>
    </nav>
    <main>
        <form action="procesar_clase.php" method="post">
            <div class="some">
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
                <input type="submit" value="Enviar">
            </div>
        </form>
    </main>
</body>
</html>