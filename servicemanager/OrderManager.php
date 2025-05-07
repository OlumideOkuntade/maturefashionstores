<?php
    namespace servicemanager;
    use PDO;
    use PDOException;
    class OrderManager{
        private $pdo;
        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }
        
        public function insertOrder($total,$customerId,$size,$productId):string|bool{
            try{
                $sql = "INSERT INTO orders SET order_amount=?,order_customerID =?,order_size=?,order_productid=?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$total,$customerId,$size,$productId]);
                $data = $this->pdo->lastInsertId();
                return $data;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
    
        public function getOrderbyId($id):object|bool{
            try{
                $sql ="SELECT * FROM orders JOIN products ON order_productid=product_id WHERE order_id =?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$id]);
                $data = $stmt->fetch(PDO::FETCH_CLASS, 'OrderManager');
                return $data;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function getAllOrdersByCustomerId($customerId):array|bool{
            try{
                $sql = "SELECT * FROM orders JOIN products ON products.product_id=orders.order_productid WHERE orders.order_customerID= ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$customerId]);
                $data= $stmt->fetchAll(PDO::FETCH_OBJ);
                return $data;
            }
            catch(PDOException $e){
                return false;
            }
        }

        public function getAllOrders():array|bool{
            try{
                $sql = "SELECT * FROM orders JOIN products ON products.product_id=orders.order_productid";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $data= $stmt->fetchAll(PDO::FETCH_OBJ);
                return $data;
            }
            catch(PDOException $e){
                return false;
            }
        }

    }


