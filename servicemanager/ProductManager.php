<?php
      require_once "Db.php";
      class ProductManager extends Db{
            Private $db;
            Public function __construct(){
                  $this->db = $this->connect();
            }

            public function getAllProducts(){
                  try{
                      $sql = "SELECT * FROM products";
                      $stmt = $this->db->prepare($sql);
                      $stmt->execute();
                      $data= $stmt->fetchAll(PDO::FETCH_OBJ);
                      return $data;
                  }
                  catch(PDOException $e){
                      return false;
                  }
            }
            
            public function getProductById($id){
                  try{
                        $sql = "SELECT * FROM products where product_id =?";
                        $stmt = $this->db->prepare($sql);
                        $stmt->execute([$id]);
                        $data= $stmt->fetch(PDO::FETCH_OBJ);
                        return $data;
                  }
                  catch(PDOException $e){
                        return false;
                  }
            }

            public function fetchProductById($id){
                  try{
                      $sql = "SELECT * FROM products JOIN categories ON product_categoryid= category_id WHERE product_id= ?";
                      $stmt = $this->db->prepare($sql);
                      $stmt->execute([$id]);
                      $data= $stmt->fetch(PDO::FETCH_OBJ);
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
                          $stmt = $this->db->prepare($sql);
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

            public function insertproduct($pname,$filetmpname,$to,$price,$qty,$status,$cat){
                  if(move_uploaded_file($filetmpname, $to)){
                      $sql = "INSERT INTO products(product_name,product_image,product_price,product_quantity,product_status,product_categoryid) VALUES(?,?,?,?,?,?)";
                       $stmt = $this->db->prepare($sql);
                       $res = $stmt->execute([$pname,$to,$price,$qty,$status,$cat]);
                      if($res){                                       
                          return true;
                      }else{
                       return false;
                      }  
                  }
            }
            
      }
