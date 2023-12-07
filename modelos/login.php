<?php
class Login
{
    private $conn;
    public $id;
    public $usuario;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create
    public function createUser($nombre, $username, $correo, $direccion, $contrasena)
    {

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
    public function validateUser($nombre_usuario, $contrasena, $admin)
    {
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
        } else {
            $rol = 'cliente';
        }
        $stmt->bindParam(3, $rol);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Update
    public function updateUser($id, $nombre_usuario, $nueva_contrasena)
    {
        $query = "UPDATE usuarios SET nombre_usuario = ?, contraseña = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nombre_usuario);
        $stmt->bindParam(2, $nueva_contrasena);
        $stmt->bindParam(3, $id);
        $stmt->execute();
        return $stmt;
    }

    // Delete
    public function deleteUser($id)
    {
        $query = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM clientes c, usuarios u WHERE c.correo = ? and c.id_cliente = u.id_cliente";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateToken($id, $token)
    {
        $query = "UPDATE usuarios SET reset_token = ? WHERE id_usuario = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $token);
        $stmt->bindParam(2, $id);
        $stmt->execute();
        return $stmt;
    }

    public function getUserByToken($token)
    {

        $query = "SELECT * FROM usuarios WHERE reset_token = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $token);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePassword($id, $password)
    {
        $query = "UPDATE usuarios SET contraseña = ?, reset_token = NULL WHERE id_usuario = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $password);
        $stmt->bindParam(2, $id);
        $stmt->execute();
        return $stmt;
    }
}
