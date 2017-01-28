<?php
    header('Content-type:application/json');
    require_once "../Controller/ReviewController.php";
    require_once "../Function/function.php";
    
    $tokoid = "";
    $accountid = "";
    if(isset($_POST['tokoid']) && isset($_POST['accountid']))
    {
        $accountid = $_POST['accountid'];
        $tokoid = $_POST['tokoid'];
        $reviewcontroller = new ReviewController();
        $response = $reviewcontroller->getReviewByTokoIdAccountId($tokoid, $accountid);
        $result = json_decode(convertObjectToJSON($response),true);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
           
    }
    echo json_encode($result,JSON_PRETTY_PRINT);   
?>