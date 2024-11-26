

<?php

class Controller
{
    public function model($model) // recibe el modelo que se quiere cargar 
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }


    public function view($view, $data = [])
{
    // Extraer los datos para hacerlos disponibles en la vista
    if (!empty($data)) {
        extract($data);
    }

    require_once '../app/core/Session.php';
    Session::init();

    // Definir la ruta base de las vistas
    $viewPath = '../app/Views/';

    // Verificar que los archivos existan antes de incluirlos
    if (file_exists($viewPath . 'inc/head.php')) {
        include_once $viewPath . 'inc/head.php';
    } else {
        die('Error: No se encuentra el archivo head.php');
    }

    if (file_exists($viewPath . 'inc/navbar.php')) {
        include_once $viewPath . 'inc/navbar.php';
    } else {
        die('Error: No se encuentra el archivo navbar.php');
    }

    if (file_exists($viewPath . 'inc/sidebar.php')) {
        include_once $viewPath . 'inc/sidebar.php';
    } else {
        die('Error: No se encuentra el archivo sidebar.php');
    }

    // Cargar la vista principal
    $mainView = $viewPath . $view . '.php';
    if (file_exists($mainView)) {
        require_once $mainView;
    } else {
        die('Error: No se encuentra la vista ' . $view);
    }

    if (Session::get('usuario_id')) {
        if (file_exists($viewPath . 'inc/footer.php')) {
            include_once $viewPath . 'inc/footer.php';
        }
    }

    if (file_exists($viewPath . 'inc/script.php')) {
        include_once $viewPath . 'inc/script.php';
    }

    if (file_exists($viewPath . 'inc/js/alertas.php')) {
        include_once $viewPath . 'inc/js/alertas.php';
    }
}
}

?>