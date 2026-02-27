<?php
require "auth.php";
requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Página principal</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <header>
        <h1>cyberbuild</h1>
        <a href="index.html">Volver al login</a>
    </header>
    <nav>
        <ul>
            <li class="pina"><a href="form_faltas.php">Solicitar ausencia</a></li>
            <li class="pina"><a href="listaphp.php">Lista profesores</a></li>
            <li class="pina"><a href="conexion.php">Conexion</a></li>
            <!--Esto es para probar -DRR -->
            <li class="pina"><a href="admin_panel.php">Panel Admin</a></li>
        </ul>
    </nav>
    <main>
        <form action="log-out.php" method="post">
        <button id="close" type="submit">Cerrar sesión</button>
        </form>
        <table>
            <!-- Fila 1 -->
            <tr>
                <th>Profesores/as ausentes</th>
                <th>Clase</th>
                <th>Hora</th>
                <th>Familia</th>
                <th>Modulo</th>
                <th>Tarea</th>
                <th>Apuntarse</th>
            </tr>
            <!-- Fila 2 -->
            <tr>
                <td></td>
                <td></td>
                <td>1ª</td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" name="check1"></td>
            </tr>
            <!-- Fila 3 -->
            <tr>
                <td></td>
                <td></td>
                <td>2ª</td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" name="check2"></td>
            </tr>
            <!-- Fila 4 -->
            <tr>
                <td></td>
                <td></td>
                <td>3ª</td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" name="check3"></td>
            </tr>
            <!-- Fila 5 -->
            <tr>
                <td></td>
                <td></td>
                <td>4ª</td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" name="check4"></td>
            </tr>
            <!-- Fila 6 -->
            <tr>
                <td></td>
                <td></td>
                <td>5ª</td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" name="check5"></td>
            </tr>
            <!-- Fila 7 -->
            <tr>
                <td></td>
                <td></td>
                <td>6ª</td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" name="check6"></td>
            </tr>
        </table>
    </main>
    <footer>
        <p>&copy; 2026 Desarrolleision pagination</p>
    </footer>
    </body>
</html> 