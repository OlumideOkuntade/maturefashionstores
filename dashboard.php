<?php
    session_start();
    $pdo = require __DIR__. "/servicemanager/Db.php";
    require_once "servicemanager/CustomerManager.php";
    require_once "customer_guard.php";
    require_once "servicemanager/ProductManager.php";
    use servicemanager\ProductManager; 
    use servicemanager\CustomerManager;
    $customerManager = new CustomerManager($pdo);
    $productManager = new ProductManager($pdo);
    $id = $_SESSION["useronline"];
    $data = $customerManager->getCustomerById($id);
    $prod = $productManager->getAllProducts();
 
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

                            <div class="dropdown user-menu ">
                                <a class="btn dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <strong>Hi, <?php echo $data->last_name;?></strong>
                                </a>
                                <ul class="dropdown-menu user-profile" style="border-radius:0px;background-color:white;">
                                    <li><a class="dropdown-item text-dark" href="#">Profile</a></li>
                                    <li><a class="dropdown-item text-dark" href="customer_orders.php">Orders</a></li>
                                    <li><a class="dropdown-item text-dark" href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                      </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- end of nav -->
        <div class="row mb-5">
            <div class="col-md-12 ">
                <h3 style="margin-bottom:20px;" class="text-center heading-title mt-2">Dashboard</h3> 
                <h4 class="mx-5">Welcome <?php echo $data->last_name ;?></h4>
                <p class="mx-5">You are logged in, Please select any cloth of choice for purchase.</p>
            </div>
        </div>
        <!-- end of welcome page -->
        <div class="row ms-5 me-5 card_container">
            <?php 
                foreach($prod as $pro){
            ?>        
                <div class="col-md-4 mb-3 ">
                    <div class="card" >
                        <img src="admin/uploads/<?php echo $pro->product_image ?>" class="img-fluid rounded" style="width:500px; height:400px;" alt="responsive image">
                        <div class="card-body ">
                            <p class="fs-6 fw-bold lh-1"><?php echo $pro->product_name?></p>
                            <div class="d-flex justify-content-between align-items-start">
                                <p class="fs-4 fw-bold lh-1 ">&#8358;<?php echo $pro->product_price ?></p>
                                <button class="btn btn-success round"><a href="purchase.php?id=<?php echo $pro->product_id ?>">Quick Buy</a></button>  
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
        

    </div>
    
<?php
require_once "partials/footer.php";

?>

</body>
