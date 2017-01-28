<?php
    header('Content-type:application/json');
    require_once "../Controller/ReviewController.php";
    require_once "../Function/function.php";
    
    $tokoid = "";
    $accountid = "";
	//$_POST['tokoid']=6;
	//$_POST['accountid']=2;
    if(isset($_POST['tokoid']) && isset($_POST['accountid']))
    {
        $accountid = $_POST['accountid'];
        $tokoid = $_POST['tokoid'];
        $reviewcontroller = new ReviewController();
        $response = $reviewcontroller->getReviewsByTokoIdExAccountId($tokoid, $accountid) ->getArrayCopy();
        echo convertArrayToJSON($response);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
        echo json_encode($result,JSON_PRETTY_PRINT);   
    }
?>
