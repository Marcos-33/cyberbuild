<?php
session_start();
require "auth.php";
requireAdmin();
timeSesion();

// Recuperar errores y datos anteriores si existen
$errores = $_SESSION['errores'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errores'], $_SESSION['old']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear usuarios</title>
    <link rel="stylesheet" href="css.css">
    <meta charset="UTF-8">
    <link rel="icon" href="media/logo.png">
</head>
<body>
<header>
    <h1>Crear usuarios</h1>
    <a href="main.php">
        <img id="cpifp" src="media/logo_cpifp.png">
    </a>
</header>
<?php include "navpriv.php"; ?>

<!-- Mostrar errores -->
<?php if (!empty($errores)): ?>
    <ul style="color:red;">
        <?php foreach ($errores as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="crear.php" method="POST">
    <nav>
        <input type="text" name="nombre" placeholder="Nombre" class="usuarios" required
               value="<?= htmlspecialchars($old['nombre'] ?? '') ?>">
        <br>
        <input type="text" name="apellido" placeholder="Apellidos" class="usuarios" required
               value="<?= htmlspecialchars($old['apellido'] ?? '') ?>">
        <br>
        <input type="email" name="gmail" placeholder="Correo Electronico" class="usuarios" required
               value="<?= htmlspecialchars($old['gmail'] ?? '') ?>">
        <br>
        <input type="text" name="dni" placeholder="DNI" class="usuarios" required
               value="<?= htmlspecialchars($old['dni'] ?? '') ?>" style="text-transform:uppercase;">
        <br>
        <input type="text" name="familia" placeholder="Familia" class="usuarios" required
               value="<?= htmlspecialchars($old['familia'] ?? '') ?>">
        <br>
        <label name="rol">Rol</label><br>
        <select id="rol" name="rol" required>
            <option value="user" <?= (isset($old['rol']) && $old['rol']==='user') ? 'selected' : '' ?>>Usuario</option>
            <option value="admin" <?= (isset($old['rol']) && $old['rol']==='admin') ? 'selected' : '' ?>>Administrador</option>
        </select>
        <br>
        <input type="password" name="contrasena" placeholder="Contraseña" class="usuarios" required>
        <br>
        <input type="submit" value="Enviar" class="send">
    </nav>
</form>

<footer>
    <p>&copy; 2008 Página web desarrollada por Cyberbuild</p>
</footer>
</body>
</html>