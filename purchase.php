<?php
session_start();
$pdo = require __DIR__. "/servicemanager/Db.php";
require_once "servicemanager/CustomerManager.php";
require_once "customer_guard.php"; 
require_once "servicemanager/CartManager.php";
require_once "servicemanager/ProductManager.php";
use servicemanager\ProductManager;
use servicemanager\CartManager;
use servicemanager\CustomerManager;
$customerManager = new CustomerManager($pdo);
$cartManager = new CartManager($pdo);
$productManager = new ProductManager($pdo);
$customerId = $_SESSION["useronline"];
$data = $customerManager->getCustomerById($customerId);
$id = $_GET['id'];
$prod = $productManager->getProductById($id);
$cartList = $cartManager->getCartitem($customerId);
$counter = count($cartList);
$_SESSION["counter"]= $counter;   
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
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-cart-shopping me-4"></i></a>
                                    <span><?php 
                                    if(isset($_SESSION['counter'])){
                                        echo $_SESSION['counter'];
                                    }else{
                                        echo 0;
                                    }
                                    ?></span>
                            </div>
                      </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- end navigation -->

        <!-- purchase part -->
        <div class="row"> 
            <div class="col-md-6 ms-3 mt-5 mb-5">
                <img src="admin/uploads/<?php echo $prod->product_image ?> "class="img-fluid" style="width:500px;">
            </div>
            <div class="col-md-5 pt-5">
                <p class="fs-5 fw-bold"><?php echo $prod->product_name ?></p>
                <p class="fw-bold">Brand : Mature Fashion </p>
                <p class="fw-bold">NGN <?php echo number_format($prod->product_price );?> </p>
                <p><?php if($prod->product_quantity > 0){
                    echo "in stock";
                }
                else{
                    echo "out of stock";
                } ?>
                </p>
                
                <form action ="process/process_purchase.php" method="post">
                    <div class="mb-4">
                        <select class="form-select noround border-dark" name="size">
                            <option value="#">Choose Size</option>
                            <option value="small">S</option>
                            <option value="medium">M</option>
                            <option value="large">L</option>
                            <option value="extra large">XL</option>
                        </select>
                        <input type="hidden"name="product_id" value="<?php echo $prod->product_id ?>">
                        <input type="hidden"name="product_price" value="<?php echo $prod->product_price ?>">
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <input type="number" min='1' name="qty" class="col-4 rounded text-center" >
                    </div>
                    <div>
                        <button class="btn btn-dark col-12 rounded-7 col-12 mb-4"name="addcart">Add to Cart</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class='container'>
                            <?php 
                                foreach($cartList as $cart){
                                    $image = $cart->product_image;
                            ?>
                                <div class='row'>
                                    <div class='col-md-8 mb-3'>
                                        <img src= "admin/uploads/<?php echo $image?>" alt='image' class="img-fluid rounded me-3" style="width:40px; height:30px;">
                                        <span class="me-2"><?php echo $cart->product_name?></span>
                                        <span class="ms-2"><?php  echo $cart->product_price?></span>
                                        <span class="ms-2"><?php echo $cart->quantity?></span>
                                    </div>
                                </div>
                            <?php
                                }   
                            ?>
                        </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
require_once "partials/footer.php";
?>
