<?php
session_start();
require_once("partials/header.php");


?>

<!-- login form -->
<div class="row">
  <div class="col-md-4 mb-5 offset-4 ">
    <div class="login">
      <h6 class="fs-5 mt-4">Login</h6>
      <?php
        if(isset($_SESSION{"errormsg"})){
          echo  "<div class='alert alert-danger'><p>". $_SESSION["errormsg"] ."</p></div>";
          unset($_SESSION["errormsg"]);
        }
        
        if(isset($_SESSION{"feedback"})){
          echo  "<div class='alert alert-info'><p>". $_SESSION["feedback"] ."</p></div>";
          unset($_SESSION["feedback"]);
        }
        

      ?>    

      <form action="process/process_login.php" method="post" class="mt-4">
        <div class=' form-floating '>
          <input type="email" name="email" class='form-control mb-4 ' placeholder="Enter your email" >
          <label for='email'>Enter your email</label>
        </div>
        <div class=' form-floating '>
          <input type="password" name="pass" class='form-control mb-4' placeholder="Enter your password" >
          <label for='password'>Enter your password</label>
        </div>
        <button class="btn btn-dark col-6 round-5 col-12 mb-4"name="login">Login</button>
        <div>
      </form>
    </div>
    <div class="mt-5 mb-5" >
      <h6>Don't have an account?</h6>
      <button class="btn btn-outline-dark col-12 round-5 "><a href="register.php">Create account</a></button>
    </div>
  </div>
</div>
<!-- end login -->
       
<?php
  require_once("partials/footer.php");


?>
       
