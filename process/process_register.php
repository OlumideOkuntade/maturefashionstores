<?php
    session_start();
    $pdo = require __DIR__. "/../servicemanager/Db.php";
    require_once "../servicemanager/CustomerManager.php";
    use servicemanager\CustomerManager;
    $customerManager = new CustomerManager($pdo);
    if(!isset($_POST["btn"])){
        $_SESSION['errormsg'] = "Please complete the form";
        header("Location:../register.php");
        exit;
    }

    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $pass = $_POST["pass"];
    $radio = isset($_POST["radio"])? $_POST["radio"]:'';

    $_SESSION['firstname']= $firstName;
    $_SESSION['lastname']= $lastName;
    $_SESSION['email']= $email;
    $_SESSION['phone']= $phone;
    $_SESSION['pass']= $pass;
    $_SESSION['radio']= $radio;
    
    if(empty($firstName) || empty($lastName) || empty($email)|| empty($phone)|| empty($pass)|| empty($radio)){
        $err = "All fields are required";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $err = "Please choose a valid email";
    }elseif(strlen($pass) > 8){
        $err= "Password must be less than 8 character"; 
    }elseif($customerManager->checkEmailExit($email) === true){
        $err= "Email already in use";
    }else{$resp = $customerManager->insertCustomer($firstName,$lastName,$phone,$email,$pass);
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
   





    