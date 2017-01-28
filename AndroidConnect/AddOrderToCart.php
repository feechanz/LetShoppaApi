<?php
    header('Content-type:application/json');
    require_once "../Controller/OrderController.php";
    require_once "../Function/function.php";
    
    $accountid="";
    $namaproduk="";
    $deskripsiproduk="";
    $hargaproduk="";
    $jumlahproduk="";
    $produkid="";
    $gambarproduk="";
    if(isset($_POST['accountid']) && isset($_POST['namaproduk']) && isset($_POST['deskripsiproduk']) && isset($_POST['hargaproduk']) && isset($_POST['jumlahproduk']) && isset($_POST['produkid']) && isset($_POST['gambarproduk']))
    {
        $accountid = $_POST['accountid'];
        $namaproduk = $_POST['namaproduk'];
        $deskripsiproduk = $_POST['deskripsiproduk'];
        $hargaproduk = $_POST['hargaproduk'];
        $jumlahproduk = $_POST['jumlahproduk'];
        $produkid = $_POST['produkid'];
        $gambarproduk = $_POST['gambarproduk'];
        $ordercontroller = new OrderController();
        if($ordercontroller->postOrder($accountid, $namaproduk, $deskripsiproduk, $hargaproduk, $jumlahproduk, $produkid, $gambarproduk))
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