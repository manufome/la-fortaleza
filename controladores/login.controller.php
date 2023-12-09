<?php
require_once 'modelos/usuario.php';
use PHPMailer\PHPMailer\PHPMailer;

require_once 'vendor/autoload.php';

class LoginController
{
    private $model;
    private $admin = false;

    public function __construct($conn)
    {
        $this->model = new Usuario($conn);
        $this->admin = isset($_GET['admin']) ? true : false;
    }

    public function index()
    {
        if ($this->admin) {
            $admin = true;
        }
        require_once 'vistas/login/login.php';
    }

    public function login()
    {
        $email = $_POST['username'];
        $password = $_POST['password'];
        $admin = isset($_POST['admin']) ? true : false;
        $user = $this->model->validateUser($email, $password, $admin);
        if ($user) {
            if ($admin) {
                $_SESSION['admin'] = $user;
                header('Location: index.php?controller=inventario&action=index');
                return;
            }
            $_SESSION['user'] = $user;
            header('Location: index.php?controller=home&action=index');
        } else {
            $error = 'Usuario o contraseña incorrectos';
            require_once 'vistas/login/login.php';
        }
    }

    public function logout()
    {
        // Elimina la variable de sesión
        session_unset();
        // Elimina la sesión
        session_destroy();

        header('Location: index.php?controller=home&action=index');
    }

    public function register()
    {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        if ($password == $confirmPassword) {
            $user = $this->model->createUser($name, $username, $email, $address, $password);
            if ($user) {
                $this->login();
            } else {
                $error_register = 'El usuario o el correo ya existen';
                require_once 'vistas/login/login.php';
            }
        } else {
            $error_register = 'Las contraseñas no coinciden';
            $register = true;
            require_once 'vistas/login/login.php';
        }
    }

    public function recuperar()
    {
        require_once 'vistas/login/recuperar.php';
    }

    public function enviarCorreo()
    {
        $email = $_POST['email'];
        $user = $this->model->getUserByEmail($email);
        if ($user) {
            try {
                $mail = new PHPMailer(true);
                $token = bin2hex(random_bytes(16));
                //Server settings
                $mail->isSMTP(); //Send using SMTP
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'lafortaleza.soporte@gmail.com';
                $mail->Password = ''; //Poner la contraseña de la cuenta de gmail ejemplo: '123456789'
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                //Recipients
                $mail->setFrom('lafortaleza.soporte@gmail.com');
                $mail->addAddress($email, $user['nombre']);

                //Content
                $mail->isHTML(true); //Set email format to HTML
                $url = 'http://' . $_SERVER['HTTP_HOST'] . '/index.php?controller=login&action=cambiarContrasena&token=' . $token;
                $templateContent = file_get_contents('vistas/templates/recuperar_cuenta.php');
                $templateContent = str_replace('{{url}}', $url, $templateContent);
                $mail->Subject = utf8_decode('Recuperación de contraseña');
                $mail->Body = $templateContent;
                $mail->AltBody = 'This is a plain-text message body';
                $mail->send();
                $this->model->updateToken($user['id_usuario'], $token);
                $success = 'Se ha enviado un correo a ' . $email . ' con un enlace para recuperar la contraseña';
                require_once 'vistas/login/login.php';
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            $error = 'El correo no existe';
            require_once 'vistas/login/recuperar.php';
        }
    }

    public function cambiarContrasena()
    {
        $token = $_GET['token'];
        $user = $this->model->getUserByToken($token);
        if ($user) {
            require_once 'vistas/login/cambiar_contrasena.php';
        } else {
            require_once 'vistas/errores/error404.php';
        }
    }

    public function actualizarContrasena()
    {
        $token = $_POST['token'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        if ($password == $confirmPassword) {
            $user = $this->model->getUserByToken($token);
            if ($user) {
                $this->model->updatePassword($user['id_usuario'], $password);
                $success = 'Se ha actualizado la contraseña';
                require_once 'vistas/login/login.php';
            } else {
                require_once 'vistas/errores/error404.php';
            }
        } else {
            $error = 'Las contraseñas no coinciden';
            require_once 'vistas/login/cambiar_contrasena.php';
        }
    }
}
