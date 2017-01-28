<?php
    header('Content-type:application/json');
    require_once "../Controller/PostController.php";
    require_once "../Function/function.php";
    
    $postid="";
    $tulisan="";
    if(isset($_POST['postid']) && isset($_POST['tulisan']))
    {
        $postid = $_POST['postid'];
        $tulisan = $_POST['tulisan'];
        $postcontroller = new PostController();
        if($postcontroller->putPost($postid,$tulisan))
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