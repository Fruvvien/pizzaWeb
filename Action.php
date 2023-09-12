<?php
session_start();


include_once "Queries.php";

$queries = new Queries();



if(isset($_POST["action"]) && $_POST["action"] == "login" && isset($_POST["allDataKey"])){
   $queriesLogin = $queries->loginUser($_POST["allDataKey"]["email"], $_POST["allDataKey"]["passw"]);


if($queriesLogin["success"] && $queriesLogin != ""){
   if(!isset($_SESSION["usertype"]) ){
      $_SESSION["usertype"] = $queriesLogin["result"][0]["user_type"];
      $_SESSION["userId"] = $queriesLogin["result"][0]["id"];
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
   $cooki_name = "email";
   setcookie($cooki_name, "", time() - (86400 * 30));
   echo true;
     
}

if(isset($_POST["action"]) && $_POST["action"] == "logoutAdmin" ){
   session_destroy();
   $cooki_name = "email";
   setcookie($cooki_name, "", time() - (86400 * 30));
   echo true;
  
}

if(isset($_POST["action"]) && $_POST["action"] == "register" && isset($_POST["allRegisterDataKey"])){
   $queriesRegister = $queries->registerFunction($_POST["allRegisterDataKey"]["username"], $_POST["allRegisterDataKey"]["email"], $_POST["allRegisterDataKey"]["password"]);
   if($queriesRegister["success"]){
      echo json_encode (["success" => true, "loginData" => $queriesRegister, "errorMessage" => ""]);
   }else{
      echo json_encode (["success" => false, "loginData" => [], "errorMessage" => $queriesRegister["errorMessage"]]);
   }
  
   
}

if(isset($_POST["action"]) && $_POST["action"] == "checkBox" && isset($_POST["cookiesDataKey"])){
   $queriesCookies= $queries->cookiesFunction($_POST["cookiesDataKey"]);
   $cooki_name = "email";
   $cooki_value = $_POST["cookiesDataKey"];
   
   setcookie($cooki_name, $cooki_value, time() + (86400 * 30), "/");
   if(isset($_COOKIE[$cooki_name])){
      echo $queriesCookies= $queries[0]["user_type"];
   }
  
}

if(isset($_POST["action"]) && $_POST["action"] == "cookiesExist" && count($_COOKIE) > 0){
   $cooki_name = "email";
   unset($_COOKIE[$cooki_name]); 
   setcookie($cooki_name, '', -1, '/'); 
}

if(isset($_POST["action"]) && $_POST["action"] == "pizzaAction"){
   echo json_encode($queries->pizzaFunction());

}
if(isset($_POST["action"]) && $_POST["action"] == "courierlist"){
   echo json_encode($queries->courierFunction());
}

if(isset($_POST["action"]) && $_POST["action"] == "order" && isset($_POST["pizzaKey"]) && isset($_SESSION["userId"])){
   $orderQueries = $queries->userIdFunction($_SESSION["userId"]);
   $existProduct = $queries->productFunction($_POST["pizzaKey"]["pizzaId"], $_POST["pizzaKey"]["pizzaAr"], $orderQueries);
   $upgradeCart = $queries->upgradeCartFunction( $_POST["pizzaKey"]["pizzaAr"], $orderQueries, $_SESSION["userId"] );
   
   echo json_encode($orderQueries);

  
}

if(isset($_POST["action"]) && $_POST["action"] == "count" ){
 echo $queries->summFunction();
}

if(isset($_POST["action"]) && $_POST["action"] == "orderPage"){
   echo json_encode($queries->orderlist());
}