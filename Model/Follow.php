<?php
class Follow
{
    private $followid;
    private $accountid;
    private $account;
    private $targetaccountid;
    private $targetaccount;
    private $tanggalfollow;
    
    function getFollowid() {
        return $this->followid;
    }

    function getAccountid() {
        return $this->accountid;
    }

    function getAccount() {
        return $this->account;
    }

    function getTargetaccountid() {
        return $this->targetaccountid;
    }

    function getTargetaccount() {
        return $this->targetaccount;
    }

    function getTanggalfollow() {
        return $this->tanggalfollow;
    }

    function setFollowid($followid) {
        $this->followid = $followid;
    }

    function setAccountid($accountid) {
        $this->accountid = $accountid;
    }

    function setAccount($account) {
        $this->account = $account;
    }

    function setTargetaccountid($targetaccountid) {
        $this->targetaccountid = $targetaccountid;
    }

    function setTargetaccount($targetaccount) {
        $this->targetaccount = $targetaccount;
    }

    function setTanggalfollow($tanggalfollow) {
        $this->tanggalfollow = $tanggalfollow;
    }
}
?>