<?php
    header('Content-type:application/json');
    require_once "../Controller/RekeningController.php";
    require_once "../Function/function.php";
    
    $rekeningid="";
    if(isset($_POST['rekeningid']))
    {
        $rekeningid = $_POST['rekeningid'];
        $rekeningcontroller = new RekeningController();
        if($rekeningcontroller->deleteRekening($rekeningid))
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