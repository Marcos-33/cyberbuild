<?php

require "auth.php";
requireLogin();
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
                onclick='return confirm(\"¿Eliminar usuario?\")'>Eliminar</a>
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
    </body>
</html>
