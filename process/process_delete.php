<?php
      session_start();
      $pdo = require __DIR__. "/../servicemanager/Db.php";
      require_once "../servicemanager/CartManager.php";
      require_once "../customer_guard.php";
      use servicemanager\CartManager;
      $cartManager = new CartManager($pdo);
      $customerId = $_SESSION["useronline"];
      $id = $_GET['id'];
      $cartManager->deleteCartItem($id,$customerId);
     header("Location:../dashboard.php");
      
      

