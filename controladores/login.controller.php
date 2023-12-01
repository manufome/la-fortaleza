<?php
require_once 'modelos/login.php';

class LoginController{
    private $model;
    private $admin = false;
    
    public function __construct($conn){
        $this->model = new Login($conn);
        $this->admin = isset($_GET['admin']) ? true : false;
    }
    
    public function index(){
        if ($this->admin) {
            $admin = true;
        }
        require_once 'vistas/login/login.php';
    }

    public function login(){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $admin = isset($_POST['admin']) ? true : false;
        $user = $this->model->validateUser($email, $password, $admin);
        if($user){
            if ($admin) {
                $_SESSION['admin'] = $user;
                header('Location: index.php?controller=infoUsuario&action=index');
                return;
            }
            $_SESSION['user'] = $user;
            header('Location: index.php?controller=home&action=index');
        }else{
            $error = 'Usuario o contraseña incorrectos';
            require_once 'vistas/login/login.php';
        }
    }

    public function logout(){
        // Elimina la variable de sesión
        session_unset();
        // Elimina la sesión
        session_destroy();
        
        header('Location: index.php?controller=home&action=index');
    }

    public function register(){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        if($password == $confirmPassword){
            $user = $this->model->createUser($name, $email, $address, $password);
            if($user){
                $_SESSION['user'] = $user;
                header('Location: index.php?controller=home&action=index');
            }else{
                $error_register = 'Error al registrar el usuario';
                require_once 'vistas/login/login.php';
            }
        }else{
            $error_register = 'Las contraseñas no coinciden';
            $register = true;
            require_once 'vistas/login/login.php';
        }
    }
}

