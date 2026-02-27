<?php
require "auth.php";
requireLogin();

$conexion = mysqli_connect("192.168.14.187","cyberbuild","Admin1234","faltas");
// Establece conexion
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error()); 
}
$conexion->set_charset('utf8mb4'); 

// obtener hora seleccionada desde GET y lista de horas disponibles
$selectedHour = isset($_GET['hora']) ? $_GET['hora'] : '';
// escapamos para usar en la consulta
$horaEscaped = mysqli_real_escape_string($conexion, $selectedHour);

$horas = [];
$horaResult = mysqli_query($conexion, "SELECT DISTINCT hora_a FROM ausencia ORDER BY hora_a");
if ($horaResult) {
    while ($h = mysqli_fetch_assoc($horaResult)) {
        $horas[] = $h['hora_a'];
    }
}

// consulta con agregación condicional para total de coberturas y coberturas en la hora seleccionada
$sql = "SELECT 
    u.dni AS dni,
    u.nombre,
    u.apellido,
    SUM(CASE WHEN a.dni_usuario_cubridor = u.dni THEN 1 ELSE 0 END) AS contador_cubridor,
    SUM(CASE WHEN a.dni_usuario_cubridor = u.dni AND a.hora_a = '$horaEscaped' THEN 1 ELSE 0 END) AS contador_hora
FROM usuario u
LEFT JOIN ausencia a ON a.dni_generador = u.dni OR a.dni_usuario_cubridor = u.dni
GROUP BY u.dni, u.nombre, u.apellido";

// ordenar por la columna de hora si se especificó, sino por total
if ($selectedHour !== '') {
    $sql .= " ORDER BY contador_hora DESC, contador_cubridor DESC";
} else {
    $sql .= " ORDER BY contador_cubridor DESC";
}
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
            <input type="text" id="busqueda" placeholder="Buscar Nombre">
        
        <!-- filtro de hora -->
        <form method="get" id="horaForm">
            <label for="hora">Filtrar por hora:</label>
            <select name="hora" id="hora">
                <option value="">-- Todas --</option>
                <?php foreach ($horas as $h): ?>
                    <option value="<?= htmlspecialchars($h) ?>" <?= $selectedHour === $h ? 'selected' : '' ?>><?= htmlspecialchars($h) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Aplicar</button>
            <?php if ($selectedHour !== ''): ?>
                <a href="listaphp.php">Limpiar</a>
            <?php endif; ?>
        </form>
        
        <script>
            // Obtener el input de búsqueda
            const input = document.getElementById("busqueda");
            
            // Función que filtra las filas de la tabla
            const buscar = () => {
                const n = input.value.toLowerCase();
                
                // Obtiene todas las filas de la tabla (excepto el encabezado)
                const filas = document.querySelectorAll("#tabla tr:not(:first-child)");
                
                filas.forEach(fila => {
                    // Busca coincidencia en columna 2 (nombre)
                    const generador = fila.querySelector("td:nth-child(2)")?.textContent.toLowerCase();
                    
                    // Si el búsqueda está vacía, muestra todas las filas
                    // Si el búsqueda tiene contenido, muestra solo filas que coincidan
                    if (n === "" || generador.includes(n)) {
                        fila.style.display = "table-row"; // Muestra la fila
                    } else {
                        fila.style.display = "none"; // Oculta la fila
                    }
                });
            };
            // Para keyup (cuando levantas la tecla)
            // Evento keydown: busca cada vez que presionas una tecla
            input.addEventListener("keydown", buscar);
        </script>
        <h2>Resumen de envíos por usuario</h2>
        <?php if ($selectedHour !== ''): ?>
            <p>Mostrando guardias cubiertas en la hora <strong><?= htmlspecialchars($selectedHour) ?></strong></p>
        <?php endif; ?>
        <table id="tabla">
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Nº de Guardias cubiertas</th>
                <th>Guardias en hora seleccionada</th>
                <th>Guardia 1</th>
                <th>Guardia 2</th>
            </tr>
            <?php
            $resultado = $conexion->query($sql);
            if ($resultado && $resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['dni']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['nombre']) . ' ' . htmlspecialchars($row['apellido']) . '</td>';
                    echo '<td><strong>' . (int)$row['contador_cubridor'] . '</strong></td>';
                    echo '<td><strong>' . (int)$row['contador_hora'] . '</strong></td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="5">No hay datos disponibles</td></tr>';
            }
            // Cerrar conexión
            $conexion->close();
            ?>
        </table>
    </main>
    <footer>
        <p>&copy; 2026 cyberbuild. Todos los derechos reservados</p>
    </footer>
</body>
</html>