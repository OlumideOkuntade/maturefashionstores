<?php
    session_start();
    require_once "../classes/Customer.php";
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
    
    if(empty($firstname) || empty($lastname) || empty($email)|| empty($phone)|| empty($pass)|| empty($radio)){
        $err = "All fields are required";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $err = "Please choose a valid email";
    }elseif(strlen($pass) > 8){
        $err= "Password must be less than 8 character"; 
    }elseif($cus->emailExits($email) === true){
        $err= "Email already in use";
    }else{$resp = $cus->insertCustomer($firstname,$lastname,$phone,$email,$pass);
        if($resp){
           $_SESSION["feedback"]= "An account has been created for you, please login";
           header("Location:../login.php");
           exit;
        }
    }
    $_SESSION['errormsg'] = $err;
    $redirect = "../register.php?";
    header("Location:$redirect");
    exit;
   





    