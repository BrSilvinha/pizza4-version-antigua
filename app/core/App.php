<?php
class App
{
    // Valores por defecto para el controlador, método y parámetros
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        // Desactiva la notificación de errores
        error_reporting(0);

        // Parsea la URL
        $url = $this->parseUrl();

        // Comprueba si existe un controlador correspondiente al primer segmento de la URL
        if (isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);  // Elimina el segmento del controlador de la URL
        }

        // Carga el controlador
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Comprueba si existe un método correspondiente al segundo segmento de la URL
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);  // Elimina el segmento del método de la URL
            }
        }

        // Los segmentos restantes de la URL se convierten en parámetros
        $this->params = $url ? array_values($url) : [];

        // Llama al método del controlador con los parámetros
        if (method_exists($this->controller, $this->method)) {
            call_user_func_array([$this->controller, $this->method], $this->params);
        } else {
            // Si el método no existe, devuelve un error 404
            http_response_code(404);
            require_once '../app/Views/error/404.php';
        }
    }

    // Método para parsear la URL
    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            // Elimina la barra final, sanitiza la URL y la divide en segmentos
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];  // Devuelve un array vacío si no hay URL
    }
}
