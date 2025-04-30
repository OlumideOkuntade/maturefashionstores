<?php
      session_start();
      require_once "../classes/CartManager.php";
      require_once "../customer_guard.php";
      $car = new CartManager;
      $customerid = $_SESSION["useronline"];
      $id = $_GET['id'];
      $car->deleteCart($id,$customerid);
      header("Location:../confirm_purchase.php");
      
      

