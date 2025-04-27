<?php
      session_start();
//     echo "<pre>";
//     print_r($_POST);
//     echo "</pre>";
      require_once "../classes/Admin.php";
      $admin = new Admin;
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
      $log = $admin->login($name,$pass);
      if($log){
            $_SESSION["adminonline"] = $log;
           header("location:../dashboard.php");
          exit;
      }else{header("Location:../login.php");
            exit;
          
      }
      



?>