<?php
 session_start();
 require_once "servicemanager/CustomerManager.php";
 $customer = new CustomerManager;
 $customer->logout();
 header("Location:index.php");
 exit();




