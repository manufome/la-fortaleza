<?php

class Database {

    const server = "localhost";
    const username = "root";
    const password = "root";
    const dbname = "tienda";

    public static function connect() {
        try {
            $connection = new PDO(
                "mysql:host=" . self::server . ";dbname=" .
                self::dbname . ";charset=utf8",
                self::username,
                self::password
            );

            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;

        } catch (PDOException $e) {
            return "Failed " . $e->getMessage();
        }
    }

    public function close() {
        $this->connection = null;
    }
}
