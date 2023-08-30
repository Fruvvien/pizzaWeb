<?php
class Connection{


    private $dbhost= 'mysql:host=localhost;dbname=pizza;charset=UTF8';
    private $user="root";
    private $password="";
    public $conn;


    function __construct(){
        try{
            $this->conn= new PDO($this->dbhost, $this->user, $this->password);
        }catch(PDOExpection $e){
            echo $e;
        }
    

    }

}