<?php
    header('Content-type:application/json');
    require_once "../Controller/PengirimanController.php";
    require_once '../Controller/OrderController.php';
    require_once '../Controller/AccountController.php';
    require_once "../Function/function.php";
    
    $keterangan = "";
    $jasaekspedisi = "";
    $noresi = "";
    $biayakirim = "";
    $orderid = "";
    
    if(isset($_POST['keterangan']) && isset($_POST['jasaekspedisi']) && isset($_POST['noresi']) && isset($_POST['biayakirim']) && isset($_POST['orderid']))
    {
        $keterangan = $_POST['keterangan'];
        $jasaekspedisi = $_POST['jasaekspedisi'];
        $noresi = $_POST['noresi'];
        $biayakirim = $_POST['biayakirim'];
        $orderid = $_POST['orderid'];
        $pengirimancontroller = new PengirimanController();
        $pengiriman = $pengirimancontroller->getPengirimanByOrderid($orderid);
        if(!isset($pengiriman) || $pengiriman == null)
        {
            if($pengirimancontroller->postPengiriman($keterangan, $jasaekspedisi, $noresi, $biayakirim, $orderid))
            {
                $result["success"]=1;
                $result["message"]="Success";
                
                $headers= "";
                $ordercontroller = new OrderController();
                $accountcontroller = new AccountController();
                $order = $ordercontroller->getOrderByOrderid($orderid);
                $account = $accountcontroller->getAccountByAccountId($order->getAccountid());
                
                //
                $nama = "Let Shoppa";
                $to = $account->getEmail();
                $subject = "Shipping Order No. #".$orderid;
                $messages = "Your order in shipping from Product's Owner\n".
                        "Now you can wait your order to come :)".
                        "\n\nOrder : ".$account->getNama().
                        "\n\n"."Produk Name : ".$order->getNamaproduk().
                        "\n\n"."Price : Rp. ".number_format($order->getHargaproduk() ,2,',','.').
                        "\n\n"."Qty : ".$order->getJumlahproduk().
                        "\n\nTotal : Rp. ".number_format( $order->getHargaproduk()*$order->getJumlahproduk(),2,',','.').
                        "\n\nShipping - \n".
                        "Expedition Service : ".$jasaekspedisi.
                        "\nReceipt Number :".$noresi.
                        "\nInformation :".$keterangan;
                $headers = 'From: <letshoppa@lecturer.itmaranatha.org>' . $nama; //bagian ini diganti sesuai dengan email dari pengirim
                @mail($to, $subject, $messages, $headers);
            }
            else
            {
                $result["success"]=3;
                $result["message"]="Server Error";
            }
        }
        else
        {
            if($pengirimancontroller->putPengiriman($keterangan, $jasaekspedisi, $noresi, $biayakirim, $orderid))
            {
                $headers= "";
                $ordercontroller = new OrderController();
                $accountcontroller = new AccountController();
                $order = $ordercontroller->getOrderByOrderid($orderid);
                $account = $accountcontroller->getAccountByAccountId($order->getAccountid());
                
                //
                $nama = "Let Shoppa";
                $to = $account->getEmail();
                $subject = "Shipping Order No. #".$orderid;
                $messages = "Your order in shipping from Product's Owner\n".
                        "Now you can wait your order to come :)".
                        "\n\nOrder : ".$account->getNama().
                        "\n\n"."Produk Name : ".$order->getNamaproduk().
                        "\n\n"."Price : Rp. ".number_format($order->getHargaproduk() ,2,',','.').
                        "\n\n"."Qty : ".$order->getJumlahproduk().
                        "\n\nTotal : Rp. ".number_format( $order->getHargaproduk()*$order->getJumlahproduk(),2,',','.').
                        "\n\nShipping - \n".
                        "Expedition Service : ".$jasaekspedisi.
                        "\nReceipt Number :".$noresi.
                        "\nInformation :".$keterangan;
                $headers = 'From: <letshoppa@lecturer.itmaranatha.org>' . $nama; //bagian ini diganti sesuai dengan email dari pengirim
                @mail($to, $subject, $messages, $headers);
                $result["success"]=1;
                $result["message"]="Success";
            }
            else
            {
                $result["success"]=3;
                $result["message"]="Server Error";
            }
        }
    }
    else
    {
        $result["success"]=4;
        $result["message"]="Bad Request";  
    }
    echo json_encode($result,JSON_PRETTY_PRINT);
?>