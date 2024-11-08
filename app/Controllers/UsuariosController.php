<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

            // if ($usuarioModel->findUserByEmail($data['email'])) {
            //     $data['error'] = 'El correo electrónico ya está registrado.';
            //     $rolModel = $this->model('Rol');
            //     $data['roles'] = $rolModel->getAllRoles();
            //     $this->view('usuarios/create', $data);
            //     return;
            // }

            try {
                $persona_id = $personaModel->create($data['nombre'], $data['email'], $data['telefono'], $data['direccion'], $data['dni']);

                $data2 = [
                    'persona_id' => $persona_id,
                    'contrasena' => $data['contrasena']
                ];

                $usuario_id = $usuarioModel->createUsuario($data2);

                // Asignar rol al usuario
                $listRolesModel->assignRole($usuario_id, $data['rol_id']);

                $dataCorreo = [
                    'cliente_nombre' => $data['nombre'],
                    'cliente_email' => $data['email'],
                    'cliente_contrasena' => $_POST['contrasena']
                ];

                $resultado = $this->enviarCorreo($dataCorreo);

                if ($resultado !== null) {
                    header('Location: ' . USER . '?success=correo enviado con exito');
                    exit(); // si no se pone el exit no se redirecciona con el mensaje de éxito
                } else {
                    // Redireccionar a la lista de usuarios con un mensaje de error
                    header('Location: ' . USER . '?error=no se pudo enviar el correo');
                    exit();
                }
                header('Location: ' . USER . '?success=Usuario creado con éxito');
                exit();
                return;
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
    public function enviarCorreo($datos)
    {
        Session::init();
        if (!Session::get('usuario_id')) {
            header('Location: ' . SALIR);
            exit();
        }
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = USERNAME;
            $mail->Password   = CONTRASENA;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->setFrom(USERNAME, NOMBRE_EMPRE);
            $mail->addAddress($datos['cliente_email'], $datos['cliente_nombre']);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Bienvenido a ' . NOMBRE_EMPRE . ' - Datos de tu cuenta';
            $mail->Body    = $this->generarContenidoHTML($datos);

            $mail->send();
            return 'Correo enviado exitosamente';
        } catch (Exception $e) {
            error_log('Error al enviar el correo: ' . $mail->ErrorInfo);
            return null;
        }
    }

    private function generarContenidoHTML($datos)
    {
        $html = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Datos de Cuenta - ' . NOMBRE_EMPRE . '</title>
            <style>
                body, html {
                    height: 100%;
                    margin: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background-color: #f0f0f0;
                    font-family: Arial, sans-serif;
                }
                .card {
                    display: flex;
                    flex-direction: column;
                    background-color: #fff;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    border-radius: 8px;
                    overflow: hidden;
                    width: 90%;
                    max-width: 800px;
                }
                .image {
                    height: 200px;
                    background-image: url(\'https://img.freepik.com/foto-gratis/pizza-espagueti-tomate-aceitunas-vista-superior-maiz-sobre-fondo-azul-oscuro_176474-4616.jpg?t=st=1720318966~exp=1720322566~hmac=abef29e79dbdeffaab5fdd68d0244982445c5262edef20f28410f9d162acfc6a&w=1800\');
                    background-size: cover;
                    background-position: center;
                }
                .account-info {
                    padding: 32px;
                    background-color: #f8f8f8;
                    color: #333;
                }
                .account-info h2 {
                    margin-top: 0;
                    color: #c82333;
                }
                .account-info p {
                    margin-bottom: 16px;
                }
                .account-info .label {
                    font-weight: bold;
                    color: #6c757d;
                }
                .account-info .value {
                    color: #343a40;
                }
                .important {
                    color: #FF4500;
                    font-weight: bold;
                }
                @media (min-width: 768px) {
                    .card {
                        flex-direction: row;
                    }
                    .image {
                        flex-basis: 30%;
                        height: auto;
                    }
                    .account-info {
                        flex-basis: 70%;
                    }
                }
            </style>
        </head>
        <body>
            <div class="card">
                <div class="image"></div>
                <div class="account-info">
                    <h2>Datos de tu cuenta</h2>
                    <p><span class="label">Nombre:</span> <span class="value">' . htmlspecialchars($datos['cliente_nombre'], ENT_QUOTES, 'UTF-8') . '</span></p>
                    <p><span class="label">Email:</span> <span class="value">' . htmlspecialchars($datos['cliente_email'], ENT_QUOTES, 'UTF-8') . '</span></p>
                    <p><span class="label">Contraseña:</span> <span class="value">' . htmlspecialchars($datos['cliente_contrasena'], ENT_QUOTES, 'UTF-8') . '</span></p>
                    <p>Puedes iniciar sesión en nuestra plataforma usando tu email y contraseña.</p>
                    <p class="important">Por seguridad, te recomendamos cambiar tu contraseña después de tu primer inicio de sesión.</p>
                    <p>¡Gracias por unirte a ' . NOMBRE_EMPRE . '! </p>
                </div>
            </div>
        </body>
        </html>';
        return $html;
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
