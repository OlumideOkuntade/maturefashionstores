<?php
    require_once "Db.php";
    Class Customer extends Db{
        //method for inserting to database maturestores
        private $db;
        public function __construct(){
            $this->db = $this->connect();
        }
        public function insertCustomer($firstname,$lastname,$phone,$email,$pass){
            $hashed = password_hash($pass,PASSWORD_DEFAULT);
            $sql = "INSERT INTO customers (first_name,last_name,phone_number,email,password) VALUES(?,?,?,?,?)";
            $stmt = $this->db->prepare($sql);
            $res = $stmt->execute([$firstname,$lastname,$phone,$email,$hashed]);
            return $res;
        }
        public function emailExit($email){
            $sql= "SELECT * FROM customers WHERE email = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$email]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$data){
              return false;  
            }else{
                return true;
            }
        }
        public function login($email,$pass){
            try{ $sql= "SELECT * FROM customers WHERE email= ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$email]);
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                if($data){
                    $stored_hash = $data["password"];
                    $check = password_verify($pass, $stored_hash);
                    if($check){
                        return $data["customer_id"];
                    }else{
                        $_SESSION["errormsg"] = "Invalid password";
                        return false;
                    }
                }else{
                    $_SESSION["errormsg"] = "invalid email";
                    return false;
                }
            }
            catch(PDOException $e){
                // echo $e->getMessage;
                return false;
            }     
        }
        public function logout(){
            unset($_SESSION["useronline"]);
            session_destroy();
        }
        public function allcustomer(){
            try{
                $sql = "SELECT * FROM customers";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $data= $stmt->fetch(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(PDOException $e){
               // echo $e->getMessage;
                return false;
            }
        }
        public function get_customer($customer_id){
            try{
                $sql = "SELECT * FROM customers WHERE customer_id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$customer_id]);
                $data= $stmt->fetch(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(PDOException $e){
               // echo $e->getMessage;
                return false;
            }
        }
        public function allproduct(){
            try{
                $sql = "SELECT * FROM products";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $data= $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(PDOException $e){
               // echo $e->getMessage;
                return false;
            }
        }
        public function product(){
            try{
                $sql = "SELECT * FROM products";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $data= $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(PDOException $e){
                //echo $e->getMessage;
                return false;
            }
        }
        public function productbyId($id){
            try{
                $sql = "SELECT * FROM products where product_id =?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$id]);
                $data= $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(PDOException $e){
                return false;
            }
        }
        public function allorders(){
            try{
                $sql = "SELECT * FROM orders JOIN products ON products.product_id=orders.order_productid";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute();
                $data= $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(PDOException $e){
               // echo $e->getMessage;
                return false;
            }
        }    
    }
//     $obj = new Customer;
//    // $resp = $obj->connect();
//     echo "<pre>";
//     print_r($obj);
//     echo "</pre>";



?>