<?php
    namespace servicemanager;
    use PDO;
    use PDOException;
    class CustomerManager{
        private $pdo;
        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }
        public function insertCustomer($firstName,$lastName,$phone,$email,$pass):bool{
            $hashed = password_hash($pass,PASSWORD_DEFAULT);
            $sql = "INSERT INTO customers (first_name,last_name,phone_number,email,password) VALUES(?,?,?,?,?)";
            $stmt = $this->pdo->prepare($sql);
            $res = $stmt->execute([$firstName,$lastName,$phone,$email,$hashed]);
            return $res;
        }
        public function checkEmailExit($email):bool{
            $sql= "SELECT * FROM customers WHERE email = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$email]);
            $data = $stmt->fetch(PDO::FETCH_OBJ);
            if(!$data){
              return false;  
            }else{
                return true;
            }
        }
        public function login($email,$pass):string|bool{
            try{ $sql= "SELECT * FROM customers WHERE email= ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$email]);
                $data = $stmt->fetch(PDO::FETCH_OBJ);
                if($data){
                    $stored_hash = $data->password;
                    $check = password_verify($pass, $stored_hash);
                    if($check){
                        return $data->customer_id;
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
                return false;
            }     
        }
        public function logout(){
            unset($_SESSION["useronline"]);
            session_destroy();
        }
        public function getAllCustomers():array|bool{
            try{
                $sql = "SELECT * FROM customers";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $data= $stmt->fetchAll(PDO::FETCH_OBJ);
                return $data;
            }
            catch(PDOException $e){
                return false;
            }
        }
        public function getCustomerById($customerId):object|bool{
            try{
                $sql = "SELECT * FROM customers WHERE customer_id = ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$customerId]);
                $data= $stmt->fetch(PDO::FETCH_OBJ);
                return $data;
            }
            catch(PDOException $e){
                return false;
            }
        }
          public function deleteCustomerById($customerId):bool{
            try{
                $sql = "DELETE FROM customers WHERE customer_id = ?";
                $stmt = $this->pdo->prepare($sql);
                $data = $stmt->execute([$customerId]);
                if($data){
                        return true;
                    }else{
                        return false;
                }
            }
            catch(PDOException $e){
                return false;
            }
        }
       
         
    }




