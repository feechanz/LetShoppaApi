<?php
class Kategoriproduk
{
    private $kategoriprodukid;
    private $namakategori;
    private $jenistokoid;
    private $jenistoko;
        
    function getKategoriprodukid() {
        return $this->kategoriprodukid;
    }

    function getNamakategori() {
        return $this->namakategori;
    }
    
    function getJenistokoid() {
        return $this->jenistokoid;
    }

    function getJenistoko() {
        return $this->jenistoko;
    }
    function setKategoriprodukid($kategoriprodukid) {
        $this->kategoriprodukid = $kategoriprodukid;
    }

    function setNamakategori($namakategori) {
        $this->namakategori = $namakategori;
    }
    
    function setJenistokoid($jenistokoid) {
        $this->jenistokoid = $jenistokoid;
    }

    function setJenistoko($jenistoko) {
        $this->jenistoko = $jenistoko;
    }
    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>
