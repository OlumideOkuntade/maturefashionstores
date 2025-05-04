<?php
    class CategoryManager {
        private $db;
        public function __construct(PDO $pdo){
            $this->db = $pdo;
        }

        public function fetchAllCatergory(){
            try{
                $sql = "SELECT * FROM categories";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $data= $stmt->fetchAll(PDO::FETCH_OBJ);
                return $data;
            }
            catch(PDOException $e){
                return false;
            }
        }
        
        
    }
      









