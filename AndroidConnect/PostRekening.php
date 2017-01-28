<?php
    header('Content-type:application/json');
    require_once "../Controller/RekeningController.php";
    require_once "../Function/function.php";
    
    $tokoid="";
    $nomorrekening="";
    $namabank="";
    
    if(isset($_POST['tokoid']) && isset($_POST['nomorrekening']) && isset($_POST['namabank']))
    {
        $tokoid = $_POST['tokoid'];
        $nomorrekening = $_POST['nomorrekening'];
        $namabank = $_POST['namabank'];
        $rekeningcontroller = new RekeningController();
        if($rekeningcontroller->postRekening($tokoid, $nomorrekening, $namabank))
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