<?php
session_start();
$pdo = require __DIR__. "/../servicemanager/Db.php";
require_once "../servicemanager/CustomerManager.php";
require_once "../servicemanager/PaymentManager.php";
require_once "../customer_guard.php";
require_once "../servicemanager/OrderManager.php";
use servicemanager\OrderManager;
use servicemanager\PaymentManager;
use servicemanager\CustomerManager;
$customerManager = new CustomerManager($pdo); $paymentManager = new PaymentManager($pdo); $orderManager = new OrderManager($pdo);

$customerId = $_SESSION["useronline"];
$productId = $_SESSION['productid'];
$size = $_SESSION['size'];
$totalAmt = $_SESSION['totalamt'];

$ordId = $orderManager->insertOrder($totalAmt,$customerId,$size,$productId);
$_SESSION['orderId'] = $ordId;

if(isset($_POST["btnorder"])){
  $data = $customerManager->getCustomerById($_SESSION['useronline']);
  $email = $data['email'];
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




