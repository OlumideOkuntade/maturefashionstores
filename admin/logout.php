<?php
      session_start();
      require_once __DIR__ . "/../servicemanager/AdminManager.php";
      $admin = new AdminManager;
      $admin->logout();
      header("Location:login.php");
      exit;




?>