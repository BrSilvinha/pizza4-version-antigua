<?php

class AuthController extends Controller
{
    public function login()
    {
        Session::init();
        if (Session::get('usuario_id')) {
            Session::destroy();
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, [
                'email' => FILTER_SANITIZE_EMAIL,
                'contraseña' => FILTER_SANITIZE_STRING
            ]);

            // Get user input
            $data = [
                'email' => trim($_POST['email']),
                'contraseña' => trim($_POST['contraseña']),
                'error' => ''
            ];

            // Load user model
            $usuarioModel = $this->model('Usuario');

            // Check if email exists
            if (!$usuarioModel->findUserByEmail($data['email'])) {
                $data['error'] = 'No se encontró una cuenta con ese correo electrónico.';
                $this->view('auth/login', $data);
                return;
            }

            // Attempt to login user
            $loggedInUser = $usuarioModel->login($data['email'], $data['contraseña']);

            if ($loggedInUser) {
                // Create user session
                Session::init();
                Session::set('usuario_id', $loggedInUser['id']);
                Session::set('usuario_email', $loggedInUser['email']);
                Session::set('usuario_nombre', $loggedInUser['nombre']);
                header('Location: /PIZZA4/public/dashboard'); // Redirect to dashboard
                exit(); // Ensure no more code is executed after redirection
            } else {
                // Load view with error
                $data['error'] = 'Contraseña incorrecta.';
                $this->view('auth/login', $data);
            }
        } else {
            // Load login view
            $this->view('auth/login');
        }
    }

    public function logout()
    {
        Session::init();
        Session::destroy();
        header('Location: /PIZZA4/public/auth/login');
        exit();
    }
}
