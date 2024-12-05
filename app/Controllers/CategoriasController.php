<?php

class CategoriasController extends Controller
{
    public function index()
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            if (defined('TESTING') && TESTING === true) {
                return null;
            }
            header('Location: ' . SALIR);
            exit();
        }
        
        $categoriaModel = $this->model('Categoria');
        $categorias = $categoriaModel->getCategorias();
        
        if (defined('TESTING') && TESTING === true) {
            return $categorias;
        }
        
        $usuarioModel = $this->model('Usuario');
        $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
        $this->view('categorias/index', ['categorias' => $categorias, 'rolUsuario' => $rolUsuario]);
    }

    public function create()
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = ['nombre' => trim($_POST['nombre'])];
                $categoriaModel = $this->model('Categoria');
                if ($categoriaModel->createCategoria($data)) {
                    header('Location: /PIZZA4/public/categorias?success= categoria creada correctamente');
                } else {
                    $data['error'] = 'Error al crear la categoría.';
                    $this->view('categorias/create?error= error al registrada la categoría.');
                }
            } else {

                $usuarioModel = $this->model('Usuario');
                $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
                $this->view('categorias/create', ['rolUsuario' => $rolUsuario]);
            }
        }
    }

    public function edit($id)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        } else {
            $categoriaModel = $this->model('Categoria');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'id' => $id,
                    'nombre' => trim($_POST['nombre'])
                ];
                if ($categoriaModel->updateCategoria($data)) {
                    header('Location: /PIZZA4/public/categorias?success= categoria actualizada correctamente');
                    exit();
                } else {
                    $this->view('categorias/edit?error= Error al actualizar la categoría');
                    exit();
                }
            } else {
                $categoria = $categoriaModel->getCategoriaById($id);

                $usuarioModel = $this->model('Usuario');
                $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
                $this->view('categorias/edit', ['categoria' => $categoria, 'rolUsuario' => $rolUsuario]);
            }
        }
    }

    public function delete($id)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        } else {
            $categoriaModel = $this->model('Categoria');
            if ($categoriaModel->deleteCategoria($id)) {
                header('Location: /PIZZA4/public/categorias?success= categoria elimanda correctamente');
                exit();
            } else {
                $this->view('categorias/index?error= Error al eliminar la categoría.');
                exit();
            }
        }
    }
}
