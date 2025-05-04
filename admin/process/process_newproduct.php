<?php
session_start();
$pdo = require_once __DIR__ . "/../../servicemanager/Db.php";
require_once __DIR__ . "/../../servicemanager/ProductManager.php";
$productManager = new ProductManager($pdo);
if(!isset($_POST["btn"])){
    $_SESSION["errormsg"]= "Please fill the form";
    header('Location:../newproduct.php');
}
$pname = $_POST['name'];
$qty = $_POST['qty'];
$price = $_POST['price'];
$status = $_POST['status'];
$cat = $_POST['cat'];
//validate
$filename = $_FILES["file"]["name"];
$filetype = $_FILES["file"]["type"];
$filetmpname = $_FILES["file"]["tmp_name"];
$fileerror = $_FILES["file"]["error"];
$filesize = $_FILES["file"]["size"];

if($fileerror != 0){
    $_SESSION["errormsg"]= "Please select an image";
    header('Location:../newproduct.php');
  }
  // problem 2: people uploading too large file
  if($filesize > 2097152){
        $_SESSION["errormsg"]= "you cannot upload more than 2mb";
        header('Location:../newproduct.php');
        exit;
    }
  // problem 3: people uploading wrong file
  $allowed= ["jpg","jpeg","png"]; // list of what i allowed
  $fileext = pathinfo($filename, PATHINFO_EXTENSION);// return d extension of the file, then check if is not there
  if(!in_array($fileext, $allowed)){
        $_SESSION["errormsg"]= "Please supply files that is jpg or png or jpeg";
        header('Location:../newproduct.php');
        exit;
    }
   // or upload to a folder
    $to = "../uploads/". $filename;
    $res = $productManager->insertProduct($pname,$filetmpname,$to,$price,$qty,$status,$cat);
    if($res){
        $_SESSION['adminfeedback']= "Product uploaded sucessfully";
       header('Location:../newproduct.php');
    }else{
        $_SESSION['errormsg']= "Product not uploaded";
       header('Location:../newproduct.php');
    }
   












?>