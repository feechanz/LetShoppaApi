<?php
    header('Content-type:application/json');
    require_once "../Controller/TokoController.php";
    require_once "../Function/function.php";
    //$_POST['jenistokoid']=4;
    //$_POST['keyword']="";
    //$_POST['latitude']=-6.9403533;
    //$_POST['longitude']=107.60803;
    //$_POST['jarak']=15;
    if(isset($_POST['jenistokoid']) && isset($_POST['keyword']) && isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['jarak']))
    {
        
        $jenistokoid = $_POST['jenistokoid'];
        $keyword = $_POST['keyword'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $km = $_POST['jarak'];
        $tokocontroller = new TokoController();
        $response = $tokocontroller->getTokosByJenistokoidAndJarak($jenistokoid, $keyword, $latitude, $longitude, $km) ->getArrayCopy();
        echo convertArrayToJSON($response);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
        echo json_encode($result,JSON_PRETTY_PRINT);   
    }
?>