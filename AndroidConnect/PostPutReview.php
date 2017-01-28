<?php
    header('Content-type:application/json');
    require_once "../Controller/ReviewController.php";
    require_once "../Function/function.php";
    
    $acccountid="";
    $tokoid="";
    $isireview="";
    $pointreview="";
    
    if(isset($_POST['accountid']) && isset($_POST['tokoid']) && isset($_POST['isireview']) && isset($_POST['pointreview']))
    {
        $accountid = $_POST['accountid'];
        $tokoid = $_POST['tokoid'];
        $isireview = $_POST['isireview'];
        $pointreview = $_POST['pointreview'];
        
        $reviewcontroller = new ReviewController();
        $review = $reviewcontroller ->getReviewByTokoIdAccountId($tokoid, $accountid);
        if(!isset($review) || $review == null)
        {
            if($reviewcontroller ->postReview($accountid, $tokoid, $isireview, $pointreview))
            {
                $result["success"]=1;
                $result["message"]="Success";
            }
            else
            {
                $result["success"]=3;
                $result["message"]="Server Error (Post)";   
            }
        }
        else 
        {
            if($reviewcontroller ->putReview($accountid, $tokoid, $isireview, $pointreview))
            {
                $result["success"]=1;
                $result["message"]="Success";
            }
            else
            {
                $result["success"]=3;
                $result["message"]="Server Error (Put)";   
            }
        }
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";  
    }
    echo json_encode($result,JSON_PRETTY_PRINT);
?>