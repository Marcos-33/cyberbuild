<?php
/**
 * Vista: Panel Personal - Ausencias cubiertas por el usuario
 */

require_once(__DIR__ . '/../config/Config.php');
require_once(__DIR__ . '/../helpers/Auth.php');
require_once(__DIR__ . '/../config/Database.php');
require_once(__DIR__ . '/../models/Ausencia.php');

Auth::requireLogin();

$database = new Database();
$db = $database->getConnection();
$ausencia = new Ausencia($db);

$dni_usuario = Auth::getCurrentDni();
$resultado = $ausencia->getCoveredByUser($dni_usuario);
$user = Auth::getCurrentUser();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Panel Personal - Cyberbuild</title>
    <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>css/style.css">
    <link rel="icon" href="<?php echo PUBLIC_URL; ?>images/logo.PNG">
</head>
<body>
    <header>
        <h1>Mi Panel Personal</h1>
    </header>
    <nav>
        <ul>
            <li class="pina"><a href="main.php">Página Principal</a></li>
            <li class="pina"><a href="form_faltas.php">Solicitar Ausencia</a></li>
            <li class="pina"><a href="listaphp.php">Lista de Profesores</a></li>
        </ul>
    </nav>
    <main>
        <h2>Mis Ausencias Cubiertas</h2>
        <p>Usuario: <?php echo htmlspecialchars($user['nombre'] . ' ' . $user['apellido']); ?> (<?php echo htmlspecialchars($user['dni']); ?>)</p>
        
        <table>
            <thead>
                <tr>
                    <th>Profesor Ausente</th>
                    <th>Día</th>
                    <th>Clase</th>
                    <th>Hora</th>
                    <th>Familia</th>
                    <th>Tarea</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado && $resultado->num_rows > 0): ?>
                    <?php while ($row = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nombre'] . " " . $row['apellido']); ?></td>
                            <td><?php echo htmlspecialchars($row['dia_a']); ?></td>
                            <td><?php echo htmlspecialchars($row['aula'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($row['id_hora'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($row['familia'] ?? ''); ?></td>
                            <td><?php echo !empty($row['tarea']) ? $row['tarea'] : '<i>Sin tarea</i>'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">No hay ausencias cubiertas</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2026 Cyberbuild - Sistema de Gestión de Faltas</p>
    </footer>
</body>
</html>
