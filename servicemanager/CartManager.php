<?php
    namespace servicemanager;
    use PDO;
    use PDOException;
    class CartManager{
        private $pdo;
        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }
        public function getCustomerCartId($customerId):object|bool{
            try{
                $sql = "SELECT cart_id FROM carts WHERE cart_userid =?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$customerId]);
                $data= $stmt->fetch(PDO::FETCH_OBJ);
                return $data;
            } catch(PDOException $e){
                echo $e->getMessage();
                return false; 
            }
        }
        public function checkProductInCart($productId):object|bool{
            try{
                $sql = "SELECT item_id FROM cartitems WHERE product_id=?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$productId]);
                $data= $stmt->fetch(PDO::FETCH_OBJ);
                return $data;
            } catch(PDOException $e){
                echo $e->getMessage();
                return false; 
            }
        }
        public function updateCartProduct($amt,$qty,$cartId,$productId):object|bool{   
            try{
                $sql = "UPDATE cartitems SET amount = amount + ? ,quantity = quantity + ? WHERE item_cartid=? AND product_id=?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$amt,$qty,$cartId,$productId]);
                $data= $stmt->fetch(PDO::FETCH_OBJ);
                return true;
            } catch(PDOException $e){
                echo $e->getMessage();
                return false; 
            }
        }
    
        public function insertIntoCart($customerId):object|bool{
            try{
                $sql = "INSERT INTO carts SET cart_userid = ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$customerId]);
                $data = $this->pdo->lastInsertId();
                return $data;
            } 
            catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
    
        public function insertIntoCartitem($qty,$customerId,$productId,$cartId,$amt):bool{
            try{
                $sql = "INSERT INTO cartitems SET quantity=?,user_id=?,product_id=?,item_cartid =?,amount=?";
                $stmt = $this->pdo->prepare($sql);
                $data= $stmt->execute([$qty,$customerId,$productId,$cartId,$amt]);
                if($data){
                    return true;
                }else{
                    return false;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
            
        public function getCartitem($customerId):array|bool{
            try{
                $sql = "SELECT products.product_id,products.product_image,products.product_name,products.product_price,cartitems.quantity,cartitems.amount FROM cartitems JOIN products ON products.product_id= cartitems.product_id WHERE cartitems.user_id=?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$customerId]);
                $data= $stmt->fetchAll(PDO::FETCH_OBJ);
                return $data;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return false; 
            }        
        }
    
        public function sumAmount($customerId):array|bool{
            try{
                $sql = "SELECT sum(amount) AS totalamt from cartitems WHERE cartitems.user_id=?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$customerId]);
                $data= $stmt->fetchAll(PDO::FETCH_OBJ);
                return $data;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }         
        }
    
        public function deleteCartItem($id,$customerId):object|bool{
            try{
                $sql = "DELETE from cartitems WHERE cartitems.product_id=? AND cartitems.user_id=?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$id,$customerId]);
                $data= $stmt->fetch(PDO::FETCH_OBJ);
                return true;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return false;
            } 
    
        }
        public function deleteAllCartItem($customerId):array|bool{
            try{
                $sql = "DELETE from cartitems WHERE cartitems.user_id=?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$customerId]);
                $data= $stmt->fetchAll(PDO::FETCH_OBJ);
                return true;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return false; 
            } 
        }
    }
      









