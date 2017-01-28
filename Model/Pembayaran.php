<?php
class Pembayaran
{
    private $pembayaranid;
    private $tanggalpembayaran;
    private $keterangan;
    private $buktipembayaran;
    private $totalpembayaran;
    private $orderid;
    private $order;
    
    function getPembayaranid() {
        return $this->pembayaranid;
    }

    function getTanggalpembayaran() {
        return $this->tanggalpembayaran;
    }

    function getKeterangan() {
        return $this->keterangan;
    }

    function getBuktipembayaran() {
        return $this->buktipembayaran;
    }

    function getTotalpembayaran() {
        return $this->totalpembayaran;
    }

    function getOrderid() {
        return $this->orderid;
    }

    function getOrder() {
        return $this->order;
    }

    function setPembayaranid($pembayaranid) {
        $this->pembayaranid = $pembayaranid;
    }

    function setTanggalpembayaran($tanggalpembayaran) {
        $this->tanggalpembayaran = $tanggalpembayaran;
    }

    function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
    }

    function setBuktipembayaran($buktipembayaran) {
        $this->buktipembayaran = $buktipembayaran;
    }

    function setTotalpembayaran($totalpembayaran) {
        $this->totalpembayaran = $totalpembayaran;
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