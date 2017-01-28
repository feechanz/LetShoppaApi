<?php
class Rekening
{
    private $rekeningid;
    private $nomorrekening;
    private $namabank;
    private $tokoid;
    
    function getRekeningid() {
        return $this->rekeningid;
    }

    function getNomorrekening() {
        return $this->nomorrekening;
    }

    function getNamabank() {
        return $this->namabank;
    }

    function getTokoid() {
        return $this->tokoid;
    }

    function setRekeningid($rekeningid) {
        $this->rekeningid = $rekeningid;
    }

    function setNomorrekening($nomorrekening) {
        $this->nomorrekening = $nomorrekening;
    }

    function setNamabank($namabank) {
        $this->namabank = $namabank;
    }

    function setTokoid($tokoid) {
        $this->tokoid = $tokoid;
    }

    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>