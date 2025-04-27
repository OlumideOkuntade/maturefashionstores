<?php
    if(!isset($_SESSION["useronline"])){
        $_SESSION["errormsg"]= "You must be logged in to view this page";
        header("Location:login.php");
        exit();
      }

?>