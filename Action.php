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
      echo $queriesCookies[0]["user_type"];
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
   $upgradeCart = $queries->upgradeCartFunction( $_POST["pizzaKey"]["pizzaAr"], $orderQueries, $_SESSION["userId"]);
   
   echo json_encode($orderQueries);

  
}

if(isset($_POST["action"]) && $_POST["action"] == "count" ){
 echo $queries->summFunction($_SESSION["userId"]);
}

if(isset($_POST["action"]) && $_POST["action"] == "orderPage" ){
   $totalPriceQueries = $queries->getTotalPriceAndCartId($_SESSION["userId"]);
   $queriesOrder=$queries->orderlist($_SESSION["userId"]);
   
   if(!empty($queriesOrder)){
      echo json_encode(["order" => $queriesOrder, "totalPrice" => $totalPriceQueries, "cartId" => $totalPriceQueries]);
   }else{
      echo false;
   }
}

if(isset($_POST["action"]) && $_POST["action"] == "deleteFunctionButton" && isset($_POST["cartItemKey"]) && isset($_POST["cartKey"])){
   $deleteQueries = $queries->deleteCartItem($_POST["cartItemKey"], $_POST["cartKey"]);
   echo $deleteQueries;
}

if(isset($_POST["action"]) && $_POST["action"] == "updateCart" && isset($_POST["cartKey"]) && isset($_POST["cartItemPrice"]) && isset($_POST["quantityKey"])){
   $updateCartQueries = $queries->updateCart( $_POST["cartItemPrice"], $_POST["quantityKey"],$_POST["cartKey"],);
   echo $updateCartQueries;
}

/* if(isset($_POST["action"]) && $_POST["action"] == "totalPriceAction"){
   $totalPriceQueries = $queries->getTotalPrice($_SESSION["userId"]);
   echo json_encode($totalPriceQueries);
} */

if(isset($_POST["action"]) && $_POST["action"] == "deleteFromCart" && isset($_POST["cartIdKey"])){
   $deleteFromCartQueries = $queries->delteFromCart($_POST["cartIdKey"], $_SESSION["userId"]);
   echo true;
}

if(isset($_POST["action"]) && $_POST["action"] == "quantityPlus" && isset($_POST["allData"])){
   $queries->plussing($_POST["allData"]["cartId"], $_POST["allData"]["productId"], $_POST["allData"]["quantity"]);
   echo true;
}

if(isset($_POST["action"]) && $_POST["action"] == "quantityMinus" && isset($_POST["allData"])){
   $queries->minus($_POST["allData"]["cartId"], $_POST["allData"]["productId"], $_POST["allData"]["quantity"]);
   echo true;
}

if(isset($_POST["action"]) && $_POST["action"] == "finalPricePlus" && isset($_POST["cartIdAndPrice"])){
   $upgradeCart = $queries->plusFinalPrice(  $_POST["cartIdAndPrice"]["price"], $_POST["cartIdAndPrice"]["cartId"]);
   echo true;
}
if(isset($_POST["action"]) && $_POST["action"] == "finalPriceMinus" && isset($_POST["cartIdAndPrice"])){
   $upgradeCart = $queries->minusFinalPrice(  $_POST["cartIdAndPrice"]["price"], $_POST["cartIdAndPrice"]["cartId"]);
   echo true;
}

if(isset($_POST["action"]) && $_POST["action"] == "clearTheBag" && isset($_POST["cartItemId"]) && isset($_POST["cartId"])  ){
   $upgradeBag = $queries->clearTheBag(["cartItemId"]["cartItemId"], ["cartId"]["cartId"]);
   echo true;
}

if(isset($_POST["action"]) && $_POST["action"] == "deleteFromCartItemsWithWhere" && isset($_POST["cartItemId"]) ){
   $deleteFromCartItemsWithWhere = $queries->deleteFromCartItemsWithWhere($_POST["cartItemId"], $_SESSION["userId"]);
   echo true;
}




/* if (isset($_POST["action"]) && $_POST["action"] == "quantityPlus" && isset($_POST["allData"])) {
   $data = json_decode($_POST["allData"], true); // JSON dekódolása tömbként
   $queries->plussing($data["cartId"], $data["productId"], $data["quantity"]);
   echo true;
}

if (isset($_POST["action"]) && $_POST["action"] == "quantityMinus" && isset($_POST["allData"])) {
   $data = json_decode($_POST["allData"], true); // JSON dekódolása tömbként
   $queries->minus($data["cartId"], $data["productId"], $data["quantity"]);
   echo true;
} */