<?php
class Kontaktoko
{
    private $kontaktokoid;
    private $jeniskontak;
    private $isikontak;
    private $tokoid;
    private $toko;
    
    function getKontaktokoid() {
        return $this->kontaktokoid;
    }

    function getJeniskontak() {
        return $this->jeniskontak;
    }

    function getIsikontak() {
        return $this->isikontak;
    }

    function getTokoid() {
        return $this->tokoid;
    }

    function getToko() {
        return $this->toko;
    }

    function setKontaktokoid($kontaktokoid) {
        $this->kontaktokoid = $kontaktokoid;
    }

    function setJeniskontak($jeniskontak) {
        $this->jeniskontak = $jeniskontak;
    }

    function setIsikontak($isikontak) {
        $this->isikontak = $isikontak;
    }

    function setTokoid($tokoid) {
        $this->tokoid = $tokoid;
    }

    function setToko($toko) {
        $this->toko = $toko;
    }
    
    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>