<?php
session_start();
require __DIR__. '/../vendor/autoload.php';
use servicemanager\CustomerManager;
use servicemanager\Db;
$pdo = (new Db)->connect();
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




