<?php
class Report
{
    private $jenistokoid;
    private $namajenis;
    private $statusincart;
    private $statuswanttobuy;
    private $statusaccepted;
    private $statuscancelled;
    private $statustotal;
    

    

        
    function getJenistokoid() {
        return $this->jenistokoid;
    }

    function getStatusincart() {
        return $this->statusincart;
    }

    function getStatuswanttobuy() {
        return $this->statuswanttobuy;
    }

    function getStatusaccepted() {
        return $this->statusaccepted;
    }

    function getStatuscancelled() {
        return $this->statuscancelled;
    }

    function getNamajenis() {
        return $this->namajenis;
    }
    
    function getStatustotal() {
        return $this->statustotal;
    }
    
    function setJenistokoid($jenistokoid) {
        $this->jenistokoid = $jenistokoid;
    }

    function setStatusincart($statusincart) {
        $this->statusincart = $statusincart;
    }

    function setStatuswanttobuy($statuswanttobuy) {
        $this->statuswanttobuy = $statuswanttobuy;
    }

    function setStatusaccepted($statusaccepted) {
        $this->statusaccepted = $statusaccepted;
    }

    function setStatuscancelled($statuscancelled) {
        $this->statuscancelled = $statuscancelled;
    }
    
    function setNamajenis($namajenis) {
        $this->namajenis = $namajenis;
    }
    
    function setStatustotal($statustotal) {
        $this->statustotal = $statustotal;
    }

    function serialize(){
        return json_decode(json_encode(get_object_vars($this)));
    }
}

?>