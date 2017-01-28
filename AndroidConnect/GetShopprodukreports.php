<?php
    header('Content-type:application/json');
    require_once "../Controller/ShopprodukreportController.php";
    require_once "../Function/function.php";
    $shopprodukreportcontroller = new ShopprodukreportController();
    
    //$_POST['tokoid']=1;
    //$_POST['begindate']='2016-1-1';
    //$_POST['enddate']='2016-12-12';
    $tokoid="";
    $begindate="";
    $enddate="";
    if(isset($_POST['tokoid']) && isset($_POST['begindate']) && isset($_POST['enddate']))
    {
        $tokoid = $_POST['tokoid'];
		$begindate = $_POST['begindate'];
		$enddate = $_POST['enddate'];
        $response = $shopprodukreportcontroller->getShopprodukreports($tokoid, $begindate, $enddate) ->getArrayCopy();
        echo convertArrayToJSON($response);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
        echo json_encode($result,JSON_PRETTY_PRINT);   
    }

?>