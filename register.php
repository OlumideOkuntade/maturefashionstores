<?php
session_start();

require_once("partials/header.php");
?>

<div class="row">
  <div class="col-md-4 offset-4 mt-5 register">
    <h6 class="fs-5">Create Account</h6>
      <?php
        if(isset($_SESSION["errormsg"])){
          echo "<div class='alert alert-danger'><p>". $_SESSION["errormsg"] ."</p></div>";
          unset($_SESSION["errormsg"]);
        }
        if(isset($_SESSION["feedback"])){
          echo "<div class='alert alert-success'><p>". $_SESSION["feedback"] ."</p></div>";
          unset($_SESSION["feedback"]);
        }


      ?>
      <form action="process/process_register.php" method="post">
        <div class=' form-floating '>
          <input type="text" name="firstname" class='form-control mb-3 ' placeholder="Enter your Firstname">
          <label >First name</label>
        </div>
        <div class=' form-floating '>
          <input type="text" name="lastname" class='form-control mb-3' placeholder="Enter your Lastname" >
          <label >Last name</label>
        </div>
        <div class=' form-floating '>
          <input type="email" name="email" class='form-control mb-3'placeholder="Enter your email">
          <label>Enter your email</label>
        </div>
        <div class=' form-floating '>
          <input type="text" name="phone" class='form-control mb-3 ' placeholder="Enter phone number" >
          <label>Phone number</label>
        </div>
        <div class=' form-floating '>
          <input type="password" name="pass" class='form-control mb-3 ' placeholder="Enter your password" >
          <label>Enter your password</label>
        </div>
        <label>Would you like to receive updates on Mature latest products, 
          releases and exclusive partnerships in line with our privacy policy?</label>
        <div>
          <input type="radio" name="radio" class=" mb-2" value="yes"> Yes
        </div>
        <div>
          <input type="radio" name="radio" class=" mb-5" value="no"> No
        </div>
        <button name="btn"class="btn btn-dark col-12 round-5 mb-2">Create</button>
        <p>By continuing, you agree to the Terms of use and Privacy Policy.</p> 
      </form> 
      <div class="mt-5 mb-5">
      <p>Already have an account?</p>
        <button class="btn btn-outline-dark col-12 round-5"><a href="login.php">Sign in</a></button>
      </div>
  </div>
  </div> 
  <script src="scripts/jquery.js"></script>
  <script>

  </script>  

<?php
  
  require_once("partials/footer.php");

?>






