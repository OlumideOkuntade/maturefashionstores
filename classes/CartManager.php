<?php
    require_once "Db.php";
    class CartManager extends Db{
        private $db;
        public function __construct(){
            $this->db = $this->connect();
        }
        public function getCustomerCartId($customerId){
            try{
                $sql = "SELECT cart_id FROM cart WHERE cart_userid =?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$customerId]);
                $data= $stmt->fetch(PDO::FETCH_OBJ);
                return $data;
            } catch(PDOException $e){
                echo $e->getMessage(); 
            }
        }
        public function checkProductInCart($productId){
            try{
                $sql = "SELECT item_id FROM cartitem WHERE product_id=?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$productId]);
                $data= $stmt->fetch(PDO::FETCH_OBJ);
                return $data;
            } catch(PDOException $e){
                echo $e->getMessage();
                return false; 
            }
        }
        public function updateCartProduct($amt,$qty,$cartId,$productId){   
            try{
                $sql = "UPDATE cartitem SET amount = amount + ? ,quantity = quantity + ? WHERE item_cartid=? AND product_id=?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$amt,$qty,$cartId,$productId]);
                $data= $stmt->fetch(PDO::FETCH_OBJ);
                return true;
            } catch(PDOException $e){
                echo $e->getMessage(); 
            }
        }
    
        public function insertIntoCart($customerId){
            try{
                $sql = "INSERT INTO cart SET cart_userid = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$customerId]);
                $data = $this->db->lastInsertId();
                return $data;
            } 
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    
        public function insertIntoCartitem($qty,$customerId,$productId,$cartId,$amt){
            try{
                $sql = "INSERT INTO cartitem SET quantity=?,user_id=?,product_id=?,item_cartid =?,amount=?";
                $stmt = $this->db->prepare($sql);
                $data= $stmt->execute([$qty,$customerId,$productId,$cartId,$amt]);
                if($data){
                    return true;
                    exit;
                }else{
                    return false;
                    exit;
                };
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
            
        public function getCartitem($customerId){
            try{
                $sql = "SELECT products.product_id,products.product_image,products.product_name,products.product_price,cartitem.quantity,cartitem.amount FROM cartitem JOIN products ON products.product_id= cartitem.product_id WHERE cartitem.user_id=?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$customerId]);
                $data= $stmt->fetchAll(PDO::FETCH_OBJ);
                return $data;
            }
            catch(PDOException $e){
                echo $e->getMessage(); 
            }        
        }
    
        public function sumAmount($customerId){
            try{
                $sql = "SELECT sum(amount) AS totalamt from cartitem WHERE cartitem.user_id=?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$customerId]);
                $data= $stmt->fetchAll(PDO::FETCH_OBJ);
                return $data;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }         
        }
    
        public function deleteCartItem($id,$customerId){
            try{
                $sql = "DELETE from cartitem WHERE cartitem.product_id=? AND cartitem.user_id=?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$id,$customerId]);
                $data= $stmt->fetch(PDO::FETCH_OBJ);
                return true;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            } 
    
        }
        public function deleteAllCartItem($customerId){
            try{
                $sql = "DELETE from cartitem WHERE cartitem.user_id=?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$customerId]);
                $data= $stmt->fetch(PDO::FETCH_OBJ);
                return true;
            }
            catch(PDOException $e){
                echo $e->getMessage(); 
            } 
        }
    }
      









