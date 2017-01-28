<?php
    class Reportorderadmin
    {
        private $namatoko;
        private $jumlah;
        
        function getNamatoko() {
            return $this->namatoko;
        }

        function getJumlah() {
            return $this->jumlah;
        }

        function setNamatoko($namatoko) {
            $this->namatoko = $namatoko;
        }

        function setJumlah($jumlah) {
            $this->jumlah = $jumlah;
        }

        function serialize(){
            return json_decode(json_encode(get_object_vars($this)));
        }
    }
?>