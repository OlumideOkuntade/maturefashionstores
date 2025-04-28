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

    if (!isset($_SESSION['errormsg'])) {
        $_SESSION['errormsg'] = "";
    }
    $errormsg = $_SESSION['errormsg'];
   
    if(empty($firstname) || empty($lastname) || empty($email)|| empty($phone)|| empty($pass)|| empty($radio)){
        $errormsg= "All fields are required";
        echo $errormsg;
        header("Location:../register.php?id=$errormsg");
        exit;
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errormsg = "Please choose a valid email";
        echo $errormsg;
        header("Location:../register.php?id=$errormsg");
        exit;
    }elseif(strlen($pass) > 8){
        $errormsg= "Password must be less than 8 character"; 
        echo $errormsg;
        header("Location:../register.php?id=$errormsg");
        exit;
    }elseif($cus->emailExit($email) === true){
        $errormsg= "Email already in use";
        echo $errormsg;
        header("Location:../register.php?id=$errormsg"); 
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
    