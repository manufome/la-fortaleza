<?php
require_once 'Model/login.php';

class LoginController{
    private $model;
    
    public function __construct($conn){
        $this->model = new Login($conn);
    }
    
    public function index(){
        require_once 'View/login/login.php';
    }

    public function login(){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = $this->model->validateUser($email, $password);
        if($user){
            $_SESSION['user'] = $user;
            header('Location: index.php?controller=home&action=index');
        }else{
            $error = 'Usuario o contraseña incorrectos';
            require_once 'View/login/login.php';
        }
    }

    public function logout(){
        session_destroy();
        header('Location: index.php?controller=login&action=index');
    }

    public function register(){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        if($password == $confirmPassword){
            $user = $this->model->createUser($name, $email, $address, $password);
            var_dump($user);
            if($user){
                $_SESSION['user'] = $user;
                header('Location: index.php?controller=home&action=index');
            }else{
                $error_register = 'Error al registrar el usuario';
                require_once 'View/login/login.php';
            }
        }else{
            $error_register = 'Error al registrar el usuario';
            $register = true;
            require_once 'View/login/login.php';
        }
    }
}

