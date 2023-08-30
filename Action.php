<?php
session_start();

include_once "Queries.php";

$queries = new Queries();



if(isset($_POST["action"]) && $_POST["action"] == "login" && isset($_POST["allDataKey"])){
 $queriesLogin = $queries->loginUser($_POST["allDataKey"]["email"], $_POST["allDataKey"]["passw"]);
 if($queriesLogin["success"]){
    if(/* filter_has_var(INPUT_POST,'check') &&  */!isset($_SESSION["username"])){
        $_SESSION["username"] = $queriesLogin["result"][0]["user_name"];
     }
     echo json_encode(["success" => true, "loginData" => $queriesLogin, "errorMessage" => ""]);
 }else{
    echo json_encode(["success" => false, "loginData" => [], "errorMessage" => $queriesLogin["errorMessage"]]);

 } 
}