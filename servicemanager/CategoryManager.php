<?php
    require_once "Db.php";
    class CategoryManager extends Db{
        private $db;
        public function __construct(){
            $this->db = $this->connect();
        }

        public function fetchCatergory(){
            try{
                $sql = "SELECT * FROM categories";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $data= $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(PDOException $e){
                return false;
            }
        }
        
    }
      









