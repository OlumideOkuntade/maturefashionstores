<?php
      require_once "Db.php";
      class CartManager extends Db{
            private $db;
            public function __construct(){
                  $this->db = $this->connect();
            }
            public function checkCart($customerid){
                  try{
                      $sql = "SELECT cart_id FROM cart WHERE cart_userid =?";
                      $stmt = $this->db->prepare($sql);
                      $stmt->execute([$customerid]);
                      $data= $stmt->fetch(PDO::FETCH_ASSOC);
                      return $data;
                  } catch(PDOException $e){
                      echo $e->getMessage(); 
                  }
            }
            public function checkProduct($productid){
                  try{
                      $sql = "SELECT item_id FROM cartitem WHERE product_id=?";
                      $stmt = $this->db->prepare($sql);
                      $stmt->execute([$productid]);
                      $data= $stmt->fetch(PDO::FETCH_ASSOC);
                      return $data;
                  } catch(PDOException $e){
                      echo $e->getMessage();
                      return false; 
                  }
            }
            public function updateProduct($amt,$qty,$cartid,$productid){
                      
                  try{
                      $sql = "UPDATE cartitem SET amount = amount + ? ,quantity = quantity + ? WHERE item_cartid=? AND product_id=?";
                      $stmt = $this->db->prepare($sql);
                      $stmt->execute([$amt,$qty,$cartid,$productid]);
                      $data= $stmt->fetch(PDO::FETCH_ASSOC);
                      return true;
                  } catch(PDOException $e){
                      echo $e->getMessage(); 
                  }
            }
      
            public function insertCart($customerid){
                  try{
                      $sql = "INSERT INTO cart SET cart_userid = ?";
                      $stmt = $this->db->prepare($sql);
                      $stmt->execute([$customerid]);
                      $data = $this->db->lastInsertId();
                      return $data;
                  } 
                  catch(PDOException $e){
                      echo $e->getMessage();
                  }
            }
      
            public function insertCartitem($qty,$customerid,$productid,$cartid,$amt){
                  try{
                      $sql = "INSERT INTO cartitem SET quantity=?,user_id=?,product_id=?,item_cartid =?,amount=?";
                      $stmt = $this->db->prepare($sql);
                      $data= $stmt->execute([$qty,$customerid,$productid,$cartid,$amt]);
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
                      // return false;
                  }
            }
              
            public function getCartitem($customerid){
                  try{
                      $sql = "SELECT products.product_id,products.product_image,products.product_name,products.product_price,cartitem.quantity,cartitem.amount FROM cartitem JOIN products ON products.product_id= cartitem.product_id WHERE cartitem.user_id=?";
                      $stmt = $this->db->prepare($sql);
                      $stmt->execute([$customerid]);
                      $data= $stmt->fetchAll(PDO::FETCH_OBJ);
                      return $data;
                  }
                  catch(PDOException $e){
                      echo $e->getMessage();
                      
                  }        
            }
      
            public function totalAmt($customerid){
                  try{
                      $sql = "SELECT sum(amount) AS totalamt from cartitem WHERE cartitem.user_id=?";
                      $stmt = $this->db->prepare($sql);
                      $stmt->execute([$customerid]);
                      $data= $stmt->fetchAll(PDO::FETCH_ASSOC);
                      return $data;
                  }
                  catch(PDOException $e){
                      echo $e->getMessage();
                      
                  }         
            }
      
            public function deleteCart($id,$customerid){
              try{
                  $sql = "DELETE from cartitem WHERE cartitem.product_id=? AND cartitem.user_id=?";
                  $stmt = $this->db->prepare($sql);
                  $stmt->execute([$id,$customerid]);
                  $data= $stmt->fetch(PDO::FETCH_ASSOC);
                  return true;
              }
              catch(PDOException $e){
                  echo $e->getMessage();
                  
              } 
      
            }
            public function deleteAll($customerid){
              try{
                  $sql = "DELETE from cartitem WHERE cartitem.user_id=?";
                  $stmt = $this->db->prepare($sql);
                  $stmt->execute([$customerid]);
                  $data= $stmt->fetch(PDO::FETCH_ASSOC);
                  return true;
              }
              catch(PDOException $e){
                  echo $e->getMessage(); 
              } 
            }
      }
      // $cart = new CartManager;
      // $res = $cart->connect();
      // echo "<pre>";
      // print_r($res);
      // echo "</pre>";









