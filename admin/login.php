<?php
  session_start();
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
                  <a class="navbar-brand fw-bold me-auto fs-3 fst-italic" href="login.php">Maturefashion</a>
                  <a href="logout.php">REGISTER</a>
              </div>
            </nav>
          </div>
      </div>
    </div>
    <!-- end navigation -->
    <div class="row">
      <div class="col-md-4 offset-4 mt-5 register">
        <h6 class="fs-5">Administrative login</h6>
        <?php
          if(isset($_SESSION["errormsg"])){
            echo "<div class='alert alert-danger'>". $_SESSION["errormsg"] ."</div>";
            unset($_SESSION["errormsg"]);
          }
          if(isset($_SESSION["feedback"])){
            echo "<div class='alert alert-success'>". $_SESSION["feedback"] ."</div>";
            unset($_SESSION["feedback"]);
          }

        ?>
        <form action="process/adminlogin_process.php" method="post">
          <div class='form-floating'>
            <input type="text" name="username" class='form-control mb-3'placeholder="Enter your username">
            <label>Enter your Username</label>
          </div>
          <div class='form-floating'>
            <input type="password" name="pass" class='form-control mb-3 ' placeholder="Enter your password" >
            <label>Enter your password</label>
          </div>
          <button name="btn"class="btn btn-dark col-12 round-5 mb-2">Login</button>
        </form> 
      </div>
    </div> 
  <script src="scripts/jquery.js"></script>
  <script></script>  
<body>
</html>

  









