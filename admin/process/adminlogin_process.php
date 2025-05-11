<?php
      session_start();
      require_once __DIR__ . "/../../autoload.php";
      use servicemanager\Db;
      use servicemanager\AdminManager;
      $pdo = (new Db)->connect();
      $adminManager = new AdminManager($pdo);
      if(!isset($_POST['btn'])){
            $_SESSION['errormsg']="Please login";
            header("Location:../login.php");
            exit;
      }
      $name = $_POST['username'];
      $pass = $_POST['pass'];

      if(empty($name)|| empty($pass)){
            $_SESSION['errormsg']="Fields cannot be empty";
           header("Location:../login.php");
          exit; 
      }
      $log = $adminManager->login($name,$pass);
      if($log){
            $_SESSION["adminonline"] = $log;
           header("location:../dashboard.php");
          exit;
      }else{header("Location:../login.php");
            exit;
          
      }
      



