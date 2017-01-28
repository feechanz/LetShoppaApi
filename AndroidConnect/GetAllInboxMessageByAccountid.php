<?php
    header('Content-type:application/json');
    require_once "../Controller/PesanController.php";
    require_once "../Function/function.php";
    
    if(isset($_POST['accountid']))
    {
        $accountid = $_POST['accountid'];
        $pesancontroller = new PesanController();
        $response = $pesancontroller->getInboxPesan($accountid) ->getArrayCopy();
        echo convertArrayToJSON($response);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
        echo json_encode($result,JSON_PRETTY_PRINT);   
    }
?>