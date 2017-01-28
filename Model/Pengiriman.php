<?php
class Pengiriman
{
    private $pengirimanid;
    private $tanggalpengiriman;
    private $keterangan;
    private $jasaekspedisi;
    private $noresi;
    private $biayakirim;
    private $orderid;
    private $order;
    
    function getPengirimanid() {
        return $this->pengirimanid;
    }

    function getTanggalpengiriman() {
        return $this->tanggalpengiriman;
    }

    function getKeterangan() {
        return $this->keterangan;
    }

    function getJasaekspedisi() {
        return $this->jasaekspedisi;
    }

    function getNoresi() {
        return $this->noresi;
    }

    function getBiayakirim() {
        return $this->biayakirim;
    }

    function getOrderid() {
        return $this->orderid;
    }

    function getOrder() {
        return $this->order;
    }

    function setPengirimanid($pengirimanid) {
        $this->pengirimanid = $pengirimanid;
    }

    function setTanggalpengiriman($tanggalpengiriman) {
        $this->tanggalpengiriman = $tanggalpengiriman;
    }

    function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
    }

    function setJasaekspedisi($jasaekspedisi) {
        $this->jasaekspedisi = $jasaekspedisi;
    }

    function setNoresi($noresi) {
        $this->noresi = $noresi;
    }

    function setBiayakirim($biayakirim) {
        $this->biayakirim = $biayakirim;
    }

    function setOrderid($orderid) {
        $this->orderid = $orderid;
    }

    function setOrder($order) {
        $this->order = $order;
    }  

    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>