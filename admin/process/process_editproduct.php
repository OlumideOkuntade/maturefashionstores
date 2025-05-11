<?php
session_start();
require_once __DIR__ . "/../../autoload.php";
require_once "../admin_guard.php";
use servicemanager\Db;
$pdo = (new Db)->connect();
$productManager = new \servicemanager\ProductManager($pdo);

if(!isset($_POST["btn"])){
  header('Location:../new_product.php');
  exit;
}
$name = $_POST['name'];
$qty = $_POST['qty'];
$price = $_POST['price'];
$status = $_POST['status'];
$cat = $_POST['cat'];
$id = $_POST['pro'];

$fileName = $_FILES["file"]["name"];
$fileType = $_FILES["file"]["type"];
$fileTmpName = $_FILES["file"]["tmp_name"];
$fileError = $_FILES["file"]["error"];
$fileSize = $_FILES["file"]["size"];

if($fileError != 0){
    $_SESSION["errormsg"]= "Please select an image";
    header('Location:../fileupload.php');
    exit;
  }
  // problem 2: people uploading too large file
  if($fileSize > 2097152){
    $_SESSION["errormsg"]= "you cannot upload more than 2mb";
    header('Location:../fileupload.php');
    exit;
  }
  // problem 3: people uploading wrong file
  $allowed= ["jpg","jpeg","png"]; // list of what i allowed
  $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);// return d extension of the file, then check if is not there
  if(!in_array($fileExt, $allowed)){
    $_SESSION["errormsg"]= "Please supply files that is jpg or png or jpeg";
    header("Location:../addpost.php");
    exit;
  }
   // or upload to a folder
    $to = "../uploads/". $fileName;
    $res = $productManager->updateProduct($name,$fileTmpName,$to,$price,$qty,$status,$cat,$id);
    if($res){
      $_SESSION['adminfeedback']= "Product updated successfully";
      header('Location:../new_product.php');
    }else{
      $_SESSION['errormsg']= "Not Updated";
      header('Location:../new_product.php');
    }
   












