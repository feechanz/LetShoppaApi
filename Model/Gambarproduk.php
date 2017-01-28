<?php
class Gambarproduk
{
    private $gambarprodukid;
    private $linkgambarproduk;
    private $produkid;
    
    function getGambarprodukid() {
        return $this->gambarprodukid;
    }

    function getLinkgambarproduk() {
        return $this->linkgambarproduk;
    }

    function getProdukid() {
        return $this->produkid;
    }

    function setGambarprodukid($gambarprodukid) {
        $this->gambarprodukid = $gambarprodukid;
    }

    function setLinkgambarproduk($linkgambarproduk) {
        $this->linkgambarproduk = $linkgambarproduk;
    }

    function setProdukid($produkid) {
        $this->produkid = $produkid;
    }

    
    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>