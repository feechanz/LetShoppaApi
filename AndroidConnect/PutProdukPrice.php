<?php
     header('Content-type:application/json');
    require_once "../Controller/ProdukController.php";
    require_once "../Function/function.php";
       
    $produkid="";
    $hargaproduk = "";
   
    if(isset($_POST['produkid']) && isset($_POST['hargaproduk']))
    {
        $produkid = $_POST['produkid'];
        $hargaproduk = $_POST['hargaproduk'];
        
        $produkcontroller = new ProdukController();
        if($produkcontroller->putProdukPrice($produkid, $hargaproduk))
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