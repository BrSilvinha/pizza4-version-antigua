<?php
class UsuariosController extends Controller
{
    public function index()
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR . '');
            exit();
        } else {
            $usuarioModel = $this->model('Usuario');
            $usuarios = $usuarioModel->getUsuarios();
            $usuarioModel = $this->model('Usuario');
            $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
            $this->view('usuarios/index', ['usuarios' => $usuarios, 'rolUsuario' => $rolUsuario]);
        }
    }

    public function create()
{
    Session::init();
    if (!Session::get('usuario_id')) {
        header('Location: ' . SALIR);
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
            'nombre' => isset($_POST['nombre']) ? $_POST['nombre'] : null,
            'email' => isset($_POST['email']) ? $_POST['email'] : null,
            'telefono' => isset($_POST['telefono']) ? $_POST['telefono'] : null,
            'direccion' => isset($_POST['direccion']) ? $_POST['direccion'] : null,
            'contrasena' => password_hash($_POST['contrasena'], PASSWORD_DEFAULT),
            'rol_id' => $_POST['rol_id'],
            'dni' => $_POST['dni']
        ];
        $personaModel = $this->model('Persona');
        $usuarioModel = $this->model('Usuario');
        $listRolesModel = $this->model('ListRoles');

        try {
            $persona_id = $personaModel->create($data['nombre'], $data['email'], $data['telefono'], $data['direccion'], $data['dni']);

            $data2 = [
                'persona_id' => $persona_id,
                'contrasena' => $data['contrasena']
            ];

            $usuario_id = $usuarioModel->createUsuario($data2);

            // Asignar rol al usuario
            $listRolesModel->assignRole($usuario_id, $data['rol_id']);

            // Redireccionar con un mensaje de éxito
            header('Location: ' . USER . '?success=Usuario creado con éxito');
            exit();
        } catch (Exception $e) {
            $data['error'] = $e;
            $rolModel = $this->model('Rol');
            $data['roles'] = $rolModel->getAllRoles();
            $this->view('usuarios/create', $data);
        }
    } else {
        $rolModel = $this->model('Rol');
        $roles = $rolModel->getAllRoles();

        $usuarioModel = $this->model('Usuario');
        $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
        $this->view('usuarios/create', ['roles' => $roles, 'rolUsuario' => $rolUsuario]);
    }
}



    public function edit($id)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR . '');
            exit();
        } else {
            $usuarioModel = $this->model('Usuario');
            $personaModel = $this->model('Persona');
            $listRolesModel = $this->model('ListRoles');
            $rolModel = $this->model('Rol');

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'id' => $id,
                    'nombre' => $_POST['nombre'],
                    'email' => $_POST['email'],
                    'telefono' => $_POST['telefono'],
                    'direccion' => $_POST['direccion'],
                    'dni' => $_POST['dni'],
                    'contrasena' => !empty($_POST['contrasena']) ? password_hash($_POST['contrasena'], PASSWORD_DEFAULT) : null,
                    'rol_id' => $_POST['rol_id']
                ];
                try {
                    // Actualizar datos de la persona
                    $persona_id = $usuarioModel->getPersonaIdByUsuarioId($id);
                    $personaModel->update($persona_id, $data['nombre'], $data['email'], $data['telefono'], $data['direccion'], $data['dni']);

                    // Actualizar datos del usuario
                    $usuarioData = [
                        'id' => $id,
                        'persona_id' => $persona_id,
                        'contrasena' => $data['contrasena']
                    ];
                    $usuarioModel->updateUsuarioContrasenia($usuarioData);

                    // Actualizar el rol del usuario
                    $listRolesModel->updateRole($id, $data['rol_id']);

                    header('Location: ' . USER . '?success=Usuario actualizado con éxito');
                    exit();
                } catch (Exception $e) {
                    $data['error'] = $e->getMessage();
                    $roles = $rolModel->getAllRoles();
                    $usuario = $usuarioModel->getUsuarioById($id);
                    $this->view('usuarios/edit', ['usuario' => $usuario, 'roles' => $roles, 'error' => $data['error']]);
                }
            } else {
                $usuario = $usuarioModel->getUsuarioById($id);
                $roles = $rolModel->getAllRoles();
                $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));

                $this->view('usuarios/edit', ['usuario' => $usuario, 'roles' => $roles, 'rolUsuario' => $rolUsuario]);
            }
        }
    }

    public function delete($usuarioId)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR . '');
            exit();
        }

        try {
            $listRolesModel = $this->model('ListRoles');
            $usuarioModel = $this->model('Usuario');
            $personaModel = $this->model('Persona');

            // Obtener persona_id del usuario
            $usuario = $usuarioModel->getUsuarioById($usuarioId);
            $personaId = $usuario['persona_id'];

            // Eliminar roles asociados al usuario
            $listRolesModel->deleteRolesByUsuarioId($usuarioId);

            // Eliminar el usuario
            $usuarioModel->deleteUsuario($usuarioId);

            // Eliminar los datos personales
            $personaModel->deletePersona($personaId);

            // Redireccionar a la lista de usuarios con un mensaje de éxito
            header('Location: ' . USER . '?success=Usuario eliminado con éxito');
            exit();
        } catch (Exception $e) {
            // Redireccionar a la lista de usuarios con un mensaje de error
            header('Location: ' . USER . '?error= error al eliminar el usuario ');
            exit();
        }
    }

    public function cuentaUsuario($id)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR . '');
            exit();
        } else {
            $usuarioModel = $this->model('Usuario');
            $usuario = $usuarioModel->getUsuarioById($id);
            if ($usuario) {
                $rolUsuario = $usuarioModel->getRolesUsuarioAutenticado(Session::get('usuario_id'));
                $this->view('cuenta/index', ['usuario' => $usuario, 'rolUsuario' => $rolUsuario]);
            }
        }
    }
}
