<?php
class VentasController extends Controller
{
    public function index()
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR . '');
            exit();
        }

        $usuarioModel = $this->model('Usuario');
        $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));

        $ventaModel = $this->model('ComprobanteVenta');
        $ventas = $ventaModel->getVentas();
        $this->view('ventas/index', ['ventas' => $ventas, 'rolUsuario' => $rolUsuario]);
    }
}
