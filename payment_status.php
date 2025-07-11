<?php
    session_start();
    require __DIR__. '/vendor/autoload.php';
   
    require_once "customer_guard.php";
    use servicemanager\PaymentManager;
    use servicemanager\CustomerManager;
    use servicemanager\Db;
    $pdo = (new Db)->connect();
    $customerId = $_SESSION["useronline"];
    $customerManager = new CustomerManager($pdo);
    $paymentManager = new PaymentManager($pdo);
    $data = $customerManager->getCustomerById($customerId);
    $pay = $paymentManager->PaymentDetailByCustomer($customerId);
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
                                    <li><a class="dropdown-item text-dark" href="customer_orders.php">Orders</a></li>
                                    <li><a class="dropdown-item text-dark" href="payment_status.php">Payment details</a></li>
                                    <li><a class="dropdown-item text-dark" href="logout.php">Logout</a></li>
                                </ul>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-cart-shopping me-4"></i></a>
                                
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-md-8 offset-2">
                <h3 class="fw-4 mt-3">Payment status</h3>
                <hr>
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
                            foreach($pay as $p){
                                $date = $p->payment_date;
                                $customerId = $p->customer_id;
                                $customerName = $p->first_name.' '.$p->last_name;
                                $amount = $p->payment_amount;
                                $status = $p->payment_status;
                                $ref = $p->payment_ref;
                                $orderNum = $p->payment_orderid;
                                $phone = $p->phone_number;
                               echo "<tr>
                                        <td>$m</td>
                                        <td>$date</td>
                                        <td>$customerId </td>
                                        <td>$customerName</td>
                                        <td>$amount </td>
                                        <td>$status</td>
                                        <td>$ref</td>
                                        <td>$orderNum</td>
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
require_once "partials/footer.php";
?>