<?php
class Post
{
    private $postid;
    private $tanggalpost;
    private $tulisan;
    private $accountid;
    private $account;
    private $nama;
    private $linkgambaraccount;
    private $statuspost;
        
    function getPostid() {
        return $this->postid;
    }

    function getTanggalpost() {
        return $this->tanggalpost;
    }

    function getTulisan() {
        return $this->tulisan;
    }

    function getAccountid() {
        return $this->accountid;
    }

    function getAccount() {
        return $this->account;
    }

    function getNama() {
        return $this->nama;
    }

    function getLinkgambaraccount() {
        return $this->linkgambaraccount;
    }
    
    function getStatuspost() {
        return $this->statuspost;
    }

    function setPostid($postid) {
        $this->postid = $postid;
    }

    function setTanggalpost($tanggalpost) {
        $this->tanggalpost = $tanggalpost;
    }

    function setTulisan($tulisan) {
        $this->tulisan = $tulisan;
    }

    function setAccountid($accountid) {
        $this->accountid = $accountid;
    }

    function setAccount($account) {
        $this->account = $account;
    }

    function setNama($nama) {
        $this->nama = $nama;
    }

    function setLinkgambaraccount($linkgambaraccount) {
        $this->linkgambaraccount = $linkgambaraccount;
    }

    function setStatuspost($statuspost) {
        $this->statuspost = $statuspost;
    }
    
    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>