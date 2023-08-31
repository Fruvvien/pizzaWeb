<?php
session_start();


include_once "Queries.php";

$queries = new Queries();



if(isset($_POST["action"]) && $_POST["action"] == "login" && isset($_POST["allDataKey"])){
   $queriesLogin = $queries->loginUser($_POST["allDataKey"]["email"], $_POST["allDataKey"]["passw"]);


if($queriesLogin["success"] && $queriesLogin != ""){
   if(!isset($_SESSION["usertype"])){
      $_SESSION["usertype"] = $queriesLogin["result"][0]["user_type"];
   }
      echo json_encode(["success" => true, "loginData" => $queriesLogin, "errorMessage" => ""]);
}else{
      echo json_encode(["success" => false, "loginData" => [], "errorMessage" => $queriesLogin["errorMessage"]]);

   }  
}


if(isset($_POST["action"]) && $_POST["action"] == "sessionExist"){
   $echovalue;
   if(isset($_SESSION["usertype"])){
      $echovalue = $_SESSION["usertype"];
      echo json_encode(["usertype" => $echovalue, "sessionIsNotExist" => true]);
   }else{
      echo json_encode(["usertype" => 0, "sessionIsNotExist" => false]);
   }
   
}

if(isset($_POST["action"]) && $_POST["action"] == "logoutUser"){
   session_destroy();
   echo true;
     
}

if(isset($_POST["action"]) && $_POST["action"] == "logoutAdmin" ){
   session_destroy();
   echo true;
  
}