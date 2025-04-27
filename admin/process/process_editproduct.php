<?php
session_start();
require_once "../classes/Admin.php";
require_once "../admin_guard.php";
$ad = new Admin;



if(!isset($_POST["btn"])){
    // header('Location:../newproduct.php');
}
$pname = $_POST['name'];
$qty = $_POST['qty'];
$price = $_POST['price'];
$status = $_POST['status'];
$cat = $_POST['cat'];
$id = $_POST['pro'];

$filename = $_FILES["file"]["name"];
$filetype = $_FILES["file"]["type"];
$filetmpname = $_FILES["file"]["tmp_name"];
$fileerror = $_FILES["file"]["error"];
$filesize = $_FILES["file"]["size"];

echo "<pre>";
print_r($_FILES);
echo "</pre>";
if($fileerror != 0){
      $_SESSION["errormsg"]= "Please select an image";
      // header('Location:../fileupload.php');
    }

  // problem 2: people uploading too large file
  if($filesize > 2097152){
      $_SESSION["errormsg"]= "you cannot upload more than 2mb";
     // header('Location:../fileupload.php');
  }
  // problem 3: people uploading wrong file
  $allowed= ["jpg","jpeg","png"]; // list of what i allowed
  $fileext = pathinfo($filename, PATHINFO_EXTENSION);// return d extension of the file, then check if is not there
  if(!in_array($fileext, $allowed)){
      $_SESSION["errormsg"]= "Please supply files that is jpg or png or jpeg";
      // header("Location:../addpost.php");
     // exit;
  }
   // or upload to a folder
    $to = "../uploads/". $filename;
    $res = $ad->updateProduct($pname,$filetmpname,$to,$price,$qty,$status,$cat,$id);
    if($res){
        $_SESSION['adminfeedback']= "Product updated successfully";
        header('Location:../newproduct.php');
    }else{
        $_SESSION['errormsg']= "Not Updated";
      header('Location:../newproduct.php');
    }
   












?>