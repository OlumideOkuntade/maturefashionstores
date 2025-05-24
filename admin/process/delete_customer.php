<?php
      session_start();
      require __DIR__. '/../../vendor/autoload.php';
      require_once "../admin_guard.php";
      use servicemanager\Db;
      $pdo = (new Db)->connect();
      $customerManager = new \servicemanager\customerManager($pdo);
      $customerId = $_GET["id"];
      $dat = $customerManager->deleteCustomerById($customerId);
      if($dat){
            $_SESSION['adminfeedback']= "Customer deleted successfully";
            header('Location:../all_customers.php');
            exit;
      }else{
            $_SESSION['errormsg']= "Customer not deleted";
            header('Location:../all_customers.php');
            exit;
      }