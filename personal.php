<?php

require "auth.php";
requireLogin();


$conexion = mysqli_connect("192.168.14.187","cyberbuild","Admin1234","faltas");
// Establecemos conexion con la base de datos.

if (!$conexion) {
    die("Conexion fallida: " . mysqli_connect_error());
}   
// Si la conexion falla muestra un mensaje de error.

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Página personal</title> 
    <link rel="stylesheet" href="css.css">
    <link rel="icon" href="media/logo.PNG">
</head>
<body>
    <header>
        <h1>Panel Personal</h1>
    </header>
    <nav>
        <ul>
            <li class="pina"><a href="main.php">Pagina principal</a></li>
            <li class="pina"><a href="form_faltas.php">Solicitar ausencia</a></li>
            <li class="pina"><a href="listaphp.php">Lista profesores</a></li>
            <li class="pina"><a href="conexion.php">Conexion</a></li>
            <li class="pina"><a href="admin_panel.php">Panel Admin</a></li>
        </ul>
    </nav>
    <main>
        <h2>Panel Personal</h2>
        <table>
        <tr>
            <th>Profesores/as ausentes</th>
            <th>Dia</th>
            <th>Clase (Aula)</th> 
            <th>Hora</th>
            <th>Familia</th>
            <th>Tarea</th>
        </tr>
            <?php
            $user = $_SESSION['user']['dni'];
            $run = "SELECT h.id_hora, a.tarea, a.dia_a, a.hora_a, a.aceptar, 
            u.nombre, u.apellido, u.familia, a.estado, a.dni_usuario_cubridor, h.aula
            FROM ausencia a 
            LEFT JOIN usuario u ON a.dni_generador = u.dni
            LEFT JOIN horario h ON a.id_horario = h.id_horario 
            WHERE a.dni_usuario_cubridor = '$user' ORDER BY a.dia_a DESC, a.hora_a DESC";

            $resultado_ausencia = $conexion->query($run);

            while ($away = $resultado_ausencia->fetch_assoc()) {
                echo '<tr>';
                    echo '<td>' . htmlspecialchars($away['nombre']) . " " . htmlspecialchars($away['apellido']) . '</td>';
                    echo '<td>' . htmlspecialchars($away['dia_a']) . '</td>';
                    echo '<td>' . htmlspecialchars($away['aula']) . '</td>';
                    echo '<td>' . htmlspecialchars($away['id_hora']) . '</td>';
                    echo '<td>' . htmlspecialchars($away['familia']) . '</td>'; 
                    if (empty($away['tarea'])) {
                        $tareaFinal = "<i>Sin tarea</i>";
                    } else {
                        $tareaFinal = $away['tarea'];
                    }
                    echo '<td>' . $tareaFinal . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </main>
</body>
</html>