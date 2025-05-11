<?php
      session_start();
      require_once __DIR__ . "/../autoload.php";
      use servicemanager\AdminManager;
      use servicemanager\Db;
      $pdo = (new Db)->connect();
      $adminManager = new AdminManager($pdo);
      $adminManager->logout();
      header("Location:login.php");
      exit;




?>