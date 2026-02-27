<?php
require "auth.php";
requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample HTML Page</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <h1>Solicitar ausencia</h1>
    <ul>
        <li class="pina"><a href="main.php">Volver al inicio</a></li>
        <li class="pina"><a href="listaphp.php">Lista profesores</a></li>
        <li class="pina"><a href="conexion.php">Conexion</a></li>
    </ul>
    <form class= "Falta" action="formulario.php" method="POST">
        <label for="dni">DNI</label><br>
        <input type="text" id="dni" name="dni" value=""><br>
        <label for="nombre">Nombre</label><br>
        <input type="text" id="nombre" name="nombre" value=""><br>
        <label for="modulo">Modulo</label><br>
        <input type="text" id="modulo" name="modulo"><br><br>
        <label for="hora">Elige hora</label>
        <select id="hora" name="hora"><br>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select><br><br>
         <label for="archivo">Subir Archivo/Justificante</label>
         <input type="file" id="archivo" name="archivo"><br><br>
        <input type="submit" value="Enviar falta">
    </form>
</body>
</html>