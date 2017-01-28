<?php
    header('Content-type:application/json');
    require_once "../Controller/AccountController.php";
    require_once "../Function/function.php";
    if(isset($_POST['accountid']) && isset($_POST['targetaccountid']))
    {
        $accountid = $_POST['accountid'];
        $targetaccountid = $_POST['targetaccountid'];
        $accountcontroller = new AccountController();
        $response = $accountcontroller->getOneFollowing($accountid,$targetaccountid);
        $result = json_decode(convertObjectToJSON($response),true);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
    }
    echo json_encode($result,JSON_PRETTY_PRINT);   
?>