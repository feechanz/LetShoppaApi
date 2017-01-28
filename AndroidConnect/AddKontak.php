<?php
    header('Content-type:application/json');
    require_once "../Controller/KontakController.php";
    require_once "../Function/function.php";
    
    $accountid="";
    $jeniskontak="";
    $isikontak="";
    if(isset($_POST['accountid']) && isset($_POST['jeniskontak']) && isset($_POST['isikontak']))
    {
        $accountid = $_POST['accountid'];
        $jeniskontak = $_POST['jeniskontak'];
        $isikontak = $_POST['isikontak'];
        $kontakcontroller = new KontakController();
        if($kontakcontroller->postKontak($accountid, $jeniskontak, $isikontak))
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