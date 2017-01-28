<?php
    header('Content-type:application/json');
    require_once "../Controller/KontakController.php";
    require_once "../Function/function.php";
    //$_POST['accountid']=1;
    if(isset($_POST['accountid']))
    {
        $accountid = $_POST['accountid'];
        $kontakcontroller = new KontakController();
        $response = $kontakcontroller->getKontaksByAccountid($accountid)->getArrayCopy();
        echo convertArrayToJSON($response);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
        echo json_encode($result,JSON_PRETTY_PRINT);   
    }
?>