<?php
session_start();
require __DIR__. "/autoload.php";
use servicemanager\CustomerManager;
use servicemanager\Db;
$pdo = (new Db)->connect();
$customerManager = new CustomerManager($pdo);
$customerManager->logout();
header("Location:index.php");
exit;




