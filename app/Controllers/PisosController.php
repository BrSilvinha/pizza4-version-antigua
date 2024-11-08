<?php

class PisosController extends Controller
{
    public function index()
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR . '');
            exit();
        }

        $pisoModel = $this->model('Piso');
        $pisos = $pisoModel->getPisosWithMesasCount();

        $usuarioModel = $this->model('Usuario');
        $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
        $this->view('pisos/index', ['pisos' => $pisos, 'rolUsuario' => $rolUsuario]);
    }

    public function create()
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR . '');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'sede_id' => $_POST['sede_id']
            ];
            $pisoModel = $this->model('Piso');
            if ($pisoModel->createPiso($data)) {
                header('Location: ' . PISOS . '?success=Piso registrado correctamente');
                exit();
            } else {
                header('Location: ' . PISOS . '?error=Piso registrado correctamente');
                exit();
            }
        } else {
            $sedeModel = $this->model('Sede');
            $sedes = $sedeModel->getAllSedes();
            $usuarioModel = $this->model('Usuario');
            $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
            $this->view('pisos/create', ['sedes' => $sedes, 'rolUsuario' => $rolUsuario]);
        }
    }
    public function edit($id)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        }

        $pisoModel = $this->model('Piso');
        $piso = $pisoModel->getPisoById($id); // Obtener los detalles del piso

        $usuarioModel = $this->model('Usuario');
        $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));

        if (!$piso) {
            header('Location: ' . PISOS . '?error=No se encontró el piso.');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'nombre' => $_POST['nombre'],
                'sede_id' => $_POST['sede_id']
            ];
            if ($pisoModel->updatePiso($data)) {
                header('Location: ' . PISOS . '?success=Piso actualizado correctamente');
                exit();
            } else {
                header('Location: ' . PISOS . '?error=nose pudo actualizar el piso correctamente');
                exit();
            }
        }
        // Solo obtenemos las sedes si estamos mostrando el formulario de edición
        $sedeModel = $this->model('Sede');
        $sedes = $sedeModel->getAllSedes();
        $this->view('pisos/edit', ['piso' => $piso, 'sedes' => $sedes, 'rolUsuario' => $rolUsuario]);
    }

    public function delete($id)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        }

        $pisoModel = $this->model('Piso');
        if ($pisoModel->deletePiso($id)) {
            header('Location: ' . PISOS . '?success=Piso eliminado correctamente');
            exit();
        } else {
            header('Location: ' . PISOS . '?error=No se pudo eliminar el piso');
            exit();
        }
    }
    public function mesas($id)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        }

        $pisoModel = $this->model('Piso');
        $piso = $pisoModel->getPisoById($id);
        $mesaModel = $this->model('Mesa');
        $mesas = $mesaModel->getMesasByPisoId($id);
        $usuarioModel = $this->model('Usuario');
        $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
        $this->view('pisos/mesas', ['piso' => $piso, 'mesas' => $mesas, 'rolUsuario' => $rolUsuario]);
    }
}
