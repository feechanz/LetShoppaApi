<?php
    header('Content-type:application/json');
    require_once "../Controller/AccountController.php";
    require_once "../Function/function.php";
    if(isset($_POST['accountid']))
    {
        $accountid = $_POST['accountid'];
        $accountcontroller = new AccountController();
        $response = $accountcontroller->getAllFollowingByAccountId($accountid) ->getArrayCopy();
        echo convertArrayToJSON($response);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
        echo json_encode($result,JSON_PRETTY_PRINT);   
    }
?>

