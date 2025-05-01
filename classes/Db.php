<?php
    Class Db {
        private $conn;
        private $dbname = "maturestores";
        private $dbuser = "root";
        private $dbpass = "";
        private $dbhost = "localhost";
        
        public function connect(){
            $dsn = "mysql:dbhost=$this->dbhost;dbname=$this->dbname";
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        
            try{
                $this->conn = new PDO($dsn, $this->dbuser, $this->dbpass, $options);
                return $this->conn;
                
            }
            catch(PDOException $e){
                echo  $e->getMessage();
            }
        }   

    }
    
