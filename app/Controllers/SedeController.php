<?php

class SedeController extends Controller
{
    public function index()
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        } else {
            $sedeModel = $this->model('Sede');
            $sedes = $sedeModel->getAllSedes();

            $usuarioModel = $this->model('Usuario');
            $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
            $this->view('sede/index', ['sedes' => $sedes, 'rolUsuario' => $rolUsuario]);
        }
    }
    // mostrar sede por id  
    public function mostrar($id)
    {
        Session::init();
        // Verificar si el usuario está autenticado
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR . '');
            exit();
        } else {
            $sedeModel = $this->model('Sede');
            $sede = $sedeModel->getSedeById($id);
            $usuarioModel = $this->model('Usuario');
            $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
            $this->view('sede/mostrar', ['sede' => $sede, 'rolUsuario' => $rolUsuario]);
        }
    }

    public function registro()
    {
        Session::init();
        // Verificar si el usuario está autenticado
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR . '');
            exit();
        } else {
            $data = [];

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Get user input
                $data = [
                    'nombre' => trim($_POST['nombre']),
                    'direccion' => trim($_POST['direccion'])
                ];

                // se instancia el modelo de Sede para registrar la sede
                $sedeModel = $this->model('Sede');

                // se verifica si se pudo registrar la sede
                if ($sedeModel->createSede($data)) {
                    header('Location: ' . USER_CREATE);
                } else {
                    $data['error'] = 'Error al registrar la sede.';
                }
            }


            $usuarioModel = $this->model('Usuario');
            $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
            $this->view('sede/registro', $data + ['rolUsuario' => $rolUsuario]);
        }
    }
}
