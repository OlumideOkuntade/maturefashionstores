<?php
session_start();
require_once "classes/Customer.php";
require_once "classes/CartManager.php";
require_once "customer_guard.php"; 
$cus = new Customer;
$car = new CartManager;
$customerid = $_SESSION["useronline"];
$productid = $_SESSION['productid'];
$size = $_SESSION['size'];
$data = $cus->get_customer($customerid);
$prod = $cus->productbyId($productid);
//print_r($_SESSION['counter']);
$cartlist = $car->getCartitem($customerid);

$counter = count($cartlist);
$_SESSION["counter"]= $counter;  
$tot = $car->totalAmt($customerid); 
$totalamt= $tot[0]['totalamt']; 
// echo $total;
$_SESSION['totalamt']= $totalamt;
      
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
                                    Hi, <?php echo $data["last_name"];?>
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

        <!-- purchase part -->
        <!-- <div class="row"> 
            <div class="col-md-6 ms-3 mt-5 mb-5">
                <img src="admin/uploads/<?php echo $prod[0]["product_image"]?> "class="img-fluid" style="width:500px;">
            </div>
            <div class="col-md-5 pt-5">
                <p class="fs-5 fw-bold"><?php echo $prod[0]["product_name"];?></p>
                <p class="fw-bold">Brand : Mature Fashion </p>
                <p class="fw-bold">NGN <?php echo number_format($prod[0]["product_price"]);?></p>
                <p class="fw-bold">Size: <?php echo $size;?></p>
                <p><?php if($prod[0]["product_quantity"]>0){
                    echo "in stock";
                  }
                else{
                    echo "out of stock";
                  } ?>
                </p>
            </div>
        </div> -->
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
                                    <td class="text-center"><img src= "admin/uploads/<?php echo $image?>" alt='image' class="img-fluid rounded" style="width:40px; height:30px;"></td>
                                    <td class="text-center"><?php echo $cart->product_name?></td>
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
            




        <!-- modal -->
        <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class='container'>
                            <?php 
                                foreach($cartlist as $cart){
                                    $image = $cart->product_image;
                                    $amt = $cart->amount;        
                            ?>
                                <div class='row'>
                                    <div class='col-md-8 mb-3'>
                                        <img src= "admin/uploads/<?php echo $image?>" alt='image' class="img-fluid rounded" style="width:40px; height:30px;">
                                        <?php echo $cart->product_name?>
                                        <?php echo $amt?>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-danger mb-2 btn-sm">Remove</button>
                                    </div>
                                </div>
                            <?php
                              }   
                            ?>
                        </div>
                    <div class="modal-footer">
                 
                        <input type="hidden" name="customer_id" value="<?php echo $customerid?>">
                        <button type="submit" class="btn btn-dark"></button>
                        
                        
                    </div>
                </div>
            </div>
        </div>   -->
    </div>
    
</body>
</html>

<?php
require_once "partials/footer.php";

?>
