<?php
/**
 * Vista: Página Principal
 * Muestra las ausencias disponibles para cubrir del día actual
 */

require_once(__DIR__ . '/../config/Config.php');
require_once(__DIR__ . '/../helpers/Auth.php');
require_once(__DIR__ . '/../config/Database.php');
require_once(__DIR__ . '/../models/Ausencia.php');

Auth::requireLogin();

$database = new Database();
$db = $database->getConnection();
$ausencia = new Ausencia($db);

$resultado_ausencia = $ausencia->getAvailableToday();

$user = Auth::getCurrentUser();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página Principal - Cyberbuild</title> 
    <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>css/style.css">
    <link rel="icon" href="<?php echo PUBLIC_URL; ?>images/logo.PNG">
</head>
<body>
    <header>
        <h1>Página Principal</h1>
    </header>
    <nav>
        <ul>
            <li class="pina"><a href="form_faltas.php">Solicitar Ausencia</a></li>
            <li class="pina"><a href="listaphp.php">Lista de Profesores</a></li>
            <?php if (Auth::isAdmin()): ?>
                <li class="pina"><a href="admin_panel.php">Panel de Admin</a></li>
            <?php endif; ?>
            <li class="pina"><a href="personal.php">Mi Panel Personal</a></li>
            <li class="pina"><a href="clases.php">Mis Clases</a></li>
        </ul>
    </nav>
    <main>
        <h2>Bienvenido, <?php echo htmlspecialchars($user['nombre'] . ' ' . $user['apellido']); ?>!</h2>
        
        <h3>Ausencias Disponibles Hoy</h3>
        <table>
            <thead>
                <tr>
                    <th>Profesor/a Ausente</th>
                    <th>Día</th>
                    <th>Clase</th>
                    <th>Hora</th>
                    <th>Familia</th>
                    <th>Tarea</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado_ausencia && $resultado_ausencia->num_rows > 0): ?>
                    <?php while ($away = $resultado_ausencia->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($away['nombre'] . " " . $away['apellido']); ?></td>
                            <td><?php echo htmlspecialchars($away['dia_a']); ?></td>
                            <td><?php echo htmlspecialchars($away['aula'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($away['id_hora'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($away['familia'] ?? ''); ?></td>
                            <td><?php echo !empty($away['tarea']) ? $away['tarea'] : "<i>Sin tarea</i>"; ?></td>
                            <td>
                                <form method="POST" action="../controllers/AusenciaController.php" style="display:inline;">
                                    <input type="hidden" name="id_a" value="<?php echo htmlspecialchars($away['id_a']); ?>">
                                    <input type="hidden" name="action" value="accept">
                                    <button type="submit" class="btn-accept">ACEPTAR ✅</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center;">No hay ausencias disponibles en este momento</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div style="margin-top: 2rem; text-align: right;">
            <form action="../helpers/Auth.php?action=logout" method="post">
                <button type="submit" class="btn-logout">Cerrar Sesión</button>
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; 2026 Cyberbuild - Sistema de Gestión de Faltas</p>
    </footer>
    <script src="<?php echo PUBLIC_URL; ?>js/main.js"></script>
</body>
</html>
