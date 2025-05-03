<?php
    require_once __DIR__ . "/Db.php";
    Class AdminManager extends Db{
        public function login($name,$pass){
            try{ $sql= "SELECT * FROM admins WHERE admin_username= ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$name]);
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                if($data){
                    $hashed_password = $data['admin_pwd'];
                    $check = password_verify($pass, $hashed_password);
                    if($check){
                        return $data["admin_id"];
                    }else{
                        $_SESSION["errormsg"] = "Invalid password";
                        return false;
                    }
                }else{
                    $_SESSION["errormsg"] = "invalid username"; 
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
        public function getAdmin($id){
            try{
                $sql = "SELECT * FROM admins WHERE admin_id = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$id]);
                $data= $stmt->fetch(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(PDOException $e){
                return false;
            }
        }
       
      }

