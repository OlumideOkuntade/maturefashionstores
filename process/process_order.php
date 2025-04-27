<?php
session_start();
require_once "../classes/Customer.php";
require_once "../classes/Payment.php";
require_once "../customer_guard.php";
$cus = new Customer; $pay = new Payment;

// if(!isset($_SESSION["orderId"])){
//   $_SESSION["errormsg"] = "Please specify your preference and click the button";
//   header("Location:../uniform.php");
//   exit;
// }
$customerid = $_SESSION["useronline"];
$productid = $_SESSION['productid'];
$size = $_SESSION['size'];
$totalamt = $_SESSION['totalamt'];

$ordId = $pay->insertOrder($totalamt,$customerid,$size,$productid);
$_SESSION['orderId'] = $ordId;

if(isset($_POST["btnorder"])){
    // $orders = $pay->orderbyId($_SESSION["orderId"]);
    $data = $cus->get_customer($_SESSION['useronline']);
    $email = $data['email'];
    $ordId = $_SESSION["orderId"];
    $ref = uniqid("REF");
    #we want to save $ref in session so that we can use it to verify status of the transaction
    $_SESSION["ref"] = $ref;

    $payid = $pay->insertPayment($totalamt,$customerid,$ref,$ordId);
      // next is to connect to paystack
    $response = $pay->paystack_initialize_step1($email,$totalamt,$ref);
    if($response){
        $auth_url = $response->data->authorization_url;
       header("Location:$auth_url");
       exit;
    }else{
      header("Location:../order_purchase.php");
      exit;
    }
    
}




?>