<?php

namespace App;

use PDO;

class ConnectDB
{
    private $host = "mysql";
    private $db_name = "test";
    private $username = "root";
    private $password = "root";
    public $conn;

    // получение соединения с базой данных
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $exception) {
            echo "Connection failed: " . $exception->getMessage();
        }

        return $this->conn;
    }
}