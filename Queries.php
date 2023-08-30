<?php
include_once "Connection.php";

class Queries{

    public $db;


    function __construct(){
        $this->db= new Connection();
    }

    function loginUser($email, $password){
        try {
            $sql = $this->db->conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
            $sql->bindValue(":email", $email);
            $sql->bindValue(":password", $password);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return ["success" => true, "errorMessage" => "", "result" => $result];
        } catch (PDOException $e) {
            return ["success" => false, "errorMessage" => $e, "result" => []];
        }
    }


}