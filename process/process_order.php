<?php
session_start();
require_once "../classes/Customer.php";
require_once "../classes/PaymentManager.php";
require_once "../customer_guard.php";
require_once "../classes/OrderManager.php";
$customer = new Customer; $payment = new PaymentManager; $order = new OrderManager;

$customerId = $_SESSION["useronline"];
$productId = $_SESSION['productid'];
$size = $_SESSION['size'];
$totalAmt = $_SESSION['totalamt'];

$ordId = $order->insertOrder($totalAmt,$customerId,$size,$productId);
$_SESSION['orderId'] = $ordId;

if(isset($_POST["btnorder"])){
  $data = $customer->getCustomer($_SESSION['useronline']);
  $email = $data['email'];
  $ordId = $_SESSION["orderId"];
  $ref = uniqid("REF");
  $_SESSION["ref"] = $ref;

  $payId = $payment->insertPayment($totalAmt,$customerId,$ref,$ordId);
  //connecting to paystack
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




