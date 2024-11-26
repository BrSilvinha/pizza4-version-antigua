<?php

class AuthController extends Controller
{
    public function login()
    {
        Session::init();

        // Si ya hay sesión iniciada, destruye la sesión
        if (Session::get('usuario_id')) {
            Session::destroy();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, [
                'email' => FILTER_SANITIZE_EMAIL,
                'contraseña' => FILTER_SANITIZE_STRING
            ]);

            // Obtener datos del usuario
            $data = [
                'email' => trim($_POST['email']),
                'contraseña' => trim($_POST['contraseña']),
                'error' => ''
            ];

            // Validar campos vacíos
            if (empty($data['email']) || empty($data['contraseña'])) {
                $data['error'] = 'Por favor, completa todos los campos.';
                $this->view('auth/login', $data);
                return;
            }

            // Cargar modelo de usuario
            $usuarioModel = $this->model('Usuario');

            // Verificar si el email existe
            if (!$usuarioModel->findUserByEmail($data['email'])) {
                $data['error'] = 'No se encontró una cuenta con ese correo electrónico.';
                $this->view('auth/login', $data);
                return;
            }

            // Intentar iniciar sesión
            $loggedInUser = $usuarioModel->login($data['email'], $data['contraseña']);

            if ($loggedInUser) {
                // Reiniciar intentos fallidos y crear sesión
                Session::set('login_attempts', 0);
                Session::set('usuario_id', $loggedInUser['id']);
                Session::set('usuario_email', $loggedInUser['email']);
                Session::set('usuario_nombre', $loggedInUser['nombre']);

                header('Location: ' . INICIO);
                exit();
            } else {
                // Manejar intento fallido
                if (!Session::get('login_attempts')) {
                    Session::set('login_attempts', 0);
                }

                Session::set('login_attempts', Session::get('login_attempts') + 1);

                if (Session::get('login_attempts') >= 5) {
                    $data['error'] = 'Demasiados intentos fallidos. Inténtalo más tarde.';
                } else {
                    $data['error'] = 'Contraseña incorrecta.';
                }

                $this->view('auth/login', $data);
            }
        } else {
            // Mostrar vista de inicio de sesión
            $this->view('auth/login');
        }
    }

    public function logout()
    {
        Session::init();
        Session::destroy();
        header('Location: ' . LOGIN);
        exit();
    }
}
