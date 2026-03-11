<?php
/**
 * Vista: Historial de Ausencias del Año Académico
 */

require_once(__DIR__ . '/../config/Config.php');
require_once(__DIR__ . '/../helpers/Auth.php');
require_once(__DIR__ . '/../helpers/Utils.php');
require_once(__DIR__ . '/../config/Database.php');
require_once(__DIR__ . '/../models/Ausencia.php');

Auth::requireLogin();

$database = new Database();
$db = $database->getConnection();
$ausencia = new Ausencia($db);

$academic = Utils::getAcademicYear();
$resultado = $ausencia->getByAcademicYear();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Ausencias - Cyberbuild</title>
    <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>css/style.css">
    <link rel="icon" href="<?php echo PUBLIC_URL; ?>images/logo.PNG">
</head>
<body>
    <header>
        <h1>Historial de Ausencias</h1>
    </header>
    <nav>
        <ul>
            <li class="pina"><a href="form_faltas.php">Solicitar Ausencia</a></li>
            <li class="pina"><a href="main.php">Página Principal</a></li>
            <li class="pina"><a href="personal.php">Mi Panel Personal</a></li>
        </ul>
    </nav>
    <main>
        <div class="info-section">
            <h3>Historial del Año Académico</h3>
            <p>Mostrando ausencias del <strong><?php echo Utils::formatDate($academic['start']); ?></strong> 
               al <strong><?php echo Utils::formatDate($academic['end']); ?></strong></p>
        </div>
        
        <input type="text" id="busqueda" class="search-input" placeholder="Buscar Profesor">
        
        <table id="tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Profesor Ausente</th>
                    <th>Día</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Justificante</th>
                    <th>Hora</th>
                    <th>Tarea</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado && $resultado->num_rows > 0): ?>
                    <?php while ($row = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_a']); ?></td>
                            <td><?php echo htmlspecialchars($row['nombre'] . ' ' . $row['apellido']); ?></td>
                            <td><?php echo htmlspecialchars($row['dia_a']); ?></td>
                            <td><?php echo htmlspecialchars($row['dni']); ?></td>
                            <td><?php echo htmlspecialchars($row['gmail']); ?></td>
                            <td><?php echo $row['justificante'] ?? 'N/A'; ?></td>
                            <td><?php echo $row['hora_a'] ?? 'N/A'; ?></td>
                            <td><?php echo $row['tarea'] ?? 'N/A'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align:center;">No hay ausencias registradas</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2026 Cyberbuild - Sistema de Gestión de Faltas</p>
    </footer>
    <script src="<?php echo PUBLIC_URL; ?>js/main.js"></script>
    <script>
        const input = document.getElementById("busqueda");
        input.addEventListener("keydown", function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll("#tabla tbody tr");
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? "" : "none";
            });
        });
    </script>
</body>
</html>
