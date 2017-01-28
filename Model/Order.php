<?php
class Order
{
    private $orderid;
    private $tanggalorder;
    private $statusorder;
    private $accountid;
    private $account;
    private $namaproduk;
    private $deskripsiproduk;
    private $hargaproduk;
    private $jumlahproduk;
    private $produkid;
    private $produk;
    private $gambarproduk;
    private $namatoko;
    private $namapembeli;
    private $tokoid;
    
    function getOrderid() {
        return $this->orderid;
    }

    function getTanggalorder() {
        return $this->tanggalorder;
    }

    function getStatusorder() {
        return $this->statusorder;
    }

    function getAccountid() {
        return $this->accountid;
    }

    function getAccount() {
        return $this->account;
    }

    function getNamaproduk() {
        return $this->namaproduk;
    }

    function getDeskripsiproduk() {
        return $this->deskripsiproduk;
    }

    function getHargaproduk() {
        return $this->hargaproduk;
    }

    function getJumlahproduk() {
        return $this->jumlahproduk;
    }

    function getProdukid() {
        return $this->produkid;
    }

    function getProduk() {
        return $this->produk;
    }
    
    function getGambarproduk() {
        return $this->gambarproduk;
    }
    
    function getNamatoko() {
        return $this->namatoko;
    }

    function getNamapembeli() {
        return $this->namapembeli;
    }
    
    function getTokoid() {
        return $this->tokoid;
    }
    
    function setOrderid($orderid) {
        $this->orderid = $orderid;
    }

    function setTanggalorder($tanggalorder) {
        $this->tanggalorder = $tanggalorder;
    }

    function setStatusorder($statusorder) {
        $this->statusorder = $statusorder;
    }

    function setAccountid($accountid) {
        $this->accountid = $accountid;
    }

    function setAccount($account) {
        $this->account = $account;
    }

    function setNamaproduk($namaproduk) {
        $this->namaproduk = $namaproduk;
    }

    function setDeskripsiproduk($deskripsiproduk) {
        $this->deskripsiproduk = $deskripsiproduk;
    }

    function setHargaproduk($hargaproduk) {
        $this->hargaproduk = $hargaproduk;
    }

    function setJumlahproduk($jumlahproduk) {
        $this->jumlahproduk = $jumlahproduk;
    }

    function setProdukid($produkid) {
        $this->produkid = $produkid;
    }

    function setProduk($produk) {
        $this->produk = $produk;
    }
    
    function setGambarproduk($gambarproduk) {
        $this->gambarproduk = $gambarproduk;
    }
    
    function setNamatoko($namatoko) {
        $this->namatoko = $namatoko;
    }

    function setNamapembeli($namapembeli) {
        $this->namapembeli = $namapembeli;
    }
    
    function setTokoid($tokoid) {
        $this->tokoid = $tokoid;
    }

    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>