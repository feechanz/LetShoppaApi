<?php
class Account
{
    private $accountid;
    private $email;
    private $password;
    private $nama;
    private $gender;
    private $birthdate;
    private $linkgambaraccount;
    private $premiumaccount;
    private $levelaccount;
    private $statusaccount;
    
    function getAccountid() {
        return $this->accountid;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getNama() {
        return $this->nama;
    }

    function getGender() {
        return $this->gender;
    }

    function getBirthdate() {
        return $this->birthdate;
    }

    function getLinkgambaraccount() {
        return $this->linkgambaraccount;
    }

    function getPremiumaccount() {
        return $this->premiumaccount;
    }

    function getLevelaccount() {
        return $this->levelaccount;
    }

    function getStatusaccount() {
        return $this->statusaccount;
    }

    function setAccountid($accountid) {
        $this->accountid = $accountid;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setNama($nama) {
        $this->nama = $nama;
    }

    function setGender($gender) {
        $this->gender = $gender;
    }

    function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
    }

    function setLinkgambaraccount($linkgambaraccount) {
        $this->linkgambaraccount = $linkgambaraccount;
    }

    function setPremiumaccount($premiumaccount) {
        $this->premiumaccount = $premiumaccount;
    }

    function setLevelaccount($levelaccount) {
        $this->levelaccount = $levelaccount;
    }

    function setStatusaccount($statusaccount) {
        $this->statusaccount = $statusaccount;
    }

    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>
