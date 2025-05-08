<?php
  if(!isset($_SESSION["adminonline"])){
    $_SESSION["errormsg"]= "You must be logged in to view this page";
    header("Location:login.php");
    exit;
  }

?>