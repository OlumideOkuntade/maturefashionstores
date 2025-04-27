<?php
      session_start();
      require_once "../classes/Payment.php";
      require_once "../customer_guard.php";
      $pay = new Payment;
      $customerid = $_SESSION["useronline"];
      $id = $_GET['id'];
      // echo $id;
      $pay->deletecart($id,$customerid);
      header("Location:../confirm_purchase.php");
      
      

?>