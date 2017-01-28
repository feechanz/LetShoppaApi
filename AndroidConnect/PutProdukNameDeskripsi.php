<?php
     header('Content-type:application/json');
    require_once "../Controller/ProdukController.php";
    require_once "../Function/function.php";
       
    $produkid="";
    $namaproduk = "";
    $deskripsiproduk = "";
    
    if(isset($_POST['produkid']) && isset($_POST['namaproduk']) && isset($_POST['deskripsiproduk']))
    {
        $produkid = $_POST['produkid'];
        $namaproduk = $_POST['namaproduk'];
        $deskripsiproduk = $_POST['deskripsiproduk'];
        
        $produkcontroller = new ProdukController();
        if($produkcontroller->putProdukNameDeskripsi($produkid, $namaproduk, $deskripsiproduk))
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