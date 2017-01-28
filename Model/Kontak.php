<?php
class Kontak
{
    private $kontakid;
    private $jeniskontak;
    private $isikontak;
    private $accountid;
    private $account;
    
    function getKontakid() {
        return $this->kontakid;
    }

    function getJeniskontak() {
        return $this->jeniskontak;
    }

    function getIsikontak() {
        return $this->isikontak;
    }

    function getAccountid() {
        return $this->accountid;
    }

    function getAccount() {
        return $this->account;
    }

    function setKontakid($kontakid) {
        $this->kontakid = $kontakid;
    }

    function setJeniskontak($jeniskontak) {
        $this->jeniskontak = $jeniskontak;
    }

    function setIsikontak($isikontak) {
        $this->isikontak = $isikontak;
    }

    function setAccountid($accountid) {
        $this->accountid = $accountid;
    }

    function setAccount($account) {
        $this->account = $account;
    }

    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>