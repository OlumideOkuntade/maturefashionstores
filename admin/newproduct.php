<?php
      session_start();
      require_once __DIR__ . "/../servicemanager/AdminManager.php";
      require_once "includes/header.php";
      require_once "admin_guard.php";
      $admin = new AdminManager;
      $data = $admin->fetchCatergory(); 
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
                        <a class="nav-link" href="#">
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
                        <a class="nav-link" href="#">
                        <span data-feather="layers"></span>
                        Integrations
                        </a>
                    </li>
                    </ul>        
                </div>
            </nav>
                  <div class="col-md-6 offset-1 ">
                        <h4 class="text-center mb-3 pt-3">Add Product</h4>
                        <button class="btn btn-dark mb-4 float-end"><a href="allproduct.php">All product</a></button>
                        <br><br><br>
                        <hr>
                       
                        <?php
                              if(isset($_SESSION["adminfeedback"])){
                                    echo "<div class='alert alert-success'>" . $_SESSION['adminfeedback']. "</div>";
                                    unset($_SESSION['adminfeedback']);
                              }
                              if(isset($_SESSION["errormsg"])){
                                    echo "<div class='alert alert-danger'>" . $_SESSION['errormsg'] . " </div>";
                                    unset($_SESSION['errormsg']);
                              }
                        ?>
                        <form action="process/process_newproduct.php" method="post"enctype="multipart/form-data">
                              <div>
                                    <label for="name">Product name</label>
                                    <input type="text" name="name" id="name" class="form-control mb-3" >
                              </div>
                              <div>
                                    <label for="qty">Quantity</label>
                                    <input type="number" name="qty" id="qty" class="form-control mb-3">
                              </div>
                              <div>
                                    <label for="price">Price</label>
                                    <input type="text" name="price" id="price" class="form-control mb-3">
                              </div>
                              <div>
                                    <label for="file">Upload Image</label>
                                    <input type="file" name="file" id="file" class="form-control mb-3" placeholder="please upload file">

                              </div>
                              <div>
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-select mb-3">
                                          <option value="active">Active</option>
                                          <option value="inactive">Inactive</option>
                                    </select>
                              </div>
                              <div>
                                    <label for="cat">Product category</label>
                                    <select name="cat" id="cat"class="form-select mb-3">
                                           <option value="#">Please select category</option>
                                          <option value="<?php echo $data[0]['category_id']?>"><?php echo $data[0]['category_name']?></option>
                                          <option value="<?php echo $data[1]['category_id']?>"><?php echo $data[1]['category_name']?></option>
                                          <option value="<?php echo $data[2]['category_id']?>"><?php echo $data[2]['category_name']?></option>
                                          <option value="<?php echo $data[3]['category_id']?>"><?php echo $data[3]['category_name']?></option>
                                    </select>
                              </div>
                              <button class="btn btn-dark col-12 mb-3 round-4"type="submit" name="btn">Add product</button>  
                        </form>
                            
                  </div>
            </div>
      </div>
      
<?php
  require_once "includes/footer.php";
?>
</body>
</html>
