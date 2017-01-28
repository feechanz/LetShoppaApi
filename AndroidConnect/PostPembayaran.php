<?php
    header('Content-type:application/json');
    require_once "../Controller/PembayaranController.php";
    require_once '../Controller/OrderController.php';
    require_once '../Controller/TokoController.php';
    require_once '../Controller/AccountController.php';
    require_once "../Function/function.php";
    
    if(isset($_POST['keterangan']) && isset($_POST['totalpembayaran']) && isset($_POST['orderid']))
    {
        $keterangan = $_POST['keterangan'];
        $totalpembayaran = $_POST['totalpembayaran'];
        $orderid = $_POST['orderid'];
        $pembayarancontroller = new PembayaranController();
        $pembayaranid = $pembayarancontroller->postPembayaranDefault($keterangan, $totalpembayaran, $orderid);
        if($pembayaranid != 0)
        {
            $ordercontroller = new OrderController();
            $tokocontroller = new TokoController();


            $order = $ordercontroller->getOrderByOrderid($orderid);
            $toko = $tokocontroller->getTokoByTokoId($order->getTokoid());

            $account = $toko->getAccount();
            $headers= "";

            //
            $nama = "Let Shoppa";
            $to = $account->getEmail();
            $subject = "You get Payment No. #".$orderid;
            $messages = "You get payment from Order with No. #".$orderid."
                            \nPlease check payment
                            \n"."Order : ".$account->getNama()."
                            \n\n".
                            "Information : ".$keterangan."\n\n".
                            "Total Payment : Rp. ".number_format( $totalpembayaran,2,',','.')."\n\n";
            $headers = 'From: <letshoppa@lecturer.itmaranatha.org>' . $nama; //bagian ini diganti sesuai dengan email dari pengirim
            @mail($to, $subject, $messages, $headers);
                
            if (is_uploaded_file($_FILES['buktipembayaran']['tmp_name']))
            {
                $buktipembayaran = $_FILES['buktipembayaran']['tmp_name'];
                $name = $_FILES["buktipembayaran"]["name"];
                $ext = end((explode(".", $name))); 

                $path = "../Images/Payments/".$pembayaranid.".".$ext;
                $newpath = "http://letshoppa.itmaranatha.org/Images/Payments/".$pembayaranid.".".$ext;

                
                

                if($pembayarancontroller->putBuktiPembayaran($pembayaranid, $newpath))                  
                {
                    move_uploaded_file ($_FILES['buktipembayaran'] ['tmp_name'], $path);
                    
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
                $result["success"]=1;
                $result["message"]="Success";
            }
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