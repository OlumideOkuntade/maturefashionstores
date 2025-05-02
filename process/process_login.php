<?php
    session_start();
    require_once "../servicemanager/CustomerManager.php";
    
    $customer = new CustomerManager;
    if(!isset($_POST["login"])){
        header("Location:../login.php");
        exit;
    }

    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $res= $customer->login($email,$pass);
    if($res){
        $_SESSION["useronline"] = $res;
        header("Location:../dashboard.php");
        exit;
    }else{
        header("Location:../login.php");
        exit;
    }




