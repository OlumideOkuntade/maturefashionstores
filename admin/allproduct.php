<?php
    session_start();
    $pdo = require_once __DIR__ . "/../servicemanager/Db.php";
    require_once __DIR__ . "/../servicemanager/ProductManager.php";
    require_once "includes/header.php";
    require_once "admin_guard.php";
    $productManager = new \servicemanager\ProductManager($pdo);
    $prod = $productManager->getAllProducts(); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
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
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-5">
                            <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="dashboard.php">
                                <span data-feather="home"></span>
                                Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="allorders.php">
                                <span data-feather="file"></span>
                                Orders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="allproduct.php">
                                <span data-feather="shopping-cart"></span>
                                Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="allcustomers.php">
                                <span data-feather="users"></span>
                                Customers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                <span data-feather="bar-chart-2"></span>
                                Reports
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="allpayment.php">
                                <span data-feather="layers"></span>
                                Payment status
                                </a>
                            </li>
                            </ul>        
                    </div>
            </nav>
            <div class="col-md-8">
                <h3 class="fw-4 mt-3">Product listings</h3>
                <hr>
                <!-- <canvas class="my-4 w-100" id="myChart" width="2500" height="180"></canvas> -->
                <button class="btn btn-dark mb-5 float-end"><a href="newproduct.php">Add product</a></button>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>S/N</th> 
                            <th>Product Name</th> 
                            <th>Product image</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $m =1;
                            foreach($prod as $p){
                                $productId = $p->product_id;
                                $productName = $p->product_name;
                                $productImage = $p->product_image;
                                $productPrice = $p->product_price;
                                $productQuantity = $p->product_quantity;
                                $productStatus = $p->product_status;
                               echo "<tr>
                                        <td>$m</td>
                                        <td>$productName</td>
                                        <td><img src='uploads/$productImage'></td>
                                        <td>$productPrice</td>
                                        <td>$productQuantity</td>
                                        <td>$productStatus</td>
                                        <td><button class='btn btn-primary'><a href='editproduct.php?id=$productId'>Edit</a></buton></td>
                                        <td><button class='btn btn-primary'><a href='editproduct.php?id=$productId'>Details</a></buton></td>
                                        <td><button class='btn btn-danger'><a href='editproduct.php?id=$productId'>Delete</a></buton></td>
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
  require_once "includes/footer.php";
 ?>