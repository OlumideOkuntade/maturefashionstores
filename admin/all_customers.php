<?php
    session_start();
    require __DIR__. '/../vendor/autoload.php';
    require_once "includes/header.php";
    require_once "admin_guard.php";
    use servicemanager\CustomerManager;
    use servicemanager\Db;
    $pdo = (new Db)->connect();
    $customerManager = new CustomerManager($pdo);
    $cus = $customerManager->getAllCustomers();

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
                <h3 class="fw-4 mt-3">All customer details</h3>
                <hr>
                <!-- <canvas class="my-4 w-100" id="myChart" width="2500" height="180"></canvas> -->
                <!-- <button class="btn btn-dark mb-5 float-end"><a href="newproduct.php">Edit Customer</a></button> -->
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>S/N</th> 
                            <th>First name</th> 
                            <th>Last name</th>
                            <th>Phone number</th>
                            <th>Email</th>
                           <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $m =1;
                            foreach($cus as $c){
                                $id = $c->customer_id;
                                $firstName = $c->first_name;
                                $lastName = $c->last_name;
                                $phoneNumber = $c->phone_number;
                                $email = $c->email;
                               echo "<tr>
                                        <td>$m</td>
                                        <td> $firstName </td>
                                        <td> $lastName</td>
                                        <td> $phoneNumber</td>
                                        <td>$email</td>
                                        <td><button class='btn btn-primary'><a href='editcustomer.php?id= $id'>Edit</a></buton></td>
                                        <td><button class='btn btn-primary'><a href='editcustomer.php?id=$id'>Details</a></buton></td>
                                        <td><button class='btn btn-danger'><a href='editcustomer.php?id=$id'>Delete</a></buton></td>
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