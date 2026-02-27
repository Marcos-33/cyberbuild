<?php
require "auth.php";
requireLogin();

// Conexión a la base de datos
$conexion = mysqli_connect("192.168.14.187", "cyberbuild", "Admin1234", "faltas");

if($conexion->connect_errno) {
    echo "No hay conexión : (" . $conexion->connect_error . ")";
    exit();
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample HTML Page</title>
    <link rel="stylesheet" href="css.css">
    <link rel="icon" href="media/logo.PNG">
</head>
 
<body>
    
    <header>
        <h1>Solicitar ausencia</h1> 
    </header>
    <nav>
        <ul>
            <li class="pina"><a href="main.php">Volver al inicio</a></li>
            <li class="pina"><a href="listaphp.php">Lista profesores</a></li> 
            <li class="pina"><a href="conexion.php">Conexion</a></li>
        </ul>
    </nav>
    <main>
        <?php
        echo 'Bienvenido, '.htmlspecialchars($_SESSION['user']['nombre']). ' ' . htmlspecialchars($_SESSION['user']['apellido']) . '!';
        ?>
        <form class= "Falta" action="formulario.php" method="POST" enctype="multipart/form-data">
            <!--<label for="dni">DNI</label><br>
            <input type="text" id="dni" name="dni" value=""><br>
            <label for="nombre">Nombre</label><br>
            <input type="text" id="nombre" name="nombre" value=""><br>
            <label for="modulo">Modulo</label><br>
            <input type="text" id="modulo" name="modulo"><br><br>
            -->
            <label for="archivo">Sube tu Justificante</label>
            <input type="file" id="archivo" name="archivo"><br><br>
            <label for="tarea">Subir aqui la tarea</label>
            <input type="file" id="tarea" name="tarea"><br><br>
            <label for="horario">Horario</label><br>
            <select name="horario"><br>
        <?php
        // Obtener el DNI del usuario de la sesión
        $dni_usuario = $_SESSION['user']['dni'] ?? '';
        
        // Consultar los horarios disponibles para este usuario
        // Traer id_hora (para mostrar) e id_horario (para enviar a BD)
        $query = "SELECT id_horario, id_hora FROM horario WHERE dni_usuario = '$dni_usuario'";
        $result = mysqli_query($conexion, $query); 

        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                // Mostrar id_hora (J1, J2, etc) pero enviar id_horario como value
                $id_horario = $row['id_horario'];
                $id_hora = $row['id_hora'];
                echo "<option value='$id_horario'>$id_hora</option>";
            }
        } else {
            // Si no hay horarios asignados, mostrar mensaje
            echo "<option value=''>Sin horarios asignados</option>";
        }
        ?>
        </select><br><br>
        <label for="horario">Selecciona el Aula</label><br><br>
            <label for="dia">Día</label><br>
            <input type="date" name="dia" required><br><br>
        <input type="submit" name="enviar" value="Enviar falta">
        </form>
    </main>
    <footer>
        <p>&copy; 2008 Página web desarrollada por Cyberbuild</p>
    </footer>
</body>
</html>