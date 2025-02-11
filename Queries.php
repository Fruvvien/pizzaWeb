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
        }catch (PDOException $e){
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
    
    function userIdFunction($pizzaAr){
        $sql = $this->db->conn->prepare("SELECT cart_id FROM cart WHERE user_id = :userId");
        $sql->bindValue(":userId", $_SESSION["userId"]);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
      
         if(!empty($result) ){
            return $result[0]["cart_id"];
        }else{
            $sql = $this->db->conn->prepare("INSERT INTO cart (user_id) VALUES( :userId)");
            $sql->bindValue(":userId", $_SESSION["userId"]);
            $result =  $sql->execute();
            $result = $this->db->conn->lastInsertId();
            return $result;
        
        } 
    }
    function productFunction($pizzaId, $pizzaAr, $cartId){
        $sql = $this->db->conn->prepare("SELECT * FROM cart C INNER JOIN cart_items CI ON(C.cart_id = CI.cart_id) WHERE product_id = :pizzaId AND C.cart_id = :cartid");
        $sql->bindValue(":pizzaId", $pizzaId);
        $sql->bindValue(":cartid", $cartId);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($result)){
            $sql = $this->db->conn->prepare("UPDATE cart_items SET quantity = quantity + 1 WHERE product_id = :pizzaId AND cart_id = :cartid");
            $sql->bindValue(":pizzaId", $pizzaId);
            $sql->bindValue(":cartid", $cartId);
            $result =  $sql->execute();
            return $result;
        }else {
            $sql = $this->db->conn->prepare("INSERT INTO cart_items (quantity, product_id, price, cart_id) VALUES(:quantity, :productId, :price, :cartid)");
            $sql->bindValue(":quantity", +1);
            $sql->bindValue(":productId", $pizzaId);
            $sql->bindValue(":price", $pizzaAr);
            $sql->bindValue(":cartid", $cartId);
            $result =  $sql->execute();
            return $result;
        }
    }
    function upgradeCartFunction( $pizzaAr,  $cartId){
        $sql = $this->db->conn->prepare("UPDATE cart SET total_price = total_price + :price WHERE cart_id = :cartid AND user_id = :userId ");
        $sql->bindValue(":userId", $_SESSION["userId"]);
        $sql->bindValue(":price", $pizzaAr);
        $sql->bindValue(":cartid", $cartId);
        $result =  $sql->execute();
        return $result;
        
    }
    function summFunction($id){
        $sql = $this->db->conn->prepare("SELECT SUM( CI.quantity) as counting FROM cart_items CI INNER JOIN cart C ON (CI.cart_id = C.cart_id)WHERE user_id = :id GROUP BY C.cart_id ORDER BY counting DESC ");
        $sql->bindValue(":id", $id);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]["counting"];
    }
    function orderlist($id){
        $sql = $this->db->conn->prepare("SELECT * FROM users INNER JOIN cart C  ON (users.id = C.user_id) INNER JOIN cart_items CI  ON (C.cart_id = CI.cart_id) INNER JOIN pizzak ON (CI.product_id = pizzak.pazon)LEFT JOIN pizzak_url ON(pizzak.pazon = pizzak_url.product_id) WHERE C.user_id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function deleteCartItem($id, $cartId){
        $sql = $this->db->conn->prepare("DELETE FROM cart_items WHERE cart_items_id = :id AND cart_id = :cartId");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":cartId", $cartId);
        $result =  $sql->execute();
        return $result;    
    }
    function updateCart( $price, $quantity, $id ){
        $sql = $this->db->conn->prepare("UPDATE cart SET total_price = total_price - (:price * :quantity) WHERE cart_id = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":price", $price);
        $sql->bindValue(":quantity", $quantity);
        $result = $sql->execute();
        return $result;
    }

    function getTotalPriceAndCartId($id){
        $sql = $this->db->conn->prepare("SELECT total_price, cart_id FROM  cart WHERE user_id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function delteFromCart($id, $userId){
        $sql = $this->db->conn->prepare("DELETE FROM cart WHERE cart_id = :id AND user_id = :userId");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":userId", $userId);
        $sql->execute();
        $result = $sql->execute();
        return $result;
    }
    function plussing($cartId, $productId, $quantity){
        $sql = $this->db->conn->prepare("UPDATE cart_items SET quantity = :quantity + 1 WHERE cart_id = :cartId AND product_id = :productId");
        $sql->bindValue(":cartId", $cartId);
        $sql->bindValue(":productId", $productId);
        $sql->bindValue(":quantity", $quantity);
        $result = $sql->execute();
        return $result;
        
    }
    function minus($cartId, $productId, $quantity){
        $sql = $this->db->conn->prepare("UPDATE cart_items SET quantity = :quantity - 1 WHERE cart_id = :cartId AND product_id = :productId AND quantity != 0 ");
        $sql->bindValue(":cartId", $cartId);
        $sql->bindValue(":productId", $productId);
        $sql->bindValue(":quantity", $quantity);
        $result = $sql->execute();
        return $result;
        
    }
    
    function plusFinalPrice( $price, $cartId){
        $sql = $this->db->conn->prepare("UPDATE cart SET total_price = total_price + :price WHERE cart_id = :cartid ");
        $sql->bindValue(":price", $price);
        $sql->bindValue(":cartid", $cartId);
        $result =  $sql->execute();
        return $result;
    }
    function minusFinalPrice($price, $cartId){
        $sql = $this->db->conn->prepare("UPDATE cart SET total_price = total_price - :price WHERE cart_id = :cartid  ");
        $sql->bindValue(":price", $price);
        $sql->bindValue(":cartid", $cartId);
        $result =  $sql->execute();
        return $result;
    }

    function clearTheBag($id, $cartId){
        $sql = $this->db->conn->prepare("DELETE FROM cart_items WHERE cart_items_id = :id AND cart_id = :cartId AND quantity = 0");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":cartId", $cartId);
        $result =  $sql->execute();
        
        return $result;   
    }

    function deleteFromCartItemsWithWhere($id, $userId){
        $sql = $this->db->conn->prepare("DELETE FROM cart WHERE cart_id = :id AND user_id = :userId AND total_price = 0");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":userId", $userId);
        $result = $sql->execute();
        return $result;
    }

}