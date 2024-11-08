<?php
class ProductosController extends Controller
{
    public function index()
    {
        Session::init();
        // Verificar si el usuario está autenticado
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR . '');
            exit();
        } else {
            $productoModel = $this->model('Producto');
            $productos = $productoModel->getAllProductos();

            $usuarioModel = $this->model('Usuario');
            $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
            $this->view('productos/index', ['productos' => $productos, 'rolUsuario' => $rolUsuario]);
        }
    }

    public function create()
    {
        Session::init();
        // Verificar si el usuario está autenticado
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR . '');
            exit();
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'nombre' => trim($_POST['nombre']),
                    'descripcion' => trim($_POST['descripcion']),
                    'precio' => trim($_POST['precio']),
                    'disponible' => isset($_POST['disponible']) ? 1 : 0,
                    'categoria_id' => trim($_POST['categoria_id'])
                ];
                $productoModel = $this->model('Producto');
                if ($productoModel->createProducto($data)) {
                    header('Location: ' . PRODUCT . '?success= Producto registrado correctamente');
                    exit();
                } else {
                    header('Location: ' . PRODUCT . '?error= no se pudo registrar el producto correctamente');
                    exit();
                }
            } else {

                $usuarioModel = $this->model('Usuario');
                $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
                $categoriaModel = $this->model('Categoria');
                $categorias = $categoriaModel->getCategorias();
                $this->view('productos/create', ['categorias' => $categorias, 'rolUsuario' => $rolUsuario]);
            }
        }
    }

    public function edit($id)
    {
        Session::init();
        // Verificar si el usuario está autenticado
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR . '');
            exit();
        } else {
            $productoModel = $this->model('Producto');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'id' => $id,
                    'nombre' => trim($_POST['nombre']),
                    'descripcion' => trim($_POST['descripcion']),
                    'precio' => trim($_POST['precio']),
                    'disponible' => isset($_POST['disponible']) ? 1 : 0,
                    'categoria_id' => trim($_POST['categoria_id'])
                ];
                if ($productoModel->updateProducto($data)) {
                    header('Location: ' . PRODUCT . '?success= Producto actualizado correctamente');
                    exit();
                } else {
                    header('Location: ' . PRODUCT . '?error=Error al actualizar el producto');
                    exit();
                }
            } else {
                $producto = $productoModel->getProductoById($id);
                $categoriaModel = $this->model('Categoria');
                $categorias = $categoriaModel->getCategorias();

                $usuarioModel = $this->model('Usuario');
                $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
                $this->view('productos/edit', ['producto' => $producto, 'categorias' => $categorias, 'rolUsuario' => $rolUsuario]);
            }
        }
    }

    public function delete($id)
    {
        Session::init();
        // Verificar si el usuario está autenticado
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR . '');
            exit();
        } else {
            $productoModel = $this->model('Producto');
            if ($productoModel->deleteProducto($id)) {
                header('Location: ' . PRODUCT . '?success= Producto eliminado correctamente');
                exit();
            } else {
                header('Location: ' . PRODUCT . '?error= no se pudo eliminar el producto correctamente');
                exit();
            }
        }
    }
}
