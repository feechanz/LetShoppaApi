<?php
    header('Content-type:application/json');
    require_once "../Controller/OrderController.php";
    require_once "../Function/function.php";
    
    //$_POST['accountid']=1;
    //$_POST['statusorder']=1;
    if(isset($_POST['accountid']) && isset($_POST['statusorder']))
    {
        $accountid = $_POST['accountid'];
        $statusorder = $_POST['statusorder'];
        $ordercontroller = new OrderController();
        $response = $ordercontroller->getOrderByAccountidAndStatusorder($accountid, $statusorder)->getArrayCopy();
        echo convertArrayToJSON($response);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
        echo json_encode($result,JSON_PRETTY_PRINT);   
    }
?>