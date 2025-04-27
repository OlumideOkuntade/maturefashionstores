<?php
  require_once "classes/Admin.php";
  require_once "admin_guard.php";
  $id =  $_SESSION["adminonline"];
  $ad = new Admin;
  $data = $ad->getAdmin($id);
  // echo "<pre>";
  // print_r($data['admin_username']);
  // echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Admin-MaturedfashionStores</title>
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
              <a class="navbar-brand fw-bold me-auto fs-3 fst-italic" href="../admin/dashboard.php">Maturefashion</a>
              <div class="nav_form">
                <div class="dropdown user-menu">
                  <a class="btn dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Hi <?php echo $data['admin_username'] ?>
                  </a>
                  <ul class="dropdown-menu user-profile">
                    <li><a class="dropdown-item text-dark" href="logout.php">Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
    <!-- end of nav -->
  </div>
</body>
