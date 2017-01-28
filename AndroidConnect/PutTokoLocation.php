<?php
     header('Content-type:application/json');
    require_once "../Controller/TokoController.php";
    require_once "../Function/function.php";
       
    $tokoid="";
    $lokasitoko = "";
    $latitude = "";
    $longitude = "";
    
    if(isset($_POST['tokoid']) && isset($_POST['lokasitoko']) && isset($_POST['latitude']) && isset($_POST['longitude']))
    {
        $tokoid = $_POST['tokoid'];
        $lokasitoko = $_POST['lokasitoko'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        
        $tokocontroller = new TokoController();
        if($tokocontroller->putTokoLocation($tokoid, $lokasitoko, $latitude, $longitude))
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