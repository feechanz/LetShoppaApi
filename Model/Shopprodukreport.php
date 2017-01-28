<?php
class Shopprodukreport
{
    private $namaproduk;
    private $jumlahorder;
    
    function getNamaproduk() {
        return $this->namaproduk;
    }

    function getJumlahorder() {
        return $this->jumlahorder;
    }

    function setNamaproduk($namaproduk) {
        $this->namaproduk = $namaproduk;
    }

    function setJumlahorder($jumlahorder) {
        $this->jumlahorder = $jumlahorder;
    }
    
    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>

