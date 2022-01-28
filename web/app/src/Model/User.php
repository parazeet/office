<?php

namespace App\Model;

class User
{
    private $conn;
    private $table_name = "users";

    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function auth() {

    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name /*. " WHERE user_id = :user_id"*/);
        $stmt->execute(/*['user_id' => $userId]*/);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find($email) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE email = :email");
        $stmt->execute(['email' => $email]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create($data): bool
    {
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, email=:email, password=:password, created_at=:created_at";

        $stmt = $this->conn->prepare($query);

        $password = password_hash($data['password'], PASSWORD_BCRYPT);

        $stmt->bindParam(":name", $data['name']);
        $stmt->bindParam(":email", $data['email']);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":created_at", $this->created_at);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}