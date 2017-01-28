<?php
$_POST['nama']="Chandra";
$_POST['email']="chen.fa25@gmail.com";
$_POST['subject']="precobaan";
$_POST['messages']="This is your first report";

$nama = $_POST['nama'];
$to = $_POST['email'];
$subject = $_POST['subject'];
$messages = $_POST['messages'];
    
$headers .= 'From: <letshoppa@lecturer.itmaranatha.org>' . $nama; //bagian ini diganti sesuai dengan email dari pengirim
@mail($to, $subject, $messages, $headers);
if(@mail) 
{
    echo "pengiriman berhasil";
}
else 
{
    echo "pengiriman gagal";
}
?>