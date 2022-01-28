<?php

namespace App\Model;

class Cost
{
    private $conn;
    private $table_name = "costs";

    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->conn = $db;
        $this->created_at = $this->updated_at = date('Y-m-d H:i:s');
    }

    public function getAllCosts() {
        $stmt = $this->conn->prepare("SELECT SUM(sum) as 'sum' FROM " . $this->table_name . " 
            WHERE 
                user_id = :user_id AND type = 'costs'
            GROUP BY 'sum'");
        $stmt->execute(['user_id' => $_SESSION['id']]);

        return $stmt->fetchColumn();
    }

    public function getAllIncomes() {
        $stmt = $this->conn->prepare("SELECT SUM(sum) as 'sum' FROM " . $this->table_name . " 
            WHERE 
                user_id = :user_id AND type = 'income'
            GROUP BY 'sum'");
        $stmt->execute(['user_id' => $_SESSION['id']]);

        return $stmt->fetchColumn();
    }

    public function getLastTen() {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " 
            WHERE user_id = :user_id
            ORDER BY created_at DESC
            LIMIT 10");
        $stmt->execute(['user_id' => $_SESSION['id']]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    user_id=:user_id, sum=:sum, type=:type, comment=:comment, created_at=:created_at";

        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([
            ":user_id" => $_SESSION['id'],
            ":sum" => $data['sum'],
            ":type" => $data['type'],
            ":comment" => $data['comment'],
            ":created_at" => $this->created_at
        ])) {
            return true;
        }

        return false;
    }

    function update($id, $data)
    {
        if(false){
            return true;
        } else {
            return false;
        }
    }

    function delete($id)
    {
        if(false){
            return true;
        } else {
            return false;
        }
    }
}