<?php
    header('Content-type:application/json');
    require_once "../Controller/PostController.php";
    require_once "../Function/function.php";
    
    $accountid="";
    $tulisan="";
    if(isset($_POST['accountid']) && isset($_POST['tulisan']))
    {
        $accountid = $_POST['accountid'];
        $tulisan = $_POST['tulisan'];
        $postcontroller = new PostController();
        if($postcontroller->postPost($accountid, $tulisan))
        {
            $result["success"]=1;
            $result["message"]="Success";
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