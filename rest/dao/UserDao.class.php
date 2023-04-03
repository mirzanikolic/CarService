<?php

class UserDao {

    private $conn;
    private $host = 'localhost';
    private $database = 'carservice';
    private $username = 'root';
    private $password = '';
   
    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    function query($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }
    function getUsers() {
        $stmt = $this->query("SELECT * FROM Users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function getUserById($id) {
        $stmt = $this->query("SELECT * FROM Users WHERE id = :id", ["id" => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function addUser($user) {
        $this->query("INSERT INTO Users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)", $user);
        $user['id'] = $this->conn->lastInsertId();
        return $user;
    }
    function updateUser($id, $user) {
        $this->query("UPDATE Users SET first_name = :first_name, last_name = :last_name, email = :email, password = :password WHERE id = :id", array_merge(["id" => $id], $user));
        echo "User updated successfully <br>";
    }
    function deleteUser($id) {
        $this->query("DELETE FROM Users WHERE id = :id", ["id" => $id]);
        echo "User deleted successfully <br>";
    }
}

?>
