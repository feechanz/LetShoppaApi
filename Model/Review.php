<?php
class Review
{
    private $reviewid;
    private $isireview;
    private $statusreview;
    private $tokoid;
    private $toko;
    private $accountid;
    private $account;
    private $tanggalreview;
    private $pointreview;
    private $nama;

    function getReviewid() {
        return $this->reviewid;
    }

    function getIsireview() {
        return $this->isireview;
    }

    function getStatusreview() {
        return $this->statusreview;
    }

    function getTokoid() {
        return $this->tokoid;
    }

    function getToko() {
        return $this->toko;
    }

    function getAccountid() {
        return $this->accountid;
    }

    function getAccount() {
        return $this->account;
    }

    function getTanggalreview() {
        return $this->tanggalreview;
    }

    function getPointreview() {
        return $this->pointreview;
    }
    
    function getNama() {
        return $this->nama;
    }

    function setReviewid($reviewid) {
        $this->reviewid = $reviewid;
    }

    function setIsireview($isireview) {
        $this->isireview = $isireview;
    }

    function setStatusreview($statusreview) {
        $this->statusreview = $statusreview;
    }

    function setTokoid($tokoid) {
        $this->tokoid = $tokoid;
    }

    function setToko($toko) {
        $this->toko = $toko;
    }

    function setAccountid($accountid) {
        $this->accountid = $accountid;
    }

    function setAccount($account) {
        $this->account = $account;
    }

    function setTanggalreview($tanggalreview) {
        $this->tanggalreview = $tanggalreview;
    }

    function setPointreview($pointreview) {
        $this->pointreview = $pointreview;
    }
    
    function setNama($nama) {
        $this->nama = $nama;
    }

    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>