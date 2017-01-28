<?php
    header('Content-type:application/json');
    require_once "../Controller/PembayaranController.php";
    require_once "../Function/function.php";
    
    if(isset($_POST['orderid']))
    {
        $orderid = $_POST['orderid'];
        $pembayarancontroller = new PembayaranController();
        $response = $pembayarancontroller -> getPembayaransByOrderId($orderid) ->getArrayCopy();
        echo convertArrayToJSON($response);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
        echo json_encode($result,JSON_PRETTY_PRINT);   
    }
?>