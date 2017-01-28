<?php
class Gambartoko
{
    private $gambartokoid;
    private $linkgambartoko;
    private $tokoid;
    
    function getGambartokoid() {
        return $this->gambartokoid;
    }

    function getLinkgambartoko() {
        return $this->linkgambartoko;
    }

    function getTokoid() {
        return $this->tokoid;
    }

    function setGambartokoid($gambartokoid) {
        $this->gambartokoid = $gambartokoid;
    }

    function setLinkgambartoko($linkgambartoko) {
        $this->linkgambartoko = $linkgambartoko;
    }

    function setTokoid($tokoid) {
        $this->tokoid = $tokoid;
    }

    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>