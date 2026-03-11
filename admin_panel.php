<?php 
require "auth.php"; // Para que solo entren admins
requireAdmin(); // Comprobar que hay sesión
timeSesion();    
// Aquí creamos la conexión 
$conexion = mysqli_connect("localhost", "cyberbuild", "Admin1234", "faltas");

if($conexion->connect_errno) {
    echo "No hay conexión: (" . $conexion->connect_error . ")";
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
        <h1>Panel de administrador</h1>
        <a href="main.php">
        <img id="cpifp" src="media/logo_cpifp.png">
        </a>
    </header>
        <?php include "navpriv.php"; ?>
    <main>
        <h2>Aceptar ausencia.</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Dia</th>
                <th>Hora</th> 
                <th>Clase (Aula)</th> 
                <th>Justificante</th>
                <th>Estado</th>
                <th>Acciones</th> 
            </tr>
            <?php
            $sql = "SELECT a.id_a, a.justificante, a.dia_a, u.nombre, u.apellido, a.estado, 
                           h.id_hora, h.aula 
                    FROM ausencia a 
                    LEFT JOIN usuario u ON a.dni_generador = u.dni 
                    LEFT JOIN horario h ON a.id_horario = h.id_horario
                    WHERE a.estado = 'Pendiente'";
            
            $resultado_ausencia = $conexion->query($sql);

            if ($resultado_ausencia && $resultado_ausencia->num_rows > 0 ) {
                while ($rowA = $resultado_ausencia->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($rowA['nombre'] . " " . $rowA['apellido']) . '</td>';
                    echo '<td>' . htmlspecialchars($rowA['dia_a']) . '</td>';
                    echo '<td>' . htmlspecialchars($rowA['id_hora']) . '</td>';
                    echo '<td>' . htmlspecialchars($rowA['aula']) . '</td>';
                    echo '<td>' . $rowA['justificante'] . '</td>';
                    echo '<td>' . htmlspecialchars($rowA['estado']) . '</td>';
                    echo '<td>';
                        echo '<form method="POST" action="estado.php" style="display:inline;">';
                            echo '<input type="hidden" name="id_a" value="' . htmlspecialchars($rowA['id_a']) . '">';
                            echo '<button type="submit" name="accion" class="btn-aceptar" value="aceptar">ACEPTAR ✅</button>';
                            echo '<button type="submit" name="accion" class="btn-aceptar" value="rechazar" class="btn-Rechazar">RECHAZAR 🚫</button>';
                        echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="7">No hay solicitudes disponibles en este momento</td></tr>';
            }
            ?>
        </table>
    </main>
    <footer>
        <p>&copy; 2008 Página web desarrollada por Cyberbuild</p>
    </footer>
</body>
</html>