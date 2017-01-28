<?php
     header('Content-type:application/json');
    require_once "../Controller/ProdukController.php";
    require_once "../Function/function.php";
       
    $produkid="";
    $kategoriprodukid = "";
   
    if(isset($_POST['produkid']) && isset($_POST['kategoriprodukid']))
    {
        $produkid = $_POST['produkid'];
        $kategoriprodukid = $_POST['kategoriprodukid'];
        
        $produkcontroller = new ProdukController();
        if($produkcontroller->putProdukKategori($produkid, $kategoriprodukid))
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