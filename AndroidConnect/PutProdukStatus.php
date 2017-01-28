<?php
     header('Content-type:application/json');
    require_once "../Controller/ProdukController.php";
    require_once "../Function/function.php";
       
    $produkid="";
    $statusproduk = "";
   
    if(isset($_POST['produkid']) && isset($_POST['statusproduk']))
    {
        $produkid = $_POST['produkid'];
        $statusproduk = $_POST['statusproduk'];
        
        $produkcontroller = new ProdukController();
        if($produkcontroller->putProdukStatus($produkid, $statusproduk))
        {
            $result["success"]=1;
            $result["message"]="Success";
        }
        else
        {
            $result["success"]=5;
            $result["message"]="Internal Error";
        }
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";
    }
    echo json_encode($result,JSON_PRETTY_PRINT);   
?>