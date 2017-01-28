<?php
class Shoporderreport
{
    private $year;
    private $month;
    private $jumlahorder;
    
    function getYear() {
        return $this->year;
    }

    function getMonth() {
        return $this->month;
    }

    function getJumlahorder() {
        return $this->jumlahorder;
    }

    function setYear($year) {
        $this->year = $year;
    }

    function setMonth($month) {
        $this->month = $month;
    }

    function setJumlahorder($jumlahorder) {
        $this->jumlahorder = $jumlahorder;
    }
    
    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }

}
?>
