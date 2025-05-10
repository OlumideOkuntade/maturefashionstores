<?php
require_once "customer_guard.php"; 
require_once "servicemanager/CartManager.php";
use servicemanager\CartManager;
$cartManager = new CartManager($pdo);
$customerId = $_SESSION["useronline"];
$cartList = $cartManager->getCartItem($customerId);
$tot = $cartManager->sumAmount($customerId);
$totalAmt= $tot[0]->totalamt; 
$_SESSION['total']= $totalAmt; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>MaturedfashionStores</title>
    <style>
        #nav_head span{
            color:white;
            width:20px;
            text-align:center;
            /* height:20px; */ 
            font-weight:bold;
            background-color:red;
            border-radius:50%;
            font-size:15px;
            margin-left:-28px;
            display:block;
            margin-top:25px;
        }
        .modal button a {
            text-decoration:none;
            color:white;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class='container'>
                            <div class='row'>
                                <div class='col-md-12 mb-3'>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Image</th><th>Description</th><th>Qty</th><th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach($cartList as $cart){
                                                    $image = $cart->product_image; 
                                                    $amt  = $cart->amount     
                                            ?>
                                                <tr>
                                                    <td><img src= "admin/uploads/<?php echo $image?>" alt='image' class="img-fluid rounded me-3" style="width:40px; height:30px;"></td>
                                                    <td><?php echo $cart->product_name?></td>
                                                    <td style="text-align:center;"><?php echo $cart->quantity?></td>
                                                    <td style="text-align: right;"><?php echo number_format($amt)?></td>
                                                    <td><button class="btn btn-danger float-end"><a href="process/process_delete.php?id=<?php echo $cart->product_id?>">Delete</a></button></td>
                                                </tr>
                                            <?php
                                            }   
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark"><a href="order_purchase.php">Checkout <?php 
                        if(isset($_SESSION['total'])){
                            echo "&#8358". "(". number_format($totalAmt) .")";
                        }else{
                            echo 0;
                        }?> </a></button>   
                    </div>
                </div>
            </div>
        </div>
        <!-- end Modal -->
    </div>
</body>
</html>
