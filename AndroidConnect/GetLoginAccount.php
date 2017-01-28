<?php
    header('Content-type:application/json');
    require_once "../Controller/AccountController.php";
    require_once "../Function/function.php";
    if(isset($_POST['email']) && $_POST['password'])
    {
        $email = /*"feechanz@yahoo.co.id";//*/$_POST['email'];
        $password = /*"feechan";//*/ $_POST['password'];
        
    }
    else
    {
        $email ="";
        $password = "";
    }
    if($email != "")
    {
        $accountcontroller = new AccountController();
        $response = $accountcontroller->getAccountByEmailPassword($email, $password);
        $result = json_decode(convertObjectToJSON($response),true);
        if($result["success"]==0)
        {
            if($accountcontroller->getAccountByEmail($email))
            {
                $result["success"]=2;
                $result["message"]="Wrong Password";
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