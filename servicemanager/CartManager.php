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
        public function checkProductInCart($productId,$customerId):object|bool{
            try{
                $sql = "SELECT item_id FROM cart_items WHERE product_id=? AND user_id=?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$productId,$customerId]);
                $data= $stmt->fetch(PDO::FETCH_OBJ);
                return $data;
            } catch(PDOException $e){
                echo $e->getMessage();
                return false; 
            }
        }
        public function updateCartProduct($amt,$qty,$cartId,$productId):object|bool{   
            try{
                $sql = "UPDATE cart_items SET amount = amount + ? ,quantity = quantity + ? WHERE item_cartid=? AND product_id=?";
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
                $sql = "INSERT INTO cart_items SET quantity=?,user_id=?,product_id=?,item_cartid =?,amount=?";
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
            
        public function getCartItem($customerId):array|bool{
            try{
                $sql = "SELECT products.product_id,products.product_image,products.product_name,products.product_price,cart_items.quantity,cart_items.amount FROM cart_items JOIN products ON products.product_id= cart_items.product_id WHERE cart_items.user_id=?";
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
                $sql = "SELECT sum(amount) AS totalamt from cart_items WHERE cart_items.user_id=?";
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
                $sql = "DELETE from cart_items WHERE cart_items.product_id=? AND cart_items.user_id=?";
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
                $sql = "DELETE from cart_items WHERE cart_items.user_id=?";
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
      









