<?php
      session_start();
      require_once "../classes/CartManager.php";
      require_once "../customer_guard.php";
      $cartManager = new CartManager;
      $customerId = $_SESSION["useronline"];
      $id = $_GET['id'];
      $cartManager->deleteCartItem($id,$customerId);
      header("Location:../confirm_purchase.php");
      
      

