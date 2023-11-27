<?php
class Login{
    private $conn;
    public $id;
    public $usuario;
    public $password;

    public function __construct($db){
        $this->conn = $db;
    }

    // Create
    function createUser($nombre, $correo, $direccion, $contrasena){
        $query = "INSERT INTO clientes (nombre, correo, direccion, contraseña) VALUES ('$nombre', '$correo', '$direccion', ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $contrasena);
        $stmt->execute();
        return $stmt;
    }

    // Read
    function validateUser($correo, $contrasena){
        $query = "SELECT * FROM clientes WHERE correo = ? AND contraseña = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $correo);
        $stmt->bindParam(2, $contrasena);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update
    function updateUser($id, $nuevoCorreo, $nuevaContrasena){
        $query = "UPDATE clientes SET correo = ?, contraseña = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nuevoCorreo);
        $stmt->bindParam(2, $nuevaContrasena);
        $stmt->bindParam(3, $id);
        $stmt->execute();
        return $stmt;
    }

    // Delete
    function deleteUser($id){
        $query = "DELETE FROM clientes WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }
}
