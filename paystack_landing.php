<?php
session_start();
$pdo = require __DIR__. "/servicemanager/Db.php";
require_once "servicemanager/Customer.php";
require_once "servicemanager/PaymentManager.php";
require_once "customer_guard.php";
require_once "servicemanager/CartManager.php";
use servicemanager\PaymentManager;
use servicemanager\CartManager;
if(!isset($_SESSION['ref'])){
  $_SESSION["errormsg"] = "You need to start a transaction";
  header("Location:order_purchase.php");
  exit;
}
$paymentManager = new PaymentManager($pdo);
$cartManager = new CartManager($pdo);
$ref = $_SESSION["ref"];
$customerId = $_SESSION["useronline"];
#connect to paystack api to verify the transaction status
$rsp = $paymentManager->paystack_verify_step2($ref);
if($rsp && ($rsp->status)){
    #transaction was successful
    $paystatus = "paid";
    $amt_deducted = $rsp->data->amount;
    $data = json_encode($rsp);
    $_SESSION["feedback "]= "Payment successful";
  }else{
    #transaction failed
    $paystatus = "failed";
    $amt_deducted = 0;
    $data = json_encode($rsp);
    $_SESSION["errormsg"]= "Payment failed";
  }
 $paymentManager->updatePayment($paystatus,$data,$ref);
 $cartManager->deleteAllCartItem($customerid);

  header("Location:dashboard.php");
  exit;







