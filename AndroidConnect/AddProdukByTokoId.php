<?php
    header('Content-type:application/json');
    require_once "../Controller/ProdukController.php";
    require_once "../Function/function.php";
    
    $namaproduk = "";
    $hargaproduk = 0;
    $deskripsiproduk = "";
    $tokoid = 1;
    $kategoriprodukid = 1;
    if(isset($_POST['namaproduk']) && isset($_POST['hargaproduk']) && isset($_POST['deskripsiproduk']) && isset($_POST['tokoid']) && isset($_POST['kategoriprodukid']))
    {
        $namaproduk = $_POST['namaproduk'];
        $hargaproduk = $_POST['hargaproduk'];
        $deskripsiproduk = $_POST['deskripsiproduk'];
        $tokoid = $_POST['tokoid'];
        $kategoriprodukid = $_POST['kategoriprodukid'];
    }
    $produkcontroller = new ProdukController();
    if($namaproduk != "")
    {
        if($produkcontroller->postProdukDefault($namaproduk, $hargaproduk, $deskripsiproduk, $tokoid, $kategoriprodukid))
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