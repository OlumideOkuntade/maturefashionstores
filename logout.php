<?php
 session_start();
 require_once "classes/Customer.php";
 $cus = new Customer;
 $cus->logout();
 header("Location:index.php");
 exit();




?>