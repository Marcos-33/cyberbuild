<?php
require "auth.php";
requireLogin();
timeSesion();

$conexion = mysqli_connect("localhost","cyberbuild","Admin1234","faltas");
// Establece conexion
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error()); 
}
$conexion->set_charset('utf8mb4'); 

// obtener id_hora seleccionado desde GET y lista de id_hora disponibles
$selectedIdHora = isset($_GET['id_hora']) ? $_GET['id_hora'] : '';
// escapamos para usar en la consulta
$idHoraEscaped = mysqli_real_escape_string($conexion, $selectedIdHora);

$horas = [];
// recogemos todos los identificadores de hora (j1, j2…) presentes en ausencias
$horaResult = mysqli_query($conexion, "
    SELECT DISTINCT h.id_hora
    FROM ausencia a
    LEFT JOIN horario h ON a.id_horario = h.id_horario
    WHERE h.id_hora IS NOT NULL
    ORDER BY h.id_hora
");
if ($horaResult) {
    while ($h = mysqli_fetch_assoc($horaResult)) {
        $horas[] = $h['id_hora'];
    }
}

// consulta que devuelve dos conteos mediante subconsultas filtradas
// cada subconsulta sólo examina las filas que interesan, sin comparar con todos los demás

//$sql = "SELECT u.dni AS dni, u.nombre, u.apellido FROM ausencia a 
//INNER JOIN usuario u ON u.dni = a.dni_usuario_cubridor COUNT(*) WHERE a.dni_usuario_cubridor =";
$sql = "SELECT u.dni AS dni, u.nombre, u.apellido,
--  total de ausencias donde el usuario es cubridor
    (SELECT COUNT(*) FROM ausencia a
        WHERE a.dni_usuario_cubridor = u.dni
    ) AS contador_cubridor,
 -- de esas, las que coinciden con la hora seleccionada
    (SELECT COUNT(*) FROM ausencia a
        JOIN horario h ON a.id_horario = h.id_horario
        WHERE a.dni_usuario_cubridor = u.dni
        AND h.id_hora = '$idHoraEscaped'
    ) AS contador_hora
FROM usuario u";

// ordenar por la columna de hora si se especificó id_hora, sino por total
if ($selectedIdHora !== '') {
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
<body>
    <header>
        <h1>Lista de Profesores</h1>
        <a href="main.php">
        <img id="cpifp" src="media/logo_cpifp.png">
        </a>
    </header>
        <?php include "navpub.php"; ?>
    <main>
    <main>
            <input type="text" id="busqueda" placeholder="Buscar Nombre">
        
        <!-- filtro por id_hora -->
        <form method="get" id="horaForm">
            <label for="id_hora">Filtrar por hora:</label>
            <select name="id_hora" id="id_hora">
                <option value="">-- Todos --</option>
                <?php foreach ($horas as $h): ?>
                    <option value="<?= htmlspecialchars($h) ?>" <?= $selectedIdHora === $h ? 'selected' : '' ?>><?= htmlspecialchars($h) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Aplicar</button>
            <?php if ($selectedIdHora !== ''): ?>
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
        <?php if ($selectedIdHora !== ''): ?>
            <p>Mostrando guardias cubiertas con id_hora <strong><?= htmlspecialchars($selectedIdHora) ?></strong></p>
        <?php endif; ?>
        <table id="tabla">
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Nº de Guardias cubiertas</th>
                <th>Guardias con id_hora seleccionado</th>
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
        <p></p>
    </footer>
</body>
</html>