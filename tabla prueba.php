<?php
$conexion = mysqli_connect("localhost","cyberbuild","Admin1234","faltas");
// Establece conexion
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error()); 
}
$conexion->set_charset('utf8mb4'); 

$sql = "SELECT 
    dni_usuario_cubridor, 
    dni_generador,
    (SELECT COUNT(*) FROM ausencia WHERE dni_usuario_cubridor = a.dni_usuario_cubridor) AS contador_cubridor,
    (SELECT COUNT(*) FROM ausencia WHERE dni_generador = a.dni_generador) AS contador_generador
FROM ausencia a
GROUP BY dni_usuario_cubridor, dni_generador
ORDER BY contador_cubridor DESC, contador_generador DESC";
?>
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
        <h1>Lista profesores</h1>
    </header>
    <nav>
        <ul>
            <li class="pina"><a href="form_faltas.php">Solicitar ausencia</a></li>
            <li class="pina"><a href="main.php">Pagina Principal</a></li>
            <li class="pina"><a href="conexion.php">Conexion</a></li>
        </ul>
    </nav>
    <main>
        <h2>Resumen de envíos por usuario</h2>
        <table>
            <tr>
                <th>dni_usuario_cubridor</th>
                <th>Contador Cubridor</th>
                <th>dni_generador</th>
                <th>Contador Generador</th>
            </tr>
            <?php
            $resultado = $conexion->query($sql);
            if ($resultado && $resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['dni_usuario_cubridor']) . '</td>';
                    echo '<td><strong>' . (int)$row['contador_cubridor'] . '</strong></td>';
                    echo '<td>' . htmlspecialchars($row['dni_generador']) . '</td>';
                    echo '<td><strong>' . (int)$row['contador_generador'] . '</strong></td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="4">No hay datos disponibles</td></tr>';
            }
            // Cerrar conexión
            $conexion->close();
            ?>