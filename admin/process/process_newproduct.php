<?php
session_start();
require __DIR__. '/../../vendor/autoload.php';
use servicemanager\Db;
$pdo = (new Db)->connect();
$productManager = new \servicemanager\ProductManager($pdo);
if(!isset($_POST["btn"])){
    $_SESSION["errormsg"]= "Please fill the form";
    header('Location:../new_product.php');
}
$name = $_POST['name'];
$qty = $_POST['qty'];
$price = $_POST['price'];
$status = $_POST['status'];
$cat = $_POST['cat'];
//validate
$fileName = $_FILES["file"]["name"];
$fileType = $_FILES["file"]["type"];
$fileTmpName = $_FILES["file"]["tmp_name"];
$fileError = $_FILES["file"]["error"];
$fileSize = $_FILES["file"]["size"];

if($fileError != 0){
    $_SESSION["errormsg"]= "Please select an image";
    header('Location:../new_product.php');
  }
  // problem 2: people uploading too large file
  if($fileSize > 2097152){
        $_SESSION["errormsg"]= "you cannot upload more than 2mb";
        header('Location:../new_product.php');
        exit;
    }
  // problem 3: people uploading wrong file
  $allowed= ["jpg","jpeg","png"]; // list of what i allowed
  $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);// return d extension of the file, then check if is not there
  if(!in_array($fileExt, $allowed)){
        $_SESSION["errormsg"]= "Please supply files that is jpg or png or jpeg";
        header('Location:../new_product.php');
        exit;
    }
   // or upload to a folder
    $to = "../uploads/". $fileName;
    $res = $productManager->insertProduct($name,$fileTmpName,$to,$price,$qty,$status,$cat);
    if($res){
        $_SESSION['adminfeedback']= "Product uploaded sucessfully";
       header('Location:../new_product.php');
    }else{
        $_SESSION['errormsg']= "Product not uploaded";
       header('Location:../new_product.php');
    }
   












?>