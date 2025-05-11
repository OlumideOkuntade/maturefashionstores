<?php
session_start();
require_once __DIR__ . "/../autoload.php";
require_once "includes/header.php";
require_once "admin_guard.php";
$id = $_GET["id"];
use servicemanager\Db;
$pdo = (new Db)->connect();
$productManager = new \servicemanager\ProductManager($pdo);
$dat = $productManager->fetchProductById($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <title>Document</title>
    <style>
       button a{
            color:white;
            text-decoration:none;
      }
    </style>
</head>

<body>
<div class="container-fluid">
      <div class="row mt-3" >
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
            <div class="col-6">
                  <h4 class="mb-5 pt-3">Edit Product</h4>
                  <button class="btn btn-dark mb-5 float-end"><a href="all_product.php">All products</a></button><br><br><br>
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
                  <form action="process/process_editproduct.php" method="post"enctype="multipart/form-data">
                        <input type="hidden" name="pro" value="<?php echo $dat->product_id ?>">
                        <div>
                              <label for="name">Product name</label>
                              <input type="text" name="name" id="name" class="form-control mb-3" value="<?php echo $dat->product_name ?>" >
                        </div>
                        <div>
                              <label for="qty">Quantity</label>
                              <input type="number" name="qty" id="qty" class="form-control mb-3" value="<?php echo $dat->product_quantity ?>">
                        </div>
                        <div>
                              <label for="price">Price</label>
                              <input type="text" name="price" id="price" class="form-control mb-3" value="<?php echo $dat->product_price ?>">
                        </div>
                        <div>
                              <label for="file">Upload Image</label>
                              <input type="file" name="file" id="file" class="form-control mb-3" value="<?php echo $dat->product_image ?>">

                        </div>
                        <div>
                              <label for="status">Status</label>
                              <select name="status" id="status" class="form-select mb-3">
                              <?php
                                    if($dat->product_status == "active"){
                              ?>
                                    <option value="<?php echo $dat->product_status ?>"> Active </option>
                              <?php
                                    }else{
                              ?>    
                                    <option value="<?php echo $dat->product_status ?>"> Inactve </option>
                              <?php
                                    }
                              ?>
                              </select>
                        </div>
                        <div>
                              <label for="cat">Product category</label>
                              <select name="cat" id="cat"class="form-select mb-3">
                                    <option value="<?php echo $dat->category_id ?>"><?php echo $dat->category_name ?></option>
                              </select>
                        </div>
                        <button class="btn btn-dark col-12 mb-3 round-4"type="submit" name="btn">Edit product</button>  
                  </form>
                  
            </div>
      </div>
</div>
 <?php
  require_once "includes/footer.php";
?>   
      
</body>
</html>










