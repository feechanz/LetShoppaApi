<?php
    header('Content-type:application/json');
    require_once "../Controller/AccountController.php";
    require_once "../Function/function.php";
 
    
    if(isset($_POST['accountid']) && isset($_POST['password']) && isset($_POST['oldpassword']))
    {
        $accountid = $_POST['accountid'];
        $password = $_POST['password'];
        $oldpassword = $_POST['oldpassword'];
       
        $accountcontroller = new AccountController();
        $account = $accountcontroller->getAccountByAccountId($accountid);
        if($account->getPassword() != $oldpassword)
        {
            $result["success"]=2;
            $result["message"]="Old Password is not correct";   
        }
        else
        {
            if($accountcontroller->putAccountPassword($accountid,$password))
            {
                $result["success"]=1;
                $result["message"]="Success";
            }
            else
            {
                $result["success"]=3;
                $result["message"]="Server internal Error";   
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