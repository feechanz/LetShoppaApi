<?php
    header('Content-type:application/json');
    require_once "../Controller/ShoporderreportController.php";
    require_once "../Function/function.php";
    $shoporderreportcontroller = new ShoporderreportController();
    $tokoid="";
    //$_POST['year']=2016;
    //$_POST['tokoid']=6;
    if(isset($_POST['tokoid']) && isset($_POST['year']))
    {
        $tokoid = $_POST['tokoid'];
        $year = $_POST['year'];
        $response = $shoporderreportcontroller->getShoporderreports($tokoid,$year) ->getArrayCopy();
        echo convertArrayToJSON($response);
        //print_r($response);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
        echo json_encode($result,JSON_PRETTY_PRINT);   
    }

?>