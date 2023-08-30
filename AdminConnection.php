<?php
class AdminConnection{


    private $dbhost= new PDO("mysql:host=hostname;dbname=admin");
    private $user="root";
    private $password="";
    public $conn;


    function __construct(){
        try{
            $conn= new PDO($this->dbhost, $this->user, $this->password);
        }catch(PDOExpection $e){
            echo $e;
        }
    

    }

}