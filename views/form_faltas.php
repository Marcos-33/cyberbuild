<?php
/**
 * Vista: Formulario de Solicitud de Ausencia
 */

require_once(__DIR__ . '/../config/Config.php');
require_once(__DIR__ . '/../helpers/Auth.php');
require_once(__DIR__ . '/../config/Database.php');
require_once(__DIR__ . '/../models/Horario.php');

Auth::requireLogin();

$database = new Database();
$db = $database->getConnection();
$horario = new Horario($db);

$dni_usuario = Auth::getCurrentDni();
$horarios = $horario->getByUser($dni_usuario);

$user = Auth::getCurrentUser();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Ausencia - Cyberbuild</title>
    <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>css/style.css">
    <link rel="icon" href="<?php echo PUBLIC_URL; ?>images/logo.PNG">
</head>
<body>
    <header>
        <h1>Solicitar Ausencia</h1> 
    </header>
    <nav>
        <ul>
            <li class="pina"><a href="main.php">Volver al Inicio</a></li>
            <li class="pina"><a href="listaphp.php">Lista de Profesores</a></li> 
            <li class="pina"><a href="personal.php">Mi Panel Personal</a></li>
        </ul>
    </nav>
    <main>
        <h2>Bienvenido, <?php echo htmlspecialchars($user['nombre'] . ' ' . $user['apellido']); ?>!</h2>
        
        <form class="form-ausencia" action="../controllers/AusenciaController.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="horario">Selecciona tu Horario:</label>
                <select name="horario" id="horario" required>
                    <option value="">-- Selecciona un horario --</option>
                    <?php if ($horarios && $horarios->num_rows > 0): ?>
                        <?php while ($h = $horarios->fetch_assoc()): ?>
                            <option value="<?php echo htmlspecialchars($h['id_horario']); ?>">
                                <?php echo htmlspecialchars($h['id_hora'] . ' - ' . $h['modulo'] . ' (' . $h['aula'] . ')'); ?>
                            </option>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <option value="">Sin horarios asignados - Contacta con administrador</option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="dia">Día de la Ausencia:</label>
                <input type="date" name="dia" id="dia" required>
            </div>

            <div class="form-group">
                <label for="archivo">Justificante:</label>
                <input type="file" id="archivo" name="archivo">
            </div>

            <div class="form-group">
                <label for="tarea">Tarea para el Sustituto:</label>
                <input type="file" id="tarea" name="tarea">
            </div>

            <button type="submit" name="action" value="create" class="btn-submit">Enviar Ausencia</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2026 Cyberbuild - Sistema de Gestión de Faltas</p>
    </footer>
    <script src="<?php echo PUBLIC_URL; ?>js/main.js"></script>
</body>
</html>
