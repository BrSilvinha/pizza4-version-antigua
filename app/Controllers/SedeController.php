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

    // Mostrar sede por ID
    public function mostrar($id)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
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
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        } else {
            $data = [];

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitizar los datos de entrada
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Obtener los datos del formulario
                $data = [
                    'nombre' => trim($_POST['nombre']),
                    'direccion' => trim($_POST['direccion'])
                ];

                // Instanciar el modelo de Sede para registrar la sede
                $sedeModel = $this->model('Sede');

                // Verificar si se pudo registrar la sede
                if ($sedeModel->createSede($data)) {
                    header('Location: ' . SEDE_CREATE . '?success=Sede registrada correctamente');
                    exit();
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
