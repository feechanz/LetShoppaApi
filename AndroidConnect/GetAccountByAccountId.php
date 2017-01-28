<?php
    header('Content-type:application/json');
    require_once "../Controller/AccountController.php";
    require_once "../Function/function.php";
    if(isset($_POST['accountid']) )
    {
        $accountid = /*"feechanz@yahoo.co.id";//*/$_POST['accountid'];
        
    }
    else
    {
        $accountid ="";
    }
    if($accountid != "")
    {
        $accountcontroller = new AccountController();
        $response = $accountcontroller->getAccountByAccountId($accountid);
        $result = json_decode(convertObjectToJSON($response),true);
    
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
    }
    echo json_encode($result,JSON_PRETTY_PRINT);   
?>