<?php
    header('Content-type:application/json');
    require_once "../Controller/ReportController.php";
    require_once "../Function/function.php";
    $reportcontroller = new ReportController();
    $begindate="";
    $enddate="";
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