<?php
/**
 * Vista: Admin Panel
 * Panel de administración para aceptar/rechazar ausencias
 */

require "auth.php";
requireAdmin();
timeSesion();

$conexion = mysqli_connect("localhost","cyberbuild","Admin1234","faltas");

// Si se envía el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_a'])) {
    $ausencia = new Ausencia($db);
    $id_a = intval($_POST['id_a']);
    $accion = $_POST['accion'] ?? '';
    
    $nuevo_estado = ($accion === 'aceptar') ? 'aceptada' : 'rechazada';
    $ausencia->updateEstado($id_a, $nuevo_estado);
    
    header("Location: admin_panel.php");
    exit;
}

$ausencia = new Ausencia($db);
$resultado = $ausencia->getPending();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador - Cyberbuild</title>
    <link rel="stylesheet" href="css.css">
    <link rel="icon" href="images/logo.PNG">
</head> 
<body>
    <header>
        <h1>Panel de Administrador</h1>
        <a href="main.php">
        <img id="cpifp" src="media/logo_cpifp.png">
        </a>
    </header>
    <nav>
        <ul>
        </ul>
    </nav>
    <main>
        <h2>Aceptar/Rechazar Ausencias</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre del Profesor</th>
                    <th>Día</th>
                    <th>Hora</th> 
                    <th>Clase</th> 
                    <th>Justificante</th>
                    <th>Estado</th>
                    <th>Acciones</th> 
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado && $resultado->num_rows > 0): ?>
                    <?php while ($row = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nombre'] . " " . $row['apellido']); ?></td>
                            <td><?php echo htmlspecialchars($row['dia_a']); ?></td>
                            <td><?php echo htmlspecialchars($row['id_hora'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($row['aula'] ?? ''); ?></td>
                            <td><?php echo $row['justificante'] ?? 'Sin justificante'; ?></td>
                            <td><?php echo htmlspecialchars($row['estado']); ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="id_a" value="<?php echo htmlspecialchars($row['id_a']); ?>">
                                    <button type="submit" name="accion" value="aceptar" class="btn-accept">ACEPTAR ✅</button>
                                    <button type="submit" name="accion" value="rechazar" class="btn-reject">RECHAZAR 🚫</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center;">No hay ausencias pendientes</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2026 Cyberbuild - Sistema de Gestión de Faltas</p>
    </footer>
    <script src="<?php echo PUBLIC_URL; ?>js/main.js"></script>
</body>
</html>
