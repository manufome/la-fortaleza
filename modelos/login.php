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
        $query = "INSERT INTO usuarios (nombre_usuario, contraseña, rol, id_cliente, id_empleado) VALUES ('$nombre', '$correo', '$direccion', '$contrasena')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $correo);
        $stmt->bindParam(3, $direccion);
        $stmt->bindParam(4, $contrasena);
        $stmt->execute();
        return $stmt;
    }

    // Read
    function validateUser($nombre_usuario, $contrasena, $admin){
        $query = "SELECT U.*, C.*, E.*
                    FROM usuarios U
                    LEFT JOIN clientes C ON U.id_cliente = C.id_cliente
                    LEFT JOIN empleados E ON U.id_empleado = E.id_empleado
                    WHERE U.nombre_usuario = ? AND U.contraseña = ? AND U.rol = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nombre_usuario);
        $stmt->bindParam(2, $contrasena);
        if ($admin) {
            $rol = 'admin';
        }else{
            $rol = 'cliente';
        }
        $stmt->bindParam(3, $rol);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update
    function updateUser($id, $nombre_usuario, $nueva_contrasena){
        $query = "UPDATE usuarios SET nombre_usuario = ?, contraseña = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nombre_usuario);
        $stmt->bindParam(2, $nueva_contrasena);
        $stmt->bindParam(3, $id);
        $stmt->execute();
        return $stmt;
    }

    // Delete
    function deleteUser($id){
        $query = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }
}
