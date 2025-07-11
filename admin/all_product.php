<?php
    session_start();
    require __DIR__. '/../vendor/autoload.php';
    require_once "includes/header.php";
    require_once "admin_guard.php";
    use servicemanager\Db;
    $pdo = (new Db)->connect();
    $productManager = new \servicemanager\ProductManager($pdo);
    $prod = $productManager->getAllProducts(); 
?>
<!DOCTYPE html>
<html lang="en">
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
                                <a class="nav-link" href="all_orders.php">
                                <span data-feather="file"></span>
                                Orders
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="all_product.php">
                                <span data-feather="shopping-cart"></span>
                                Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="all_customers.php">
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
                                <a class="nav-link" href="all_payment.php">
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
                <button class="btn btn-dark mb-5 float-end"><a href="new_product.php">Add product</a></button>
                 <?php
                        if(isset($_SESSION["adminfeedback"])){
                              echo "<div class='alert alert-success'>" . $_SESSION["adminfeedback"]. " </div>";
                              unset($_SESSION['adminfeedback']);
                        }
                        if(isset($_SESSION["errormsg"])){
                              echo "<div class='alert alert-danger'>" . $_SESSION["errormsg"] . " </div>";
                              unset($_SESSION['errormsg']);
                        }
                  ?>
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
                                        <td><button class='btn btn-primary'><a href='edit_product.php?id=$productId'>Edit</a></buton></td>
                                        <td><button class='btn btn-danger'><a href='process/delete_product.php?id=$productId'>Delete</a></buton></td>
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