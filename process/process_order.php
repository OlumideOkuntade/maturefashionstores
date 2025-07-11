<?php
session_start();
require __DIR__. '/../vendor/autoload.php';
require_once "../customer_guard.php";
use servicemanager\OrderManager;
use servicemanager\PaymentManager;
use servicemanager\CustomerManager;
use servicemanager\Db;
$pdo = (new Db)->connect();
$customerManager = new CustomerManager($pdo); $paymentManager = new PaymentManager($pdo); $orderManager = new OrderManager($pdo);
$customerId = $_SESSION["useronline"];
$productId = $_SESSION['productid'];
$size = $_SESSION['size'];
$totalAmt = $_SESSION['totalamt'];

$ordId = $orderManager->insertOrder($totalAmt,$customerId,$size,$productId);
$_SESSION['orderId'] = $ordId;

if(isset($_POST["btnorder"])){
  $data = $customerManager->getCustomerById($_SESSION['useronline']);
  $email = $data->email;
  $ordId = $_SESSION["orderId"];
  $ref = uniqid("REF");
  $_SESSION["ref"] = $ref;

  $payId = $paymentManager->insertPayment($totalAmt,$customerId,$ref,$ordId);
  //connecting to paystack
  $response = $paymentManager->paystack_initialize_step1($email,$totalAmt,$ref);
  if($response){
      $auth_url = $response->data->authorization_url;
      header("Location:$auth_url");
      exit;
  }else{
    header("Location:../order_purchase.php");
    exit;
  }
    
}




