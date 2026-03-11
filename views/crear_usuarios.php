<?php
/**
 * Vista: Crear Nuevos Usuarios (Admin Only)
 */

require_once(__DIR__ . '/../config/Config.php');
require_once(__DIR__ . '/../helpers/Auth.php');

Auth::requireAdmin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario - Cyberbuild</title>
    <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>css/style.css">
    <link rel="icon" href="<?php echo PUBLIC_URL; ?>images/logo.PNG">
</head>
<body>
    <header>
        <h1>Crear Nuevo Usuario</h1>
    </header>
    <nav>
        <ul>
            <li class="pina"><a href="admin_panel.php">Panel de Admin</a></li>
            <li class="pina"><a href="eliminar.php">Eliminar Usuarios</a></li>
            <li class="pina"><a href="main.php">Página Principal</a></li>
        </ul>
    </nav>
    <main>
        <form action="../controllers/UsuarioController.php" method="POST" class="form-usuario">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido(s):</label>
                <input type="text" id="apellido" name="apellido" required>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="gmail" required>
            </div>

            <div class="form-group">
                <label for="dni">DNI:</label>
                <input type="text" id="dni" name="dni" placeholder="Ej: 12345678A" required>
            </div>

            <div class="form-group">
                <label for="familia">Familia/Departamento:</label>
                <input type="text" id="familia" name="familia" required>
            </div>

            <div class="form-group">
                <label for="rol">Rol:</label>
                <select id="rol" name="rol" required>
                    <option value="user">Usuario</option>
                    <option value="prof">Profesor</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>

            <button type="submit" name="action" value="create" class="btn-submit">Crear Usuario</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2026 Cyberbuild - Sistema de Gestión de Faltas</p>
    </footer>
</body>
</html>
