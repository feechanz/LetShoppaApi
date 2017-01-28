<?php
    header('Content-type:application/json');
    require_once "../Controller/OrderController.php";
    require_once "../Function/function.php";
       
    $orderid="";
  
    if(isset($_POST['orderid']))
    {
        $orderid = $_POST['orderid'];
        $ordercontroller = new OrderController();
        if($ordercontroller->deleteOrder($orderid))
        {
            $result["success"]=1;
            $result["message"]="Success";
        }
        else
        {
            $result["success"]=5;
            $result["message"]="Internal Error";
        }
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
    }
    echo json_encode($result,JSON_PRETTY_PRINT);   
?>