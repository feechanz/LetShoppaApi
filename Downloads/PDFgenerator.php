<?php
//$_POST['email']="chen.fa25@gmail.com";
//$_POST['begindate']="2016-7-7";
//$_POST['enddate']="2017-1-1";
if(isset($_POST['email']) && isset($_POST['begindate']) && isset($_POST['enddate']))
{
    $email = $_POST['email'];
    $begindate = $_POST['begindate'];
    $enddate = $_POST['enddate'];
require 'pdfcrowd.php';

// create an API client instance
$client = new Pdfcrowd("feechan", "b5b69f1ae3ba902a429ef59c7037cd9a");

// convert a web page and store the generated PDF into a variable
$pdf = $client->convertURI('http://letshoppa.itmaranatha.org/Downloads/GeneratePDF.php?begindate='.$begindate.'&enddate='.$enddate);

// set HTTP response headers
//header("Content-Type: application/pdf");
//header("Cache-Control: max-age=0");
//header("Accept-Ranges: none");
//header("Content-Disposition: attachment; filename=\"test.pdf\"");

// send the generated PDF 
//echo $pdf;
/*$tempPDF = tempnam( '/tmp', 'generated-invoice' );
$url = 'http://letshoppa.itmaranatha.org/Downloads/GeneratePDF.php?id=123';

exec( "htmltopdf  $url  $tempPDF" );

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename=generated.pdf');

echo file_get_contents( $tempPDF );
unlink( $tempPDF );*/


$to = $email;
$subject = "Your Report From ".$begindate. " To ".$enddate;

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