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

    function registerFunction($username, $email, $password){
        try{
            $sql = $this->db->conn->prepare("INSERT INTO users (user_name, email, password, user_type) VALUES (:username, :email, :password, 0)");
            $sql->bindValue(":username", $username);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":password", $password);
            $sql->execute();
            $result = $sql;
            return ["success" => true, "errorMessage" => "", "result" => $result];
        }catch (PDOExpection $e){
            return ["success" => false, "errorMessage" => "$e", "result" => []];
        }
    }

    function cookiesFunction($emails){
        $sql=$this->db->conn->prepare("SELECT * FROM users WHERE email = :email ");
        $sql->bindValue(":email", $emails);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    function pizzaFunction(){
        $sql= $this->db->conn->prepare("SELECT * FROM pizzak LEFT JOIN pizzak_url ON(pizzak.pazon = pizzak_url.product_id)");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function courierFunction(){
        $sql = $this->db->conn->prepare("SELECT * FROM futar");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    function orderFunction($id, $pizzaNev, $pizzaAr){
        $sql = $this->db->conn->prepare("INSERT INTO orderbag (pizza_azonosito, pizza_nev, pizza_ar) VALUES(:pizzaId, :pizzaNev, :pizzaAr)");
        $sql->bindValue(":pizzaId", $id);
        $sql->bindValue(":pizzaaNev", $pizzaNev);
        $sql->bindValue(":pizzaAr", $pizzaAr);
        $result =  $sql->execute();
        return $result;
    }


}