<?php

class HomeController extends Controller
{
    public function index()
    {
        // Iniciar sesión si no está iniciada
        Session::init();
        // Verificar si el usuario está autenticado
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        }

        // Verificar si hay registros en la tabla `Sede`
        $sedeModel = $this->model('Sede');
        $sedeCount = $sedeModel->countSedes();

        if ($sedeCount == 0) {
            header('Location: /PIZZA4/public/sede/registro');
            exit();
        }

        // Obtener las cantidades de las entidades
        $usuarioModel = $this->model('Usuario');
        $clienteModel = $this->model('Cliente');
        $pedidoModel = $this->model('Pedido');
        $productoModel = $this->model('Producto');
        $pisoModel = $this->model('Piso');
        $rolModel = $this->model('Rol');
        $listMesasModel = $this->model('Mesa');
        $listCategoriasModel = $this->model('Categoria');
        // obtener los datos de la sede para mostrar en el dashboard
        $sede = $sedeModel->getSedeById(Session::get('sede_id'));

        $usuariosCount = $usuarioModel->countUsuarios();
        $clientesCount = $clienteModel->countClientes();
        $pedidosCount = $pedidoModel->countPedidos();
        $productosCount = $productoModel->countProductos();
        $pisoCount = $pisoModel->pisosCount();
        $rolesCount = $rolModel->contadorDeRoles();
        $mesasCount = $listMesasModel->mesasCount();
        $categoriasCount = $listCategoriasModel->categoriasCount();
        $totalPedidosPorEstado = $pedidoModel->getTotalPedidosPorEstado();
        $productosMasVendidos = $pedidoModel->getProductosMasVendidos();
        // obtenemos los datos del usuario autenticado para mostrar en el dashboard
        $usuarioId = Session::get('usuario_id');
        $usuario = $usuarioModel->getUsuarioById($usuarioId);
        $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado($usuarioId);

        // Pasar los datos a la vista
        $this->view('dashboard', [
            'usuariosCount' => $usuariosCount,
            'clientesCount' => $clientesCount,
            'pedidosCount' => $pedidosCount,
            'productosCount' => $productosCount,
            'pisoCount' => $pisoCount,
            'rolesCount' => $rolesCount,
            'mesasCount' => $mesasCount,
            'categoriasCount' => $categoriasCount,
            'totalPedidosPorEstado' => $totalPedidosPorEstado, // Pasar los datos como array asociativo
            'productosMasVendidos' => $productosMasVendidos,
            'usuario' => $usuario,
            'rolUsuario' => $rolUsuario,
        ]);
    }
}
