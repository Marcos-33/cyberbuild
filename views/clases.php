<?php
/**
 * Vista: Gestión de Clases/Horarios del Usuario
 */

require_once(__DIR__ . '/../config/Config.php');
require_once(__DIR__ . '/../helpers/Auth.php');
require_once(__DIR__ . '/../helpers/Utils.php');
require_once(__DIR__ . '/../config/Database.php');

Auth::requireLogin();

$user = Auth::getCurrentUser();
define('HOURS_PER_DAY', 6);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Clases - Cyberbuild</title>
    <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>css/style.css">
    <link rel="icon" href="<?php echo PUBLIC_URL; ?>images/logo.PNG">
</head> 
<body>
    <header>
        <h1>Mis Clases y Horarios</h1>
    </header>
    <nav>
        <ul>
            <li class="pina"><a href="main.php">Página Principal</a></li>
            <li class="pina"><a href="form_faltas.php">Solicitar Ausencia</a></li>
        </ul>
    </nav>
    <main>
        <h2>Editar Horario de Clases</h2>
        <p>Usuario: <?php echo htmlspecialchars($user['nombre'] . ' ' . $user['apellido']); ?></p>
        
        <form action="../controllers/HorarioController.php" method="post" class="form-horarios">
            <?php for ($i = 1; $i <= HOURS_PER_DAY; $i++): ?>
                <div class="horario-block">
                    <h4><?php echo Utils::getHourLabel('L' . $i); ?></h4>
                    <div class="form-group">
                        <label for="modulol<?php echo $i; ?>">Módulo/Asignatura:</label>
                        <input type="text" id="modulol<?php echo $i; ?>" name="modulol<?php echo $i; ?>" placeholder="Ej: Bases de Datos">
                    </div>
                    <div class="form-group">
                        <label for="clasel<?php echo $i; ?>">Clase/Aula:</label>
                        <input type="text" id="clasel<?php echo $i; ?>" name="clasel<?php echo $i; ?>" placeholder="Ej: 101">
                    </div>
                </div>
            <?php endfor; ?>
            
            <button type="submit" name="action" value="add" class="btn-submit">Guardar Horarios</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2026 Cyberbuild - Sistema de Gestión de Faltas</p>
    </footer>
</body>
</html>
