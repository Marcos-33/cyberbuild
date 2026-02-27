<?php
require "auth.php";
requireAdmin();
?>

<!DOCTYPE html> 
<htlm>
    <head>
        <title>Crear usuarios</title>
        <link rel="stylesheet" href="css.css">
        <meta charset="UTF-8">
        <link rel="icon" href="media/logo.png">
    </head>
    <body>
        <header>
            <h1>Crear usuarios</h1>
        </header>      
        <form action="crear.php" method="POST"> 
            <input type="text" name="nombre" placeholder="Nombre" class="write" required>
            <br>
            <input type="text" name="apellido" placeholder="Apellidos" class="write" required>
            <br>
            <input type="text" name="gmail" placeholder="Correo Electronico" class="write" required>
            <br>
            <input type="text" name="dni" placeholder="DNI" class="write" required>
            <br>
            <input type="text" name="familia" placeholder="Familia" class="write" required>
            <br>
            <!-- <input type="text" name="rol" placeholder="Rol" class="write" required> -->
            <select class="write" name="rol" required>
                <option value="user">Usuario</option>
                <option value="admin">Admin</option>
            <br>
            <input type="password" name="contrasena" placeholder="Contraseña" class="write" required>
            <br>
            <input type="submit" value="Enviar" class="send">
        </form>
        <footer>
            <p>&copy; 2008 Página web desarrollada por Cyberbuild</p>
        </footer>
    </body>
</htlm>