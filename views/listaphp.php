<?php
/**
 * Vista: Lista de Profesores y Estadísticas de Coberturas
 */

require_once(__DIR__ . '/../config/Config.php');
require_once(__DIR__ . '/../helpers/Auth.php');
require_once(__DIR__ . '/../config/Database.php');
require_once(__DIR__ . '/../models/Ausencia.php');
require_once(__DIR__ . '/../models/Horario.php');

Auth::requireLogin();

$database = new Database();
$db = $database->getConnection();
$ausencia = new Ausencia($db);
$horario = new Horario($db);

// Obtener hora seleccionada
$selectedHora = isset($_GET['hora']) ? $_GET['hora'] : '';
$horas_disponibles = $horario->getDistinctHours();

// Obtener estadísticas
$stats = $ausencia->getCoverageStats();
?>
<!DOCTYPE html>
<html lang="es">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Profesores - Cyberbuild</title>
    <link rel="stylesheet" href="<?php echo PUBLIC_URL; ?>css/style.css">
    <link rel="icon" href="<?php echo PUBLIC_URL; ?>images/logo.PNG">
</head> 
<body>
    <header>
        <h1>Lista de Profesores - Estadísticas de Coberturas</h1>
    </header>
    <nav>
        <ul>
            <li class="pina"><a href="form_faltas.php">Solicitar Ausencia</a></li>
            <li class="pina"><a href="main.php">Página Principal</a></li>
            <li class="pina"><a href="personal.php">Mi Panel Personal</a></li>
        </ul>
    </nav>
    <main>
        <div class="search-section">
            <input type="text" id="busqueda" class="search-input" placeholder="Buscar por Nombre o DNI">
        </div>

        <!-- Filtro por hora -->
        <form method="get" class="filter-form">
            <label for="hora">Filtrar por Hora:</label>
            <select name="hora" id="hora">
                <option value="">-- Todas --</option>
                <?php if ($horas_disponibles && $horas_disponibles->num_rows > 0): ?>
                    <?php while ($h = $horas_disponibles->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($h['id_hora']); ?>" 
                            <?php echo $selectedHora === $h['id_hora'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($h['id_hora']); ?>
                        </option>
                    <?php endwhile; ?>
                <?php endif; ?>
            </select>
            <button type="submit" class="btn-filter">Filtrar</button>
            <?php if (!empty($selectedHora)): ?>
                <a href="listaphp.php" class="btn-clear">Limpiar Filtro</a>
            <?php endif; ?>
        </form>
        
        <h2>Resumen de Ausencias por Profesor</h2>
        
        <table id="tabla" class="stats-table">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Coberturas Realizadas</th>
                    <th>Ausencias Registradas</th>
                    <th>Ratio (%)</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($stats && $stats->num_rows > 0): ?>
                    <?php while ($row = $stats->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['dni']); ?></td>
                            <td><?php echo htmlspecialchars($row['nombre'] . ' ' . $row['apellido']); ?></td>
                            <td><strong><?php echo (int)$row['total_coberturas']; ?></strong></td>
                            <td><strong><?php echo (int)$row['total_ausencias']; ?></strong></td>
                            <td><?php echo $row['porcentaje_cobertura'] ? round($row['porcentaje_cobertura'], 2) . '%' : 'N/A'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">No hay datos disponibles</td>
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
        // Búsqueda en tiempo real
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
