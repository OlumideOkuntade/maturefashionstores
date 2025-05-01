<?php
      require_once "Db.php";
      class ProductManager extends Db{
            Private $db;
            Public function __construct(){
                  $this->db = $this->connect();
            }

            public function getAllProduct(){
                  try{
                      $sql = "SELECT * FROM products";
                      $stmt = $this->db->prepare($sql);
                      $stmt->execute();
                      $data= $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                  $data= $stmt->fetchAll(PDO::FETCH_ASSOC);
                  return $data;
            }
            catch(PDOException $e){
                  return false;
            }
            }

      }
