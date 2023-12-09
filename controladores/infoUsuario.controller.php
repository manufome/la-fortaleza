<?php
require_once 'modelos/usuario.php';

class InfoUsuarioController
{
    private $admin;
    private $model;

    public function __construct($conn)
    {
        $this->admin = isset($_GET['admin']) ? true : false;
        $this->model = new Usuario($conn);
    }

    public function index()
    {
        require_once 'vistas/header.php';
        require_once 'vistas/usuario/perfil.php';
    }

    public function update()
    {
        $id = $_SESSION['user']['id_cliente'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $direccion = $_POST['direccion'];
        $result = $this->model->updateUser($id, $nombre, $correo, $direccion);
        if ($result) {
            $_SESSION['user']['nombre'] = $nombre;
            $_SESSION['user']['correo'] = $correo;
            $_SESSION['user']['direccion'] = $direccion;
            $success = 'Datos actualizados correctamente';
        } else {
            $error = 'Error al actualizar los datos, el correo ya existe';
        }
        require_once 'vistas/header.php';
        require_once 'vistas/usuario/perfil.php';
    }

    public function updatePassword()
    {
        $id = $_SESSION['user']['id_usuario'];
        $oldPassword = $_SESSION['user']['contraseña'];
        $newPassword = $_POST['new-password'];
        $confirmPassword = $_POST['confirm-password'];

        if ($oldPassword != $_POST['old-password']) {
            $this->renderError('La contraseña actual es incorrecta');
            return;
        }

        if ($newPassword != $confirmPassword) {
            $this->renderError('Las contraseñas no coinciden');
            return;
        }

        if ($newPassword == $oldPassword) {
            $this->renderError('La nueva contraseña no puede ser igual a la anterior');
            return;
        }

        $result = $this->model->updatePassword($id, $newPassword);
        if (!$result) {
            $this->renderError('Error al actualizar la contraseña, intente de nuevo');
            return;
        }

        $_SESSION['user']['contraseña'] = $newPassword;
        $this->renderSuccess('Contraseña actualizada correctamente');
    }

    private function renderError($message)
    {
        $error = $message;
        require_once 'vistas/header.php';
        require_once 'vistas/usuario/perfil.php';
    }

    private function renderSuccess($message)
    {
        $success = $message;
        $_SESSION['user']['contraseña'] = $newPassword;
        require_once 'vistas/header.php';
        require_once 'vistas/usuario/perfil.php';
    }

}
