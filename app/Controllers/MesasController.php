<?php

class MesasController extends Controller
{
    public function index()
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . LOGIN);
            exit();
        }
        $mesaModel = $this->model('Mesa');
        $mesas = $mesaModel->getMesas();

        $usuarioModel = $this->model('Usuario');
        $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
        $this->view('mesas/index', ['mesas' => $mesas, 'rolUsuario' => $rolUsuario]);
    }

    public function create()
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . LOGIN);
            exit();
        }
        $pisoModel = $this->model('Piso');
        $pisos = $pisoModel->getPisos();

        $usuarioModel = $this->model('Usuario');
        $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'piso_id' => $_POST['piso_id'],
                'numero' => $_POST['numero'],
                'capacidad' => $_POST['capacidad']
            ];
            $mesaModel = $this->model('Mesa');
            if ($mesaModel->createMesa($data)) {
                header('Location: ' . TABLE  . $data['piso_id'] . '?success=Mesa creada correctamente: ' . $data['numero'] . '');
                exit();
            } else {
                header('Location: ' . TABLE  . $data['piso_id'] . '?error=nose pudo crear la mesa');
                exit();
            }
        } else {
            $this->view('mesas/create', ['pisos' => $pisos, 'rolUsuario' => $rolUsuario]);
        }
    }

    public function edit($id)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . LOGIN);
            exit();
        }
        $mesaModel = $this->model('Mesa');
        $pisoModel = $this->model('Piso');

        $usuarioModel = $this->model('Usuario');
        $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
        $pisos = $pisoModel->getPisos();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'piso_id' => $_POST['piso_id'],
                'numero' => $_POST['numero'],
                'capacidad' => $_POST['capacidad']
            ];
            if ($mesaModel->updateMesa($data)) {
                header('Location: ' . TABLE  . $data['piso_id'] . '?success=Mesa actualizada correctamente');
                exit();
            } else {
                header('Location: ' . TABLE  . $data['piso_id'] . '?error=nose pudo actualizada la mesa');
                exit();
            }
        } else {
            $mesa = $mesaModel->getMesaById($id);
            $this->view('mesas/edit', ['mesa' => $mesa, 'pisos' => $pisos, 'rolUsuario' => $rolUsuario]);
        }
    }

    public function delete($id)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . LOGIN);
            exit();
        }
        $mesaModel = $this->model('Mesa');
        $piso_id = $mesaModel->getMesaById($id);
        if ($mesaModel->deleteMesa($id)) {
            header('Location: ' . TABLE  . $piso_id['piso_id'] . '?success=Mesa eliminada correctamente');
            exit();
        } else {
            header('Location: ' . TABLE  . $piso_id['piso_id'] . '?error=Error al eliminar la mesa');
            exit();
        }
    }
}
