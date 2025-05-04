<?php
    session_start();
    $pdo = require __DIR__. "/../servicemanager/Db.php";
    require_once "../servicemanager/CustomerManager.php";
    
    $customerManager = new CustomerManager($pdo);
    if(!isset($_POST["login"])){
        header("Location:../login.php");
        exit;
    }

    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $res= $customerManager->login($email,$pass);
    if($res){
        $_SESSION["useronline"] = $res;
        header("Location:../dashboard.php");
        exit;
    }else{
        header("Location:../login.php");
        exit;
    }




