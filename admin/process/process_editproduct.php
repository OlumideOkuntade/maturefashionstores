<?php
session_start();
require __DIR__. '/../../vendor/autoload.php';
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
$productId = $_POST['product_id'];

$fileName = $_FILES["file"]["name"];
$fileType = $_FILES["file"]["type"];
$fileTmpName = $_FILES["file"]["tmp_name"];
$fileError = $_FILES["file"]["error"];
$fileSize = $_FILES["file"]["size"];

//validate
  if(empty($pname) || empty($qty) || empty($price) || empty($status) || empty($cat)){
    $_SESSION["errormsg"]= "Please fill all the fields";
    header('Location:../edit_product.php?id='.$productId);
    exit;
  }
  //validate
  if(empty($filename)){
    $_SESSION["errormsg"]= "Please select an image";
    header('Location:../edit_product.php?id='.$productId);
    exit;
  }
//validate
  if($fileerror != 0){
    $_SESSION["errormsg"]= "Please select an image";
    header('Location:../edit_product.php?id='.$productId);
    exit;
  }
  // problem 2: people uploading too large file
  if($filesize > 2097152){
      $_SESSION["errormsg"]= "Please you cannot upload more than 2mb";
     header('Location:../edit_product.php?id='.$productId);
      exit;
  }
  // problem 3: people uploading wrong file
  $allowed= ["jpg","jpeg","png"]; // list of what i allowed
  $fileext = pathinfo($filename, PATHINFO_EXTENSION);// return d extension of the file, then check if is not there
  if(!in_array($fileext, $allowed)){
    $_SESSION["errormsg"]= "Please supply files that is jpg or png or jpeg";
    header('Location:../edit_product.php?id='.$productId);
    exit;
  }
   // or upload to a folder
    $to = "../uploads/". $filename;
    $res = $productManager->updateProduct($pname,$filetmpname,$to,$price,$qty,$status,$cat,$productId);
    if($res){
        $_SESSION['adminfeedback']= "Product updated successfully";
        header('Location:../all_product.php');
    }else{
        $_SESSION['errormsg']= "Not Updated";
      header('Location:../edit_product.php?id='.$productId);
    }
  
   












