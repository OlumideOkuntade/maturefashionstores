<?php
 session_start();
 require_once "classes/Customer.php";
 $customer = new Customer;
 $customer->logout();
 header("Location:index.php");
 exit();




