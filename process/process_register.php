<?php
    session_start();
    require_once "../Classes/Customer.php";
    $cus = new Customer;
    if(!isset($_POST["btn"])){
        $_SESSION['errormsg'] = "Please complete the form";
        header("Location:../register.php");
        exit;
    }

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $pass = $_POST["pass"];
    $radio = isset($_POST["radio"])? $_POST["radio"]:'';

    $_SESSION['firstname']= $firstname;
    $_SESSION['lastname']= $lastname;
    $_SESSION['email']= $email;
    $_SESSION['phone']= $phone;
    $_SESSION['pass']= $pass;
    $_SESSION['radio']= $radio;
   
    //validate the form
    if(empty($firstname) || empty($lastname) || empty($email)|| empty($phone)|| empty($pass)|| empty($radio)){
        $_SESSION["errormsg"]= "All fields are required";
         header("Location:../register.php");
         exit;
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $_SESSION["errormsg"]= "Please choose a valid email";
        header("Location:../register.php"); 
        exit;
    }elseif(strlen($pass) > 8){
        $_SESSION["errormsg"]= "Password must be less than 8 character"; 
        header("Location:../register.php");
        exit;
    }elseif($cus->emailExit($email) === true){
        $_SESSION["errormsg"]= "Email already in use";
        header("Location:../register.php"); 
        exit;
    }else{
        $resp = $cus->insertCustomer($firstname,$lastname,$phone,$email,$pass);
        if($resp){
           $_SESSION["feedback"]= "An account has been created for you, please login";
           header("Location:../login.php");
            exit;  
        }else{
            $_SESSION["errormsg"]= "registration failed, try again";
            header("Location:../register.php");
            exit;   
        }
    }

    









?>
    