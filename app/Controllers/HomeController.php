<?php

class HomeController extends Controller
{
    public function index()
    {
        try {
            Session::init();

            if (!Session::get('usuario_id')) {
                header('Location: ' . SALIR);
                exit();
            }

            // Habilitar temporalmente el reporte de errores para depuración
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            $sedeModel = $this->model('Sede');
            $sedeCount = $sedeModel->countSedes();
            
            if ($sedeCount == 0) {
                header('Location: /PIZZA4/public/sede/registro');
                exit();
            }

            // Resto de tu código...

            // Verificar que los datos no sean null antes de pasarlos a la vista
            $data = [
                'usuariosCount' => $usuariosCount ?? 0,
                'clientesCount' => $clientesCount ?? 0,
                'pedidosCount' => $pedidosCount ?? 0,
                'productosCount' => $productosCount ?? 0,
                'pisoCount' => $pisoCount ?? 0,
                'rolesCount' => $rolesCount ?? 0,
                'mesasCount' => $mesasCount ?? 0,
                'categoriasCount' => $categoriasCount ?? 0,
                'totalPedidosPorEstado' => $totalPedidosPorEstado ?? [],
                'productosMasVendidos' => $productosMasVendidos ?? [],
                'usuario' => $usuario ?? null,
                'rolUsuario' => $rolUsuario ?? null,
            ];

            $this->view('dashboard', $data);

        } catch (Exception $e) {
            // Loguear el error
            error_log("Error en HomeController: " . $e->getMessage());
            // Mostrar una página de error amigable
            $this->view('error/500', ['message' => 'Ha ocurrido un error en el servidor']);
        }
    }
}