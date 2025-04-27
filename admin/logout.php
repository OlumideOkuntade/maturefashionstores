<?php
      session_start();
      require_once "classes/Admin.php";
      $ad = new Admin;
      $ad->logout();
      header("Location:login.php");
      exit;




?>