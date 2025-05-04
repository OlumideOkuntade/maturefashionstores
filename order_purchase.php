<?php
session_start();
$pdo = require __DIR__. "/servicemanager/Db.php";
require_once "servicemanager/CustomerManager.php";
require_once "servicemanager/CartManager.php";
require_once "servicemanager/ProductManager.php";
require_once "customer_guard.php"; 
$customerManager = new CustomerManager($pdo);
$cartManager = new CartManager($pdo);
$productManager = new ProductManager($pdo);
$customerId = $_SESSION["useronline"];
$productId = $_SESSION['productid'];
$size = $_SESSION['size'];
$data = $customerManager->getCustomerById($customerId);
$prod = $productManager->getProductbyId($productId);
$cartlist = $cartManager->getCartitem($customerId);
$counter = count($cartlist);
$_SESSION["counter"]= $counter;  
$tot = $cartManager->sumAmount($customerId); 
$totalAmt= $tot[0]->totalamt; 
// echo $total;
$_SESSION['totalamt']= $totalAmt;
      
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
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- navigation -->
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg " id='nav_head'>
                    <div class="container-fluid ">
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                            <a class="navbar-brand fw-bold me-auto fs-3 fst-italic" href="dashboard.php">Maturefashion</a>

                            <div class="dropdown user-menu d-flex align-items-center">
                                <a class="btn dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Hi, <?php echo $data->last_name ?>
                                </a>
                                <ul class="dropdown-menu user-profile" style="border-radius:0px;background-color:white;">
                                    <li><a class="dropdown-item text-dark" href="#">Profile</a></li>
                                    <li><a class="dropdown-item text-dark" href="customerorders.php">Orders</a></li>
                                    <li><a class="dropdown-item text-dark" href="logout.php">Logout</a></li>
                                </ul>
                                
                                    <!-- <a href="#"><i class="fa-solid fa-magnifying-glass mx-4"></i></a>   -->
                                    <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-cart-shopping me-4"></i></a>
                                    <span><?php 
                                    if(isset($_SESSION['counter'])){
                                        echo $_SESSION['counter'];
                                    }else{
                                        echo 0;
                                    }
                                    ?></span> -->
                            </div>
                      </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- end navigation -->
        <!-- cart table -->
        <div class="row">
            <div class="col-md-10 offset-1 mt-5">
                  <table class="table table-bordered">
                        <thead>
                              <tr>
                                    <th class="text-center">Product Image</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Amount</th>
                              </tr>
                        </thead>
                        <tbody>
                              <?php 
                              foreach($cartlist as $cart){
                                    $image = $cart->product_image;
                                    $amt = $cart->amount;        
                              ?>
                              <tr>
                                    <td class="text-center"><img src= "admin/uploads/<?php echo $image ?>" alt='image' class="img-fluid rounded" style="width:40px; height:30px;"></td>
                                    <td class="text-center"><?php echo $cart->product_name ?></td>
                                    <td class="text-center">&#8358;<?php echo number_format($amt)?></td>
                              </tr>
                              <?php
                              }   
                              ?>
                              
                        </tbody>
                  </table>
            </div>
            <div class="col-md-11">
                <p class="text-end">
                    Total amount: <?php if(isset($_SESSION['totalamt'])){
                        echo "&#8358;".number_format($_SESSION['totalamt']);
                    }else{ echo 0 ;} ?>
                </p>
                <form action="process/process_order.php" method="post">
                    <button class="btn btn-dark float-end" name="btnorder">Confirm order</button>
                </form>
            </div>
        </div>
        <!-- end cart table -->
    </div>
    
</body>
</html>

<?php
require_once "partials/footer.php";

?>
