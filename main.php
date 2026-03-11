<!-- Pagina principal, basicamente el index si se ha iniciado sesion. Esta pagina existe para aceptar la ausencia creada por un profesor. -->
<?php
// Comprueba que el usuario ha iniciado sesión.
require "auth.php";
requireLogin();
timeSesion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Página principal</title> 
    <link rel="stylesheet" href="css.css">
    <link rel="icon" href="media/logo.PNG">
</head>
<body>

    <header>
        <h1>Página principal</h1>
    </header>

    <?php include "navpub.php"; ?>

    <main>
        <?php
        echo 'Bienvenido, ' . htmlspecialchars($_SESSION['user']['nombre']) . ' ' . htmlspecialchars($_SESSION['user']['apellido']) . '!';
        ?>

        <table>
            <tr>
                <th>Profesores/as ausentes</th>
                <th>Dia</th>
                <th>Clase (Aula)</th>
                <th>Hora</th>
                <th>Familia</th>
                <th>Tarea</th>
                <th>Apuntarse</th>
            </tr>

            <?php
            // Obtenemos la fecha actual en formato 'Y-m-d' para compararla despues.
            $diaActual = date('Y-m-d'); 
            
            // Consulta para obtener las ausencias diarias que los administradores han aceptado pero nadie la ha cubierto
            $run = "SELECT a.id_a, h.id_hora, h.aula, a.tipo, a.tarea, a.dia_a, a.hora_a, a.aceptar, 
                    u.nombre, u.apellido, u.familia, a.estado 
                    FROM ausencia a 
                    LEFT JOIN usuario u ON a.dni_generador = u.dni
                    LEFT JOIN horario h ON a.id_horario = h.id_horario 
                    WHERE a.estado = 'aceptada' AND a.dia_a = '$diaActual' AND a.aceptar = 'NO' 
                    /*AND a.dni_generador != u.dni*/";

            // Ejecutamos la consulta y mostramos los resultados en la tabla.
            $resultado_ausencia = $conexion->query($run);

            if ($resultado_ausencia && $resultado_ausencia->num_rows > 0) {
                while ($away = $resultado_ausencia->fetch_assoc()) {
                    echo '<tr>';
                        // Nombre
                        echo '<td>' . htmlspecialchars($away['nombre'] . " " . $away['apellido']) . '</td>';
                        
                        // Día
                        echo '<td>' . htmlspecialchars($away['dia_a']) . '</td>';
                        
                        // Clase
                        echo '<td>' . htmlspecialchars($away['aula']) . '</td>';
                        
                        // Hora
                        echo '<td>' . htmlspecialchars($away['id_hora']) . '</td>';
                        
                        // Familia
                        echo '<td>' . htmlspecialchars($away['familia']) . '</td>'; 

                        // Tarea
                        $tareaFinal = !empty($away['tarea']) ? $away['tarea'] : "<i>Sin tarea</i>";
                        echo '<td>' . $tareaFinal . '</td>';
                        
                        // Botón Apuntarse
                        echo '<td>';
                            echo '<form method="POST" action="aceptar.php" style="display:inline;">';
                                echo '<input type="hidden" name="id_a" value="' . htmlspecialchars($away['id_a']) . '">';
                                echo '<button type="submit" name="accion" class="btn-aceptar" value="aceptar">ACEPTAR ✅​</button>';
                            echo '</form>';
                        echo '</td>';
                    echo '</tr>';
                }
            } else {
                // Mensaje cuando no hay ausencias
                echo '<tr><td colspan="9" style="text-align:center;">No hay ausencias disponibles en este momento</td></tr>';
            }
            ?>
        </table>

        <form action="log-out.php" method="post">
            <button id="close" type="submit">Cerrar sesión</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2008 Página web desarrollada por Cyberbuild</p>
    </footer>

    <script src="menu.js" defer></script>
    <script src="DataTransfer.js" defer></script>

</body>
</html>