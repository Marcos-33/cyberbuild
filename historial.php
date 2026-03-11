<?php
require "auth.php";
requireAdmin();
timeSesion();

$conexion = mysqli_connect("localhost", "cyberbuild", "Admin1234", "faltas");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// El año académico va desde el 1 de septiembre hasta el 29 de agosto

// Obtener la fecha actual
$currentDate = new DateTime();
// Extraer el mes actual (como número: 1-12)
$currentMonth = intval($currentDate->format('m'));
// Extraer el año actual
$currentYear = intval($currentDate->format('Y'));

// Determinar las fechas de inicio y fin del año académico
// Si estamos en septiembre, octubre, noviembre o diciembre (mes >= 9)
// El año académico COMIENZA este año y termina el próximo año
if ($currentMonth >= 9) {
    // Ejemplo: Si es octubre de 2026, mostramos desde 1 sept 2026 hasta 29 ago 2027
    $academicStartDate = $currentYear . '-09-01';
    $academicEndDate = ($currentYear + 1) . '-08-29';
} else {
    // Si estamos en enero a agosto (mes < 9)
    // El año académico COMENZÓ el año pasado y termina este año
    // Ejemplo: Si es febrero de 2026, mostramos desde 1 sept 2025 hasta 29 ago 2026
    $academicStartDate = ($currentYear - 1) . '-09-01';
    $academicEndDate = $currentYear . '-08-29';
}

$sql = "
    SELECT
        a.id_a,
        a.dia_a,
        a.tipo,
        a.justificante,
        a.hora_a,
        a.tarea,
        a.id_horario,
        u.dni,
        u.gmail,
        u.nombre,
        u.apellido
    FROM ausencia a
    INNER JOIN usuario u
        ON a.dni_generador = u.dni
    WHERE a.dia_a >= '$academicStartDate'
        AND a.dia_a <= '$academicEndDate'
    ORDER BY a.id_a DESC
";

$resultado = mysqli_query($conexion, $sql);
if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
?>
<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Historial de Ausencias</title>
        <link rel="stylesheet" href="css.css">
        <link rel="icon" href="media/logo.PNG">
    </head>
    <body>
        <header>
            <h1>Historial de Ausencias</h1>
            <a href="main.php">
        <img id="cpifp" src="media/logo_cpifp.png">
        </a>
        </header>
            <?php include "navpriv.php"; ?>
        <main>
        <div class="infaño">
            <h3>Historial del Año Académico</h3>
            <p>Mostrando ausencias de <strong><?= date('d/m/Y', strtotime($academicStartDate)) ?></strong> a <strong><?= date('d/m/Y', strtotime($academicEndDate)) ?></strong></p>
        </div>
        
        <input type="text" id="busqueda" placeholder="Buscar Nombre">
        
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
    <table id="tabla"> 
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Día</th>
            <th>DNI</th>
            <th>Gmail</th>
            <th>Justificante</th>
            <th>Hora</th>
            <th>Tarea</th>
            <th>ID Horario</th> 
        </tr>

    <?php if (mysqli_num_rows($resultado) > 0):
            while ($fila = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?= htmlspecialchars($fila['id_a'])?></td>
                <td><?= htmlspecialchars($fila['nombre']) . ' ' . htmlspecialchars($fila['apellido']) ?></td>
                <td><?= htmlspecialchars($fila['dia_a']) ?></td>
                <td><?= htmlspecialchars($fila['dni']) ?></td>
                <td><?= htmlspecialchars($fila['gmail']) ?></td>
                <td><?= $fila['justificante'] ?></td>
                <td><?= htmlspecialchars($fila['hora_a']) ?></td>
                <td><?= $fila['tarea'] ?></td>
                <td><?= htmlspecialchars($fila['id_horario']) ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="11">No hay ausencias registradas</td>
        </tr>
    <?php endif; ?>

    </table>

    </body>
    </html>

<?php
mysqli_close($conexion);
?>
