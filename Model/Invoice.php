<?php
class Invoice
{
    private $invoiceid;
    private $tanggalinvoice;
    private $totalinvoice;
    private $orderid;
    
    function getInvoiceid() {
        return $this->invoiceid;
    }

    function getTanggalinvoice() {
        return $this->tanggalinvoice;
    }

    function getTotalinvoice() {
        return $this->totalinvoice;
    }

    function getOrderid() {
        return $this->orderid;
    }

    function setInvoiceid($invoiceid) {
        $this->invoiceid = $invoiceid;
    }

    function setTanggalinvoice($tanggalinvoice) {
        $this->tanggalinvoice = $tanggalinvoice;
    }

    function setTotalinvoice($totalinvoice) {
        $this->totalinvoice = $totalinvoice;
    }

    function setOrderid($orderid) {
        $this->orderid = $orderid;
    }

    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>

