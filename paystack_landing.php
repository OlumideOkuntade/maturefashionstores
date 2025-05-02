<?php
session_start();
require_once "servicemanager/Customer.php";
require_once "servicemanager/PaymentManager.php";
require_once "customer_guard.php";
require_once "servicemanager/CartManager.php";
if(!isset($_SESSION['ref'])){
  $_SESSION["errormsg"] = "You need to start a transaction";
  header("Location:order_purchase.php");
  exit;
}
$payment = new PaymentManager;
$cartManager = new CartManager;
$ref = $_SESSION["ref"];
$customerId = $_SESSION["useronline"];
#connect to paystack api to verify the transaction status
$rsp = $payment->paystack_verify_step2($ref);
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
 $payment->updatePayment($paystatus,$data,$ref);
 $cartManager->deleteAllCartItem($customerid);

  header("Location:dashboard.php");
  exit;







