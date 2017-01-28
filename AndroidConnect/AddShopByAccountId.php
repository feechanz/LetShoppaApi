<?php
    header('Content-type:application/json');
    require_once "../Controller/TokoController.php";
    require_once "../Function/function.php";
    
    $namatoko="";
    $deskripsitoko="";
    $lokasitoko="";
    $latitude=0;
    $longitude=0;
    $jenistokoid=0;
    $accountid=0;
    if(isset($_POST['namatoko']) && isset($_POST['deskripsitoko']) 
                && isset($_POST['lokasitoko']) && isset($_POST['latitude']) && isset($_POST['longitude'])
                && isset($_POST['jenistokoid']) && isset($_POST['accountid']))
    {
        $namatoko = $_POST['namatoko'];
        $deskripsitoko = $_POST['deskripsitoko'];
        $lokasitoko = $_POST['lokasitoko'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $jenistokoid = $_POST['jenistokoid'];
        $accountid = $_POST['accountid'];
    }
    $tokocontroller = new TokoController();
    if($namatoko != "")
    {
        $tokoid = $tokocontroller->postTokoDefault($namatoko, $deskripsitoko, $lokasitoko, $latitude, $longitude, $jenistokoid, $accountid);
        if($tokoid != 0)
        {
            $result["success"]=1;
            $result["message"]="Success";
            $result["tokoid"]=$tokoid;
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