<?php
    header('Content-type:application/json');
    require_once "../Controller/PengirimanController.php";
    require_once "../Function/function.php";
    if(isset($_POST['orderid']) )
    {
        $orderid = $_POST['orderid'];
        $pengirimancontroller = new PengirimanController();
        $response = $pengirimancontroller->getPengirimanByOrderid($orderid);
        $result = json_decode(convertObjectToJSON($response),true);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
    }
    echo json_encode($result,JSON_PRETTY_PRINT);   
?>