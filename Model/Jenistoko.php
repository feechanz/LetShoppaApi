<?php
class Jenistoko
{
    private $jenistokoid;
    private $namajenis;
    
    function getJenistokoid() {
        return $this->jenistokoid;
    }

    function getNamajenis() {
        return $this->namajenis;
    }

    function setJenistokoid($jenistokoid) {
        $this->jenistokoid = $jenistokoid;
    }

    function setNamajenis($namajenis) {
        $this->namajenis = $namajenis;
    }
    
    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}
?>