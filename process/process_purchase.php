<?php
    session_start();
    $pdo = require __DIR__. "/../servicemanager/Db.php";
    require_once "../customer_guard.php"; 
    require_once "../servicemanager/CartManager.php";
    use servicemanager\CartManager;
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
        if($data->cart_id > 0){
            $cartId = $data->cart_id;
        }else{
            $cartManager->insertIntoCart($customerId);
        }
        //check if product and cartid are in items table
        $dat = $cartManager->checkProductInCart($productId);
        if($dat){
            $cartManager->updateCartProduct($amt,$qty,$cartId,$productId);
            header('Location:../confirm_purchase.php');
            exit;
        }else{
          $res= $cartManager->insertIntoCartitem($qty,$customerId,$productId,$cartId,$amt);
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




