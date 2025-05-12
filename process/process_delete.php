<?php
session_start();
require __DIR__. '/../vendor/autoload.php';
use servicemanager\CartManager;
use servicemanager\Db;
$pdo = (new Db)->connect();
$cartManager = new CartManager($pdo);
$customerId = $_SESSION["useronline"];
$id = $_GET['id'];
$cartManager->deleteCartItem($id,$customerId);
header("Location:../dashboard.php");
      
      

