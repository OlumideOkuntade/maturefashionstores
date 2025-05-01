<?php
      require_once "Db.php";
      class Order extends Db{
            Private $db;
            Public function __construct(){
                  $this->db = $this->connect();
            }
            
            public function insertOrder($total,$customerId,$size,$productId){
                  try{
                      $sql = "INSERT INTO orders SET order_amount=?,order_customerID =?,order_size=?,order_productid=?";
                      $stmt = $this->db->prepare($sql);
                      $stmt->execute([$total,$customerId,$size,$productId]);
                      $data = $this->db->lastInsertId();
                      return $data;
                  }catch(Exception $e){
                      echo $e->getMessage();
                      // return false;
                  }
            }
      
              public function orderbyId($id){
                  try{
                      $sql ="SELECT * FROM orders JOIN products ON order_productid=product_id WHERE order_id =?";
                      $stmt = $this->db->prepare($sql);
                      $stmt->execute([$id]);
                      $data = $stmt->fetch(PDO::FETCH_ASSOC);
                      return $data;
                  }
                  catch(PDOException $e){
                      echo $e->getMessage();
                      return false;
                  }
            }

            public function allOrders($customerId){
                  try{
                      $sql = "SELECT * FROM orders JOIN products ON products.product_id=orders.order_productid WHERE orders.order_customerID= ?";
                      $stmt = $this->connect()->prepare($sql);
                      $stmt->execute([$customerId]);
                      $data= $stmt->fetchAll(PDO::FETCH_ASSOC);
                      return $data;
                  }
                  catch(PDOException $e){
                     // echo $e->getMessage;
                      return false;
                  }
              }

      }


