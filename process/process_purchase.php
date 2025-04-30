<?php
    session_start();
    require_once "../classes/Customer.php";
    require_once "../customer_guard.php"; 
    require_once "../classes/CartManager.php";
    $cus = new Customer;
    $car = new CartManager;

    if(isset($_POST['addcart'])){
        $size = $_POST["size"];
        $productid = $_POST["product_id"]; 
        $price = $_POST["product_price"]; 
        $qty = $_POST['qty'];
        if($qty == ""){
            $qty = 1;
        }
        $amt = $qty * $price;
        $customerid = $_SESSION["useronline"];
        $_SESSION['productid'] = $productid;
        $_SESSION['size'] = $size;
        $data = $car->getCustomerCartId($customerid);
        // echo "<pre>";
        // echo print_r($data->cart_id);
        // echo "</pre>";
        if($data->cart_id > 0){
            $cartid = $data->cart_id;
        }else{
            $car->insertIntoCart($customerid);
        }
        //check if product and cartid are in items table
        $dat = $car->checkProductInCart($productid);
        if($dat){
            $car->updateCartProduct($amt,$qty,$cartid,$productid);
            header('Location:../confirm_purchase.php');
            exit;
        }else{
          $res= $car->insertIntoCartitem($qty,$customerid,$productid,$cartid,$amt);
          if($res == true){             
                header("Location:../confirm_purchase.php");
                exit;
            }else{
                echo "not successful";
            }
        }  
    }else{
        header('Location:../dashboard.php');
        exit;
    }




