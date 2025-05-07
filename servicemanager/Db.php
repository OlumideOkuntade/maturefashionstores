<?php
    namespace servicemanager;
    use PDO;
    use PDOException;
    class Db {
        private $dbname = "maturestores";
        private $dbuser = "root";
        private $dbpass = "";
        private $dbhost = "localhost";

        
        public function connect():object|bool{
            $dsn = "mysql:dbhost=$this->dbhost;dbname=$this->dbname";
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

            try{
                return $pdo = new PDO($dsn, $this->dbuser, $this->dbpass, $options);
            }
            catch(PDOException $e){
                echo  $e->getMessage();
                return false;
            }
        }   
    }
    return (new Db)->connect(); 
    
    
