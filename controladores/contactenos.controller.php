<?php
// Incluye la conexión y el modelo de productos
include_once 'modelos/database.php';

class ContactenosController{
    private $modelo;
    
    public function __construct($conn){
    }
    
    public function index(){
        require_once 'vistas/contactenos.php';
    }

    public function send_data(){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $to = "
        <p>Nombre: Ariel</p>
        <p>Email: arefome@gmail.com</p>
        <p>Mensaje: $message</p>
        ";
        $subject = "Contacto desde la página web";
        $headers = "From: $email\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf8\r\n";
        $success = mail($to, $subject, $headers);
        if($success){
            $message = 'Mensaje enviado correctamente';
        }else{
            $message = 'Error al enviar el mensaje';
        }
        require_once 'vistas/contactenos.php';
    }
}
