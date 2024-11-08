<?php
require_once '../config/config.php';
// require_once '../config/dot.php';
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Database.php';
require_once '../app/core/Model.php';
require_once '../app/core/Session.php';

// Inicializar sesiones
Session::init();

$app = new App();

?>

<script>
    if (window.location.pathname === '/PIZZA4/public/auth/login') {
    // Ocultar la barra lateral
    document.getElementById('sidebar-multi-level-sidebar').style.display = 'none';
}
</script>
<!--  -->
