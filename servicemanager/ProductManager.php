<?php
    namespace servicemanager;
    use PDO;
    use PDOException;
    class ProductManager {
        Private $pdo;
        Public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }

        public function getAllProducts():array|bool{
            try{
                $sql = "SELECT * FROM products WHERE is_delete = FALSE";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $data= $stmt->fetchAll(PDO::FETCH_OBJ);
                return $data;
            }
            catch(PDOException $e){
                return false;
            }
        }
        
        public function getProductById($id):object|bool{
            try{
                $sql = "SELECT * FROM products where product_id =?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$id]);
                $data= $stmt->fetch(PDO::FETCH_OBJ);
                return $data;
            }
            catch(PDOException $e){
                return false;
            }
        }

        public function fetchProductById($id):object|bool{
                try{
                    $sql = "SELECT * FROM products JOIN categories ON product_categoryid= category_id WHERE product_id= ?";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->execute([$id]);
                    $data= $stmt->fetch(PDO::FETCH_OBJ);
                    return $data;
                }
                catch(PDOException $e){  
                    return false;
                }
        }

        public function updateProduct($pname,$filetmpname,$to,$price,$qty,$status,$cat,$id):bool{
            if(move_uploaded_file($filetmpname,$to)){
                try{
                    $sql = "UPDATE products SET product_name=?,product_image=?,product_price=?,product_quantity=?,product_status=?,product_categoryid=? WHERE product_id =?";
                    $stmt = $this->pdo->prepare($sql);
                    $data = $stmt->execute([$pname,$to,$price,$qty,$status,$cat,$id]);
                    if($data){
                        return true;
                    }else{
                        return false;
                    }
                }
                catch(PDOException $e){    
                    return false;
                }
            }else{
                return false;
            }
                
        }

        public function insertproduct($pname,$filetmpname,$to,$price,$qty,$status,$cat):bool{
            if(move_uploaded_file($filetmpname, $to)){
                $sql = "INSERT INTO products(product_name,product_image,product_price,product_quantity,product_status,product_categoryid) VALUES(?,?,?,?,?,?)";
                $stmt = $this->pdo->prepare($sql);
                $res = $stmt->execute([$pname,$to,$price,$qty,$status,$cat]);
                if($res){                                       
                    return true;
                }else{
                    return false;
                }  
            }else{
                return false;
            }
        }

        public function deleteProductById($productId):bool{
            try{
                $sql = "UPDATE products SET is_delete = TRUE WHERE product_id = ?";
                $stmt = $this->pdo->prepare($sql);
                $data = $stmt->execute([$productId]);
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

    
