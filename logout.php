<?php
 session_start();
 $pdo = require __DIR__. "/servicemanager/Db.php";
 require_once "servicemanager/CustomerManager.php";
 $customerManager = new CustomerManager($pdo);
 $customerManager->logout();
 header("Location:index.php");
 exit;




