<?php
if(isset($_POST['email']) && isset($_POST['begindate']) && isset($_POST['enddate']) && isset($_POST['namatoko']) && isset($_POST['tokoid']))
{
    $namatoko = $_POST['namatoko'];
    $email = $_POST['email'];
    
    $tokoid = $_POST['tokoid'];
    $begindate = $_POST['begindate'];
    $enddate = $_POST['enddate'];
require 'pdfcrowd.php';

// create an API client instance
$client = new Pdfcrowd("feechan", "b5b69f1ae3ba902a429ef59c7037cd9a");

// convert a web page and store the generated PDF into a variable
$pdf = $client->convertURI('http://letshoppa.itmaranatha.org/Downloads/ShopProductGeneratePDF.php?begindate='.$begindate.'&enddate='.$enddate.'&tokoid='.$tokoid);

$to = $email;
$subject = $namatoko." Product's Report From ".$begindate. " To ".$enddate;

$att = $pdf ;
$att = base64_encode( $att );
$att = chunk_split( $att );

$BOUNDARY="anystring";

$headers =<<<END
From: Report Name <letshoppa@lecturer.itmaranatha.org>
Content-Type: multipart/mixed; boundary=$BOUNDARY
END;

$body =<<<END
--$BOUNDARY
Content-Type: text/plain

See attached file!

--$BOUNDARY
Content-Type: application/pdf
Content-Transfer-Encoding: base64
Content-Disposition: attachment; filename="Report.pdf"

$att
--$BOUNDARY--
END;

mail( $to, $subject, $body, $headers );
    $result["success"]=1;
    $result["message"]="Success";
}
else
{
    $result["success"]=4;
    $result["message"]="Bad Request";  
}
echo json_encode($result,JSON_PRETTY_PRINT);

?>