<?php
    header('Content-type:application/json');
    require_once "../Controller/FollowController.php";
    require_once "../Function/function.php";
    
    $accountid="";
    $targetaccountid="";
    if(isset($_POST['accountid']) && isset($_POST['targetaccountid']))
    {
        $accountid = $_POST['accountid'];
        $targetaccountid = $_POST['targetaccountid'];
        $followcontroller = new FollowController();
        if($followcontroller->postFollow($accountid, $targetaccountid))
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
    else 
    {
        $result["success"]=4;
        $result["message"]="Bad Request";  
    }
    echo json_encode($result,JSON_PRETTY_PRINT);
?>