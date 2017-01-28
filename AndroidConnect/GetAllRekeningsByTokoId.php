<?php
    header('Content-type:application/json');
    require_once "../Controller/RekeningController.php";
    require_once "../Function/function.php";
    //$_POST['accountid']=1;
    if(isset($_POST['tokoid']))
    {
        $tokoid = $_POST['tokoid'];
        $rekeningcontroller = new RekeningController();
        $response = $rekeningcontroller->getRekeningsByTokoid($tokoid) ->getArrayCopy();
        echo convertArrayToJSON($response);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
        echo json_encode($result,JSON_PRETTY_PRINT);   
    }
?>