<?php
$to = "chen.fa25@gmail.com";
$subject = "mail with attachment";

$att = file_get_contents( 'PDFgenerator.php' );
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
Content-Disposition: attachment; filename="your-file.pdf"

$att
--$BOUNDARY--
END;

mail( $to, $subject, $body, $headers );
?>