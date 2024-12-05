<?php
// Asegurarse que no hay salida previa
ob_start();

// Definir las constantes solo si no están definidas
if (!defined('TESTING')) {
    define('TESTING', true);
}

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

if (!defined('INICIO')) {
    define('INICIO', '/inicio');
}

if (!defined('LOGIN')) {
    define('LOGIN', '/login');
}

// Cargar configuración de base de datos de pruebas
require_once BASE_PATH . '/config/database.test.php';

// Load core classes
require_once BASE_PATH . '/app/core/App.php';
require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/core/Database.php';
require_once BASE_PATH . '/app/core/Model.php';
require_once BASE_PATH . '/app/core/Session.php';

// Load the controller and model being tested
require_once BASE_PATH . '/app/Controllers/AuthController.php';
require_once BASE_PATH . '/app/Models/Usuario.php';