<?php  
            
    $name = $email = $userName = $password = $cpassword = $phone = $address = "";
    
    $validateName = $validateUserName = $validateEmail = $validateDob = $validateGender = "";
    $validatePhn = $validateAddr = "";
    $validatePassword = $validateCPassword = "";
    $ValidateAllField = "";


    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset']))
    {
        unset($_post);
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']))
    {
        $name = $_REQUEST["name"];
        $email = $_REQUEST["email"];
        $userName = $_REQUEST["username"];
        $password = $_REQUEST["password"];
        $cpassword = $_REQUEST["cpassword"];
        $address = $_REQUEST["address"];
        $phone = $_REQUEST["phone"];

        if(empty($name) || empty($_REQUEST["gender"]) || empty($password) || empty($cpassword) || empty($userName) || !empty($validateUserName) || empty($address) || empty($phone))
        {
            $ValidateAllField = "Please Fillup All The Field!!";
        }else{
            
            include("../control/dbConnect.php");
            $dbTry = new db();
            $conObj = $dbTry->OpenConn();
            $customerInsert = $dbTry->InsertCustomer($conObj, $name, $email, $userName, $password, $_REQUEST["gender"], $_REQUEST["dob"], $phone, $address);
            echo "<br>".$customerInsert;
            unset($_post);
            
        }
        if(empty($name) || strlen($name)<4)
        {
            $validateName = "You must Enter a valid Name";
        }
        if(empty($address))
        {
            $validateAddr = "You must Enter a address";
        }
        if(empty($phone))
        {
            $validatePhn = "You must Enter a Phone Number";
        }
        if(empty($userName) || strlen($userName)<6 || !preg_match("/^[A-Za-z0-9_~\-!@.#\$%\^&*\(\)]+$/",$userName))
        {
            $validateUserName = "Please enter Username Correctly";
        }
        if(empty($email) || !preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",$email))
        {
            $validateEmail = "You must Enter a valid Email";
        }
        
        if(empty($_REQUEST["gender"]))
        {
            $validateGender = "Please select a gender";
        }
        if(empty($_REQUEST["dob"]))
        {
            $validateDob = "Please Enter a Date";
        }
        
        if(empty($password) || strlen($password)<8)
        {
            $validatePassword = "You Must Enter a valid Password";
        }
        if( $password !=  $cpassword)
        {
            $validateCPassword = "Confirm Password isn't match";
        }
    }

?>