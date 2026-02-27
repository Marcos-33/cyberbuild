<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css.css?v=1">
    <title>Recuperar contraseña</title>
</head>
<body>

<div class="recuperar1">
    <h2 class="recuperar2">Recuperar contraseña</h2>

    <form action="actualizar_simple.php" method="POST">
        <input type="text" name="dni" placeholder="DNI" class="recuperar3" required>
        <input type="email" name="gmail" placeholder="Correo" class="recuperar4" required>
        <input type="password" name="cont" placeholder="Nueva contraseña" class="recuperar5" required>
        <button type="submit" class="recuperar6">Actualizar contraseña</button>
        <a href="index.html" class="recuperar7">Volver a iniciar sesión</a>
    </form>
</div>

</body>
</html>