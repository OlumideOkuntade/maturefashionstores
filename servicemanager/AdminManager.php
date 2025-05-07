<?php
    namespace servicemanager;
    use PDO;
    use PDOException;
    class AdminManager {
        private $pdo;
        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }
        public function login($name,$pass):string|bool{
            try{ $sql= "SELECT * FROM admins WHERE admin_username= ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$name]);
                $data = $stmt->fetch(PDO::FETCH_OBJ);
                if($data){
                    $hashed_password = $data->admin_pwd ;
                    $check = password_verify($pass, $hashed_password);
                    if($check){
                        return $data->admin_id;
                    }else{
                        $_SESSION["errormsg"] = "Invalid password";
                        return false;
                    }
                }else{
                    $_SESSION["errormsg"] = "invalid username"; 
                    return false;
                }
            }
            catch(PDOException $e){
                return false;
            }  
        }

        public function logout(){
            unset($_SESSION["adminonline"]);
            session_destroy();
        }
        
        public function getAdmin($id):object|bool{
            try{
                $sql = "SELECT * FROM admins WHERE admin_id = ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$id]);
                $data= $stmt->fetch(PDO::FETCH_OBJ);
                return $data;
            }
            catch(PDOException $e){
                return false;
            }
        }
       
    }

