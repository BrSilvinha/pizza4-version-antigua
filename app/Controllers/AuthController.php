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
            if (defined('TESTING') && TESTING === true) {
                $postData = $_POST;
            } else {
                $postData = filter_input_array(INPUT_POST, [
                    'email' => FILTER_SANITIZE_EMAIL,
                    'contraseña' => FILTER_SANITIZE_STRING
                ]) ?: [];
            }

            $data = [
                'email' => trim($postData['email'] ?? ''),
                'contraseña' => trim($postData['contraseña'] ?? ''),
                'error' => ''
            ];

            if (empty($data['email']) || empty($data['contraseña'])) {
                if (defined('TESTING') && TESTING === true) {
                    return 'Por favor, completa todos los campos.';
                }
                $data['error'] = 'Por favor, completa todos los campos.';
                $this->view('auth/login', $data);
                return;
            }

            $usuarioModel = $this->model('Usuario');

            if (!$usuarioModel->findUserByEmail($data['email'])) {
                if (defined('TESTING') && TESTING === true) {
                    return 'No se encontró una cuenta con ese correo electrónico.';
                }
                $data['error'] = 'No se encontró una cuenta con ese correo electrónico.';
                $this->view('auth/login', $data);
                return;
            }

            $loggedInUser = $usuarioModel->login($data['email'], $data['contraseña']);

            if ($loggedInUser) {
                Session::set('login_attempts', 0);
                Session::set('usuario_id', $loggedInUser['id']);
                Session::set('usuario_email', $loggedInUser['email']);
                Session::set('usuario_nombre', $loggedInUser['nombre']);

                if (defined('TESTING') && TESTING === true) {
                    return INICIO;
                }
                header('Location: ' . INICIO);
                exit();
            } else {
                $login_attempts = Session::get('login_attempts');
                $login_attempts = $login_attempts !== false ? $login_attempts : 0;
                Session::set('login_attempts', $login_attempts + 1);

                if ($login_attempts >= 5) {
                    if (defined('TESTING') && TESTING === true) {
                        return 'Demasiados intentos fallidos. Inténtalo más tarde.';
                    }
                    $data['error'] = 'Demasiados intentos fallidos. Inténtalo más tarde.';
                } else {
                    if (defined('TESTING') && TESTING === true) {
                        return 'Contraseña incorrecta.';
                    }
                    $data['error'] = 'Contraseña incorrecta.';
                }

                $this->view('auth/login', $data);
            }
        } else {
            if (!defined('TESTING')) {
                $this->view('auth/login');
            }
        }
    }

    public function logout()
    {
        Session::init();
        Session::destroy();
        
        if (defined('TESTING') && TESTING === true) {
            return LOGIN;
        }
        header('Location: ' . LOGIN);
        exit();
    }
}