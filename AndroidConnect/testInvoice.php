<?php
require '../Downloads/pdfcrowd.php';
require_once "../Controller/OrderController.php";
    require_once "../Controller/AccountController.php";
    require_once "../Controller/ProdukController.php";
    require_once "../Controller/TokoController.php";
    require_once "../Function/function.php";
$orderid="20";
$client = new Pdfcrowd("feechan", "b5b69f1ae3ba902a429ef59c7037cd9a");
$ordercontroller = new OrderController();
$accountcontroller = new AccountController();
$produkcontroller = new ProdukController();
$tokocontroller = new TokoController();
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
?>