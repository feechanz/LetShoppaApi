<?php
    header('Content-type:application/json');
    require_once "../Controller/KontaktokoController.php";
    require_once "../Function/function.php";
    
    $kontaktokoid="";
    if(isset($_POST['kontaktokoid']))
    {
        $kontaktokoid = $_POST['kontaktokoid'];
        $kontaktokocontroller = new KontaktokoController();
        if($kontaktokocontroller->deleteKontaktoko($kontaktokoid))
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