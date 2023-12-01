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
    function createUser($nombre, $username, $correo, $direccion, $contrasena){

        $procedure = "CALL sp_registrar_cliente(?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($procedure);
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $username);
        $stmt->bindParam(3, $correo);
        $stmt->bindParam(4, $direccion);
        $stmt->bindParam(5, $contrasena);
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
        try{
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return false;
        }
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
