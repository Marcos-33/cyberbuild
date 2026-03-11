<?php

require "auth.php";
requireAdmin();
timeSesion();

$conexion = mysqli_connect("localhost","cyberbuild","Admin1234","faltas");

if (!$conexion) {
    die("Conexion fallida: " . mysqli_connect_error());
}   

?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuarios</title>
    <link rel="stylesheet" href="css.css">
    <link rel="icon" href="media/logo.PNG">
</head> 
<body>
    <header>
        <h1>Eliminar Usuarios</h1>
        <a href="main.php">
        <img id="cpifp" src="media/logo_cpifp.png">
        </a>
    </header>
        <?php include "navpriv.php"; ?>
    </nav>
    <main>
        <h2>Listado de usuarios</h2>

        <table>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Familia</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        <?php
        // Obtenemos todos los usuarios de la base de datos
        $resultado = $conexion->query("SELECT * FROM usuario");

        // Recorremos cada usuario
        if ($resultado->num_rows > 1) {
        while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>
            <td>{$fila['dni']}</td>
            <td>{$fila['nombre']}</td>
            <td>{$fila['apellido']}</td>
            <td>{$fila['gmail']}</td>
            <td>{$fila['familia']}</td>
            <td>{$fila['rol']}</td>
            <td>
                <a href='?eliminar={$fila['dni']}'
                onclick='return confirm(\"¿Eliminar usuario?\")' id='black'>Eliminar</a>
            </td>
        </tr>";
        }
        }
        else {
            echo '<tr><td colspan="7">No hay datos disponibles</td></tr>';
            // En caso contrario, muestra mensaje de no hay datos disponible
            }
        ?>
            <?php
                if (isset($_GET['eliminar'])) {
                    $dni = $_GET['eliminar'];

                    // Eliminamos el usuario con ese DNI
                    $conexion->query("DELETE FROM usuario WHERE dni='$dni'");

                    // Redirigimos para evitar que se repita al recargar
                    header("Location: admin_panel.php"); 
                    exit;
                        }
                        
                ?>
        </table>
    </main>
    <footer>
        <p>&copy; 2008 Página web desarrollada por Cyberbuild</p>
    </footer>
    </body>
</html>
