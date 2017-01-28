<?php
    header('Content-type:application/json');
    require_once "../Controller/OrderController.php";
    require_once "../Controller/AccountController.php";
    require_once "../Controller/ProdukController.php";
    require_once "../Controller/TokoController.php";
    require_once "../Function/function.php";
    
    $orderid="";
    $statusorder = "";
    if(isset($_POST['orderid']) && isset($_POST['statusorder']))
    {
        $orderid = $_POST['orderid'];
        $statusorder = $_POST['statusorder'];
        
        $ordercontroller = new OrderController();
        $accountcontroller = new AccountController();
        $produkcontroller = new ProdukController();
        $tokocontroller = new TokoController();
        
        if($ordercontroller->putOrderStatusOrder($orderid, $statusorder))
        {
            $result["success"]=1;
            $result["message"]="Success";
            
            $order = $ordercontroller->getOrderByOrderid($orderid);
            $produk = $produkcontroller->getProdukByProdukId($order->getProdukid());
            $toko = $tokocontroller->getTokoByTokoId($produk->getTokoid());
            
            if($statusorder==2)
            {
                $headers= "";
                $account = $accountcontroller->getAccountByAccountId($order->getAccountid());
                $penerimaorder = $accountcontroller->getAccountByAccountId($toko->getAccountid());
                //
                $nama = "Let Shoppa";
                $to = $account->getEmail();
                $subject = "New Order No. #".$orderid;
                $messages = "Your order with No. #".$orderid." has been sent to Product's Owner
				\nWait for approval from Product's Owner
				\n"."Order : ".$account->getNama()."
				\n\n".
				"Produk Name : ".$order->getNamaproduk()."\n\n".
				"Price : Rp. ".number_format( $order->getHargaproduk(),2,',','.')."\n\n".
				"Qty : ".$order->getJumlahproduk().
				"\n\nTotal : Rp. ".number_format( $order->getHargaproduk()*$order->getJumlahproduk(),2,',','.');
                $headers = 'From: <letshoppa@lecturer.itmaranatha.org>' . $nama; //bagian ini diganti sesuai dengan email dari pengirim
                @mail($to, $subject, $messages, $headers);
                //
                //
                $headers = "";
                $nama = "Let Shoppa";
                $to = $penerimaorder->getEmail();
                $subject = "New Shop's Order, No. #".$orderid;
                $messages = "Your shop get new order\n"."Order From : ".$account->getNama()."\n\n".
				"Produk Name : ".$order->getNamaproduk()."\n\n".
				"Price : ".number_format($order->getHargaproduk() ,2,',','.')."\n\n".
				"Qty : ".$order->getJumlahproduk().
				"\n\nTotal : ".number_format( $order->getHargaproduk()*$order->getJumlahproduk(),2,',','.');
                $headers = 'From: <letshoppa@lecturer.itmaranatha.org>' . $nama; //bagian ini diganti sesuai dengan email dari pengirim
                @mail($to, $subject, $messages, $headers);
                //
            }
            else if($statusorder==3)
            {
                $headers= "";
                $account = $accountcontroller->getAccountByAccountId($order->getAccountid());
                $penerimaorder = $accountcontroller->getAccountByAccountId($toko->getAccountid());
                //
                $nama = "Let Shoppa";
                $to = $account->getEmail();
                $subject = "Accepted Order No. #".$orderid;
                $messages = "Your order has been accepted by Product's Owner\n".
                        "Now you can add your payment to your order".
                        "\n\nOrder : ".$account->getNama().
                        "\n\n"."Produk Name : ".$order->getNamaproduk().
                        "\n\n"."Price : Rp. ".number_format($order->getHargaproduk() ,2,',','.').
                        "\n\n"."Qty : ".$order->getJumlahproduk().
                        "\n\nTotal : Rp. ".number_format( $order->getHargaproduk()*$order->getJumlahproduk(),2,',','.').
                        "";
                $headers = 'From: <letshoppa@lecturer.itmaranatha.org>' . $nama; //bagian ini diganti sesuai dengan email dari pengirim
                @mail($to, $subject, $messages, $headers);
                //      
            }
            else if($statusorder==0)
            {
                $headers= "";
                $account = $accountcontroller->getAccountByAccountId($order->getAccountid());
                $penerimaorder = $accountcontroller->getAccountByAccountId($toko->getAccountid());
                //
                $nama = "Let Shoppa";
                $to = $account->getEmail();
                $subject = "Cancelled Order No. #".$orderid;;
                $messages = "Your order has been cancelled by Product's Owner\n".
                        "Order : ".$account->getNama()."\n\n".
                        "Produk Name : ".$order->getNamaproduk()."\n\n".
                        "Price : Rp. ".number_format( $order->getHargaproduk(),2,',','.')."\n\n".
                        "Qty : ".$order->getJumlahproduk().
                        "\n\nTotal : Rp. ".number_format( $order->getHargaproduk()*$order->getJumlahproduk(),2,',','.');
                $headers = 'From: <letshoppa@lecturer.itmaranatha.org>' . $nama; //bagian ini diganti sesuai dengan email dari pengirim
                @mail($to, $subject, $messages, $headers);
            }
            else if($statusorder == 4)
            {
//email
require '../Downloads/pdfcrowd.php';
$client = new Pdfcrowd("feechan", "b5b69f1ae3ba902a429ef59c7037cd9a");

// convert a web page and store the generated PDF into a variable
$pdf = $client->convertURI('http://letshoppa.itmaranatha.org/AndroidConnect/InvoicePDF.php?orderid='.$orderid);
$order = $ordercontroller->getOrderByOrderid($orderid);
$account = $accountcontroller->getAccountByAccountId($order->getAccountid());
$email = $account->getEmail();
$message = "\n\nOrder : ".$account->getNama().
"\n\nProduk Name : ".$order->getNamaproduk().
"\n\nPrice : Rp. ".number_format($order->getHargaproduk() ,2,',','.').
"\n\nQty : ".$order->getJumlahproduk().
"\n\nTotal : Rp. ".number_format( $order->getHargaproduk()*$order->getJumlahproduk(),2,',','.');
        
$to = $email;
$subject = "Confirmed Order No. #".$orderid;

$att = $pdf ;
$att = base64_encode( $att );
$att = chunk_split( $att );

$BOUNDARY="anystring";

$headers =<<<END
From: Let Shoppa <letshoppa@lecturer.itmaranatha.org>
Content-Type: multipart/mixed; boundary=$BOUNDARY
END;

$body =<<<END
--$BOUNDARY
Content-Type: text/plain
Invoice
Your order has been confirmed by Product's Owner\n
Now you can wait your order to come :)
$message
--$BOUNDARY
Content-Type: application/pdf
Content-Transfer-Encoding: base64
Content-Disposition: attachment; filename="Invoice #$orderid.pdf"

$att
--$BOUNDARY--
END;
mail( $to, $subject, $body, $headers );

//pdf
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