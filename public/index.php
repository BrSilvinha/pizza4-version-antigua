<?php
// Habilitar reporte de errores para desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar que los archivos necesarios existan
$requiredFiles = [
    '../config/config.php',
    '../app/core/App.php',
    '../app/core/Controller.php',
    '../app/core/Database.php',
    '../app/core/Model.php',
    '../app/core/Session.php'
];

foreach ($requiredFiles as $file) {
    if (!file_exists($file)) {
        die("Error: No se encuentra el archivo $file");
    }
    require_once $file;
}

// Inicializar sesiones
Session::init();

// Inicializar la aplicación
try {
    $app = new App();
} catch (Exception $e) {
    error_log("Error al inicializar la aplicación: " . $e->getMessage());
    die("Error al cargar la aplicación");
}

// Mover el script a un archivo separado
?>
<!DOCTYPE html>
<html>
<head>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Verificar si estamos en la página de login
            if (window.location.pathname === '<?php echo LOGIN; ?>') {
                const sidebar = document.getElementById('sidebar-multi-level-sidebar');
                if (sidebar) {
                    sidebar.style.display = 'none';
                }
            }
        });
    </script>
</head>
</html>