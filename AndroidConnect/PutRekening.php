<?php
    header('Content-type:application/json');
    require_once "../Controller/RekeningController.php";
    require_once "../Function/function.php";
    
    $rekeningid="";
    $nomorrekening="";
    $namabank="";
    if(isset($_POST['rekeningid']) && isset($_POST['nomorrekening']) && isset($_POST['namabank']))
    {
        $rekeningid=$_POST["rekeningid"];
        $nomorrekening=$_POST["nomorrekening"];
        $namabank=$_POST["namabank"];
        $rekeningcontroller = new RekeningController();
        if($rekeningcontroller->putRekening($rekeningid, $nomorrekening, $namabank))
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