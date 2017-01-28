<?php
class Produk
{
    private $produkid;
    private $namaproduk;
    private $hargaproduk;
    private $deskripsiproduk;
    private $statusproduk;
    private $tanggalproduk;
    private $gambarproduk;
    private $tokoid;
    private $toko;
    private $kategoriprodukid;
    private $kategoriproduk;
    private $namakategori;

    function getProdukid() {
        return $this->produkid;
    }

    function getNamaproduk() {
        return $this->namaproduk;
    }

    function getHargaproduk() {
        return $this->hargaproduk;
    }

    function getDeskripsiproduk() {
        return $this->deskripsiproduk;
    }

    function getStatusproduk() {
        return $this->statusproduk;
    }

    function getTanggalproduk() {
        return $this->tanggalproduk;
    }

    function getGambarproduk() {
        return $this->gambarproduk;
    }

    function getTokoid() {
        return $this->tokoid;
    }

    function getToko() {
        return $this->toko;
    }

    function getKategoriprodukid() {
        return $this->kategoriprodukid;
    }

    function getKategoriproduk() {
        return $this->kategoriproduk;
    }
    
    function getNamakategori() {
        return $this->namakategori;
    }

    function setProdukid($produkid) {
        $this->produkid = $produkid;
    }

    function setNamaproduk($namaproduk) {
        $this->namaproduk = $namaproduk;
    }

    function setHargaproduk($hargaproduk) {
        $this->hargaproduk = $hargaproduk;
    }

    function setDeskripsiproduk($deskripsiproduk) {
        $this->deskripsiproduk = $deskripsiproduk;
    }

    function setStatusproduk($statusproduk) {
        $this->statusproduk = $statusproduk;
    }

    function setTanggalproduk($tanggalproduk) {
        $this->tanggalproduk = $tanggalproduk;
    }

    function setGambarproduk($gambarproduk) {
        $this->gambarproduk = $gambarproduk;
    }

    function setTokoid($tokoid) {
        $this->tokoid = $tokoid;
    }

    function setToko($toko) {
        $this->toko = $toko;
    }

    function setKategoriprodukid($kategoriprodukid) {
        $this->kategoriprodukid = $kategoriprodukid;
    }

    function setKategoriproduk($kategoriproduk) {
        $this->kategoriproduk = $kategoriproduk;
    }
    
    function setNamakategori($namakategori) {
        $this->namakategori = $namakategori;
    }
        
    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>