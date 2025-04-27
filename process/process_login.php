<?php
    session_start();
    require_once "../classes/Customer.php";
    
    $cus = new Customer;
    if(!isset($_POST["login"])){
        header("Location:../login.php");
        exit;
    }

    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $res= $cus->login($email,$pass);
    if($res){//customer_id or false
        $_SESSION["useronline"] = $res;
        header("Location:../dashboard.php");
        exit;
    }else{
        header("Location:../login.php");
        exit;
    }




?>