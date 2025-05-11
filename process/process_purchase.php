<?php
session_start();
require __DIR__. "/../autoload.php";
require_once "../customer_guard.php";
use servicemanager\Db;
use servicemanager\CartManager;
$pdo = (new Db)->connect();
$cartManager = new CartManager($pdo);

if(isset($_POST['addcart'])){
    $size = $_POST["size"];
    $productId = $_POST["product_id"]; 
    $price = $_POST["product_price"]; 
    $qty = $_POST['qty'];
    if($qty == ""){
        $qty = 1;
    }
    $amt = $qty * $price;
    $customerId = $_SESSION["useronline"];
    $_SESSION['productid'] = $productId;
    $_SESSION['size'] = $size;
    $data = $cartManager->getCustomerCartId($customerId);
    if($data === false){
        $cartManager->insertIntoCart($customerId);
        $data = $cartManager->getCustomerCartId($customerId);
        $cartId = $data->cart_id;
    }elseif($data){
        $cartId = $data->cart_id;
    }
    //check if product and cartid are in items table
    $dat = $cartManager->checkProductInCart($productId,$customerId);
    if($dat){
        $cartManager->updateCartProduct($amt,$qty,$cartId,$productId);
        header('Location:../confirm_purchase.php');
        exit;
    }else{
        $res= $cartManager->insertIntoCartitem($qty,$customerId,$productId,$cartId,$amt);
        if($res){             
            header("Location:../confirm_purchase.php");
            exit;
        }
    }  
}else{
    header('Location:../dashboard.php');
    exit;
}




