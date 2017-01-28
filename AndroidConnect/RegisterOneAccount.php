<?php
    header('Content-type:application/json');
    require_once "../Controller/AccountController.php";
    require_once "../Function/function.php";
    
    $email="";
    $password="";
    $nama="";
    $gender="";
    $birthdate="";
    
    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['nama']) && isset($_POST['gender']) && isset($_POST['birthdate']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $nama = $_POST['nama'];
        $gender = $_POST['gender'];
        $birthdate = $_POST['birthdate'];
    }
    $accountcontroller = new AccountController();
    
    if($email != "")
    {
        $response = $accountcontroller->getAccountByEmail($email);
        if($accountcontroller->getAccountByEmail($email))
        {
            $result["success"]=2;
            $result["message"]="Already Registered Account";   
        }
        else
        {
            if($accountcontroller->postAccountDefault($email, $password, $nama, $gender, $birthdate))
            {
                $result["success"]=1;
                $result["message"]="Success";
            }
            else
            {
                $result["success"]=3;
                $result["message"]="Server Error";   
            }
        }
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";       
    }
    echo json_encode($result,JSON_PRETTY_PRINT);
?>