<?php
class Toko
{
    private $namatoko;
    private $tokoid;
    private $deskripsitoko;
    private $lokasitoko;
    private $latitude;
    private $longitude;
    private $gambartoko;
    private $jenistokoid;
    private $jenistoko;
    private $accountid;
    private $account;
    private $statustoko;
    private $namajenis;
    private $jarak;


        
    function getNamatoko() {
        return $this->namatoko;
    }

    function getTokoid() {
        return $this->tokoid;
    }

    function getDeskripsitoko() {
        return $this->deskripsitoko;
    }

    function getLokasitoko() {
        return $this->lokasitoko;
    }

    function getLatitude() {
        return $this->latitude;
    }

    function getLongitude() {
        return $this->longitude;
    }

    function getGambartoko() {
        return $this->gambartoko;
    }

    function getJenistokoid() {
        return $this->jenistokoid;
    }

    function getJenistoko() {
        return $this->jenistoko;
    }

    function getAccountid() {
        return $this->accountid;
    }

    function getAccount() {
        return $this->account;
    }

    function getStatustoko() {
        return $this->statustoko;
    }
    
    function getNamajenis() {
        return $this->namajenis;
    }
    
    function getJarak() {
        return $this->jarak;
    }
    
    function setNamatoko($namatoko) {
        $this->namatoko = $namatoko;
    }

    function setTokoid($tokoid) {
        $this->tokoid = $tokoid;
    }

    function setDeskripsitoko($deskripsitoko) {
        $this->deskripsitoko = $deskripsitoko;
    }

    function setLokasitoko($lokasitoko) {
        $this->lokasitoko = $lokasitoko;
    }

    function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    function setGambartoko($gambartoko) {
        $this->gambartoko = $gambartoko;
    }

    function setJenistokoid($jenistokoid) {
        $this->jenistokoid = $jenistokoid;
    }

    function setJenistoko($jenistoko) {
        $this->jenistoko = $jenistoko;
    }

    function setAccountid($accountid) {
        $this->accountid = $accountid;
    }

    function setAccount($account) {
        $this->account = $account;
    }

    function setStatustoko($statustoko) {
        $this->statustoko = $statustoko;
    }
    
    function setNamajenis($namajenis) {
        $this->namajenis = $namajenis;
    }
    
    function setJarak($jarak) {
        $this->jarak = $jarak;
    }
   
    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>