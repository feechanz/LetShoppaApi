<?php
    header('Content-type:application/json');
    require_once "../Controller/KategoriprodukController.php";
    require_once "../Function/function.php";
    
    if(isset($_POST['jenistokoid']))
    {
        $jenistokoid = $_POST['jenistokoid'];
        $kategoriprodukcontroller = new KategoriprodukController();
        $response = $kategoriprodukcontroller->getKategoriproduksByJenisTokoId($jenistokoid)->getArrayCopy();
        echo convertArrayToJSON($response);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
        echo json_encode($result,JSON_PRETTY_PRINT);   
    }
?>