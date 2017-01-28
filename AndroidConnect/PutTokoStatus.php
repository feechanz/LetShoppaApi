<?php
    header('Content-type:application/json');
    require_once "../Controller/TokoController.php";
    require_once "../Function/function.php";
       
    $tokoid="";
    $statustoko = "";
    
    if(isset($_POST['tokoid']) && isset($_POST['statustoko']))
    {
        $tokoid = $_POST['tokoid'];
        $statustoko = $_POST['statustoko'];
       
        $tokocontroller = new TokoController();
        if($tokocontroller->putTokoStatus($tokoid, $statustoko))
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