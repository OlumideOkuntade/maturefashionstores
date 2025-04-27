<?php
    session_start();
    require_once "classes/Admin.php";
    require_once "includes/header.php";
    require_once "admin_guard.php";
    $ad = new Admin;
    $payment = $ad->paidPayment();
//     echo "<pre>";
//     print_r($payment);
//     echo "</pre>";
// ?>
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
                <h3 class="fw-4 mt-3">Payment status</h3>
                <hr>
                <!-- <canvas class="my-4 w-100" id="myChart" width="2500" height="180"></canvas> -->
                <!-- <button class="btn btn-dark mb-5 float-end"><a href="newproduct.php">Add product</a></button> -->
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>S/N</th> 
                            <th>Payment date</th> 
                            <th>Customer id</th>
                            <th>Customer name</th> 
                            <th>Payment amount</th>
                            <th>Payment status</th>
                            <th>Payment ref</th>
                            <th>Payment orderid</th>
                            <th>Customer phone number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $m =1;
                            foreach($payment as $pay){
                                $date = $pay['payment_date'];
                                $customerid = $pay['customer_id'];
                                $customername = $pay['first_name'].' '.$pay['last_name'];
                                $amount = $pay['payment_amount'];
                                $status = $pay['payment_status'];
                                $ref = $pay['payment_ref'];
                                $ordernum = $pay['payment_orderid'];
                                $phone = $pay['phone_number'];
                               echo "<tr>
                                        <td>$m</td>
                                        <td>$date</td>
                                        <td>$customerid </td>
                                        <td>$customername</td>
                                        <td>$amount </td>
                                        <td>$status</td>
                                        <td>$ref</td>
                                        <td>$ordernum</td>
                                        <td>$phone</td>
                                        
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