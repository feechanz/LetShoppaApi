<?php
    header('Content-type:application/json');
    require_once "../Controller/ProdukController.php";
    require_once "../Function/function.php";
    //$_POST['tokoid']=1;
    if(isset($_POST['tokoid']))
    {
        $tokoid = $_POST['tokoid'];
        $produkcontroller = new ProdukController();
        $response = $produkcontroller->getProduksByTokoid($tokoid)->getArrayCopy();
        echo convertArrayToJSON($response);
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
        echo json_encode($result,JSON_PRETTY_PRINT);   
    }
?>