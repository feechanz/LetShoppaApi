<?php
class Pesan
{
    private $pesanid;
    private $isipesan;
    private $tanggalpesan;
    private $statuspesan;
    private $pengirimaccountid;
    private $pengirimaccount;
    private $penerimaaccountid;
    private $penerimaaccount;
    
    private $namapengirim;
    private $namapenerima;
    
    function getPesanid() {
        return $this->pesanid;
    }

    function getIsipesan() {
        return $this->isipesan;
    }

    function getTanggalpesan() {
        return $this->tanggalpesan;
    }

    function getStatuspesan() {
        return $this->statuspesan;
    }

    function getPengirimaccountid() {
        return $this->pengirimaccountid;
    }

    function getPengirimaccount() {
        return $this->pengirimaccount;
    }

    function getPenerimaccountid() {
        return $this->penerimaaccountid;
    }

    function getPenerimaccount() {
        return $this->penerimaaccount;
    }

    function getNamapengirim() {
        return $this->namapengirim;
    }

    function getNamapenerima() {
        return $this->namapenerima;
    }

    function setPesanid($pesanid) {
        $this->pesanid = $pesanid;
    }

    function setIsipesan($isipesan) {
        $this->isipesan = $isipesan;
    }

    function setTanggalpesan($tanggalpesan) {
        $this->tanggalpesan = $tanggalpesan;
    }

    function setStatuspesan($statuspesan) {
        $this->statuspesan = $statuspesan;
    }

    function setPengirimaccountid($pengirimaccountid) {
        $this->pengirimaccountid = $pengirimaccountid;
    }

    function setPengirimaccount($pengirimaccount) {
        $this->pengirimaccount = $pengirimaccount;
    }

    function setPenerimaccountid($penerimaccountid) {
        $this->penerimaaccountid = $penerimaccountid;
    }

    function setPenerimaccount($penerimaccount) {
        $this->penerimaaccount = $penerimaccount;
    }

    function setNamapengirim($namapengirim) {
        $this->namapengirim = $namapengirim;
    }

    function setNamapenerima($namapenerima) {
        $this->namapenerima = $namapenerima;
    }

    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>