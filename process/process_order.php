<?php
session_start();
require_once "../classes/Customer.php";
require_once "../classes/Payment.php";
require_once "../customer_guard.php";
$customer = new Customer; $payment = new Payment;

$customerId = $_SESSION["useronline"];
$productId = $_SESSION['productid'];
$size = $_SESSION['size'];
$totalAmt = $_SESSION['totalamt'];

$ordId = $payment->insertOrder($totalAmt,$customerId,$size,$productId);
$_SESSION['orderId'] = $ordId;

if(isset($_POST["btnorder"])){
    $data = $customer->get_customer($_SESSION['useronline']);
    $email = $data['email'];
    $ordId = $_SESSION["orderId"];
    $ref = uniqid("REF");
    #we want to save $ref in session so that we can use it to verify status of the transaction
    $_SESSION["ref"] = $ref;

    $payId = $payment->insertPayment($totalAmt,$customerId,$ref,$ordId);
      // next is to connect to paystack
    $response = $payment->paystack_initialize_step1($email,$totalAmt,$ref);
    if($response){
        $auth_url = $response->data->authorization_url;
       header("Location:$auth_url");
       exit;
    }else{
      header("Location:../order_purchase.php");
      exit;
    }
    
}




