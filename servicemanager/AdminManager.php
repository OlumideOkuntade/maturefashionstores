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
        public function insertproduct($pname,$filetmpname,$to,$price,$qty,$status,$cat){
            if(move_uploaded_file($filetmpname, $to)){
                $sql = "INSERT INTO products(product_name,product_image,product_price,product_quantity,product_status,product_categoryid) VALUES(?,?,?,?,?,?)";
                 $stmt = $this->connect()->prepare($sql);
                 $res = $stmt->execute([$pname,$to,$price,$qty,$status,$cat]);
                if($res){                                       
                    return true;
                }else{
                 return false;
                }  
            }
        }
        public function fetchCatergory(){
            try{
                $sql = "SELECT * FROM categories";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute();
                $data= $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(PDOException $e){
                return false;
            }
        }
        public function getAllProducts(){
            try{
                $sql = "SELECT * FROM products";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute();
                $data= $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(PDOException $e){
                return false;
            }
        }
        public function fetchproductbyId($id){
            try{
                $sql = "SELECT * FROM products JOIN categories ON product_categoryid= category_id WHERE product_id= ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$id]);
                $data= $stmt->fetch(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(PDOException $e){  
                return false;
            }
        }
        public function updateProduct($pname,$filetmpname,$to,$price,$qty,$status,$cat,$id){
            if(move_uploaded_file($filetmpname,$to)){
                try{
                    $sql = "UPDATE products SET product_name=?,product_image=?,product_price=?,product_quantity=?,product_status=?,product_categoryid=? WHERE product_id =?";
                    $stmt = $this->connect()->prepare($sql);
                    $data = $stmt->execute([$pname,$to,$price,$qty,$status,$cat,$id]);
                    if($data){
                        return true;
                    }else{;
                        return false;
                    }
                }
                catch(PDOException $e){    
                    return false;
                }
            }
           
        }
      
        
    }
    // $admin = new Admin;
    // $rsp = $admin->connect();
    // echo "<pre>";
    // print_r($rsp);
    // echo "</pre>";

?>