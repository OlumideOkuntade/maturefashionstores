<?php
      session_start();
      require __DIR__. '/../../vendor/autoload.php';
      require_once "../admin_guard.php";
      use servicemanager\Db;
      $pdo = (new Db)->connect();
      $productManager = new \servicemanager\ProductManager($pdo);
      $productId = $_GET["id"];
      $dat = $productManager->deleteProductById($productId);
      if($dat){
            $_SESSION['adminfeedback']= "Product deleted successfully";
            header('Location:../all_product.php');
            exit;
      }else{
            $_SESSION['errormsg']= "Product not deleted";
            header('Location:../all_product.php');
            exit;
      }