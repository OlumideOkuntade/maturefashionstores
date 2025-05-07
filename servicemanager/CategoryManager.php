<?php
    namespace servicemanager;
    use PDO;
    use PDOException;
    class CategoryManager {
        private $pdo;
        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }

        public function fetchAllCatergory():array|bool{
            try{
                $sql = "SELECT * FROM categories";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $data= $stmt->fetchAll(PDO::FETCH_OBJ);
                return $data;
            }
            catch(PDOException $e){
                return false;
            }
        }
        
        
    }
      









