<?php
      session_start();
      $pdo = require_once __DIR__ . "/../servicemanager/Db.php";
      require_once __DIR__ . "/../servicemanager/AdminManager.php";
      $adminManager = new AdminManager($pdo);
      $adminManager->logout();
      header("Location:login.php");
      exit;




?>