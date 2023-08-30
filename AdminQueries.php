<?php
include_once "AdminConnection.php";

class Queries{

    public $db;


    function __construct(){
        $this->db= new Connection();
    }

    
}