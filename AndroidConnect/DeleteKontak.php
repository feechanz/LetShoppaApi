<?php
    header('Content-type:application/json');
    require_once "../Controller/KontakController.php";
    require_once "../Function/function.php";
    
    $kontakid="";
    if(isset($_POST['kontakid']))
    {
        $kontakid = $_POST['kontakid'];
        $kontakcontroller = new KontakController();
        if($kontakcontroller->deleteKontak($kontakid))
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