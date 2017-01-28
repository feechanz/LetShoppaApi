<?php
    header('Content-type:application/json');
    require_once "../Controller/OrderController.php";
    require_once "../Function/function.php";
    if(isset($_POST['orderid']) )
    {
        $orderid = $_POST['orderid'];
        $ordercontroller = new OrderController();
        $response = $ordercontroller->getOrderByOrderid($orderid);
        $result = json_decode(convertObjectToJSON($response),true);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
    }
    echo json_encode($result,JSON_PRETTY_PRINT);   
?>