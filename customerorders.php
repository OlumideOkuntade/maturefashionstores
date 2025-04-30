<?php
    session_start();
    require_once "classes/Customer.php";
    require_once "customer_guard.php"; 
    $customer = new Customer;
    $customerId = $_SESSION["useronline"];
    $data = $customer->get_customer($customerId);
    $orders = $customer->allOrders($customerId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
    
</head>
<style>
    tr td button a{
        text-decoration:none;
        color: white;
    }
    tr td img{
        width: 80px;
        height:50px;
    }
    
    button a{
        color:white;
        text-decoration:none;
    }
     
</style>
<body>
    <div class="container-fluid">
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
                                <a class="btn dropdown-toggle fs-5" href="#" role="button"          data-bs-toggle="dropdown" aria-expanded="false">
                                    Hi, <?php echo $data["last_name"];?>
                                </a>
                                <ul class="dropdown-menu user-profile" style="border-radius:0px;background-color:white;">
                                    <li><a class="dropdown-item text-dark" href="#">Profile</a></li>
                                    <li><a class="dropdown-item text-dark" href="customerorders.php">Orders</a></li>
                                    <li><a class="dropdown-item text-dark" href="logout.php">Logout</a></li>
                                </ul>
                                
                                    <!-- <a href="#"><i class="fa-solid fa-magnifying-glass mx-4"></i></a>   -->
                                    <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-cart-shopping me-4"></i></a> -->
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
            <div class="col-md-8 offset-1">
                <h3 class="fw-4 mt-3">Order listings</h3>
                <hr>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>S/N</th> 
                            <th>Order date</th> 
                            <th>Product name</th>
                            <th>Product image</th>
                            <th>Product size</th>
                            <th>Order amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $m =1;
                            foreach($orders as $order){
                                $date = $order['order_date'];
                                $productname = $order['product_name'];
                                $productimage = $order['product_image'];
                                $size = $order['order_size'];
                                $amount = $order['order_amount'];
                            echo "<tr>
                                    <td>$m</td>
                                    <td>$date</td>
                                    <td>$productname</td>
                                    <td><img src='Admin/uploads/$order[product_image]'></td>
                                    <td>$size</td>
                                    <td>$amount</td>
                                </tr>";
                                $m++;

                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<?php
require_once "partials/footer.php";

?>