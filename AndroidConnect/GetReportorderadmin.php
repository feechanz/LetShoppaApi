<?php
    header('Content-type:application/json');
    require_once "../Controller/ReportorderadminController.php";
    require_once "../Function/function.php";
    $reportcontroller = new ReportorderadminController();
    $begindate="";
    $enddate="";
    //$_POST['begindate']='2016-1-1';
    //$_POST['enddate']='2016-12-12';
    if(isset($_POST['begindate']) && isset($_POST['enddate']))
    {
	$begindate = $_POST['begindate'];
	$enddate = $_POST['enddate'];
        $response = $reportcontroller ->getReports($begindate, $enddate)->getArrayCopy();
        echo convertArrayToJSON($response);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
        echo json_encode($result,JSON_PRETTY_PRINT);   
    }
?>
