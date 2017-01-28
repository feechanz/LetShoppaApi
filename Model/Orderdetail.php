<?php
class Orderdetail
{
    private $orderdetailid;
    private $jumlah;
    private $harga;
    
    function getOrderdetailid() {
        return $this->orderdetailid;
    }

    function getJumlah() {
        return $this->jumlah;
    }

    function getHarga() {
        return $this->harga;
    }

    function setOrderdetailid($orderdetailid) {
        $this->orderdetailid = $orderdetailid;
    }

    function setJumlah($jumlah) {
        $this->jumlah = $jumlah;
    }

    function setHarga($harga) {
        $this->harga = $harga;
    }


}
?>