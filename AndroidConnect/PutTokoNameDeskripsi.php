<?php
     header('Content-type:application/json');
    require_once "../Controller/TokoController.php";
    require_once "../Function/function.php";
       
    $tokoid="";
    $namatoko = "";
    $deskripsitoko = "";
    
    if(isset($_POST['tokoid']) && isset($_POST['namatoko']) && isset($_POST['deskripsitoko']))
    {
        $tokoid = $_POST['tokoid'];
        $namatoko = $_POST['namatoko'];
        $deskripsitoko = $_POST['deskripsitoko'];
        
        $tokocontroller = new TokoController();
        if($tokocontroller->putTokoNameDeskripsi($tokoid, $namatoko, $deskripsitoko))
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