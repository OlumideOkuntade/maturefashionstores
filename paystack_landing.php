<?php
session_start();
require_once "classes/Customer.php";
require_once "classes/Payment.php";
require_once "customer_guard.php";
if(!isset($_SESSION['ref'])){
    $_SESSION["errormsg"] = "You need to start a transaction";
    header("Location:order_purchase.php");
    exit;
}
$pay = new Payment;
$ref = $_SESSION["ref"];
$customerid = $_SESSION["useronline"];
#next : connect to paystack api to verify the transaction status
$rsp = $pay->paystack_verify_step2($ref);
// echo "<pre>";
// print_r($rsp);
// echo "</pre>";
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

 $pay->updatePayment($paystatus,$data,$ref);
 $car->deleteAllCartItem($customerid);

  header("Location:dashboard.php");
  exit;







