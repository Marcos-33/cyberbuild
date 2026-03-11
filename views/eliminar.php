<?php
/**
 * Vista: Eliminar Usuarios (Admin Only)
 */

require_once(__DIR__ . '/../config/Config.php');
require_once(__DIR__ . '/../helpers/Auth.php');
require_once(__DIR__ . '/../config/Database.php');
require_once(__DIR__ . '/../models/Usuario.php');

Auth::requireAdmin();

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

// Si se envía el formulario
if (isset($_GET['eliminar'])) {
    $dni = $_GET['eliminar'];
    $usuario->delete($dni);
    header("Location: eliminar.php");
    exit;
}

$resultado = $usuario->getAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuarios - Cyberbuild</title>
    <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>css/style.css">
    <link rel="icon" href="<?php echo PUBLIC_URL; ?>images/logo.PNG">
</head> 
<body>
    <header>
        <h1>Gestionar Usuarios</h1>
    </header>
    <nav>
        <ul>
            <li class="pina"><a href="admin_panel.php">Panel de Admin</a></li>
            <li class="pina"><a href="crear_usuarios.php">Crear Usuario</a></li>
            <li class="pina"><a href="main.php">Página Principal</a></li>
        </ul>
    </nav>
    <main>
        <h2>Listado de Usuarios</h2>

        <table>
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Familia</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado && $resultado->num_rows > 0): ?>
                    <?php while ($fila = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($fila['dni']); ?></td>
                            <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($fila['apellido']); ?></td>
                            <td><?php echo htmlspecialchars($fila['gmail']); ?></td>
                            <td><?php echo htmlspecialchars($fila['familia']); ?></td>
                            <td><?php echo htmlspecialchars($fila['rol']); ?></td>
                            <td>
                                <a href="?eliminar=<?php echo urlencode($fila['dni']); ?>" 
                                   onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');"
                                   class="btn-delete">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center;">No hay usuarios registrados</td>
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
