<?php

class Voucher
{
    private $voucherid;
    private $vouchercode;
    private $day;
    private $voucherdate;
    private $statusvoucher;
    
    function getVoucherid() {
        return $this->voucherid;
    }

    function getVouchercode() {
        return $this->vouchercode;
    }

    function getDay() {
        return $this->day;
    }

    function getVoucherdate() {
        return $this->voucherdate;
    }

    function getStatusvoucher() {
        return $this->statusvoucher;
    }

    function setVoucherid($voucherid) {
        $this->voucherid = $voucherid;
    }

    function setVouchercode($vouchercode) {
        $this->vouchercode = $vouchercode;
    }

    function setDay($day) {
        $this->day = $day;
    }

    function setVoucherdate($voucherdate) {
        $this->voucherdate = $voucherdate;
    }

    function setStatusvoucher($statusvoucher) {
        $this->statusvoucher = $statusvoucher;
    }

    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>