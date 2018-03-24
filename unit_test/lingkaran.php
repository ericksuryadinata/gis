<?php

class Lingkaran{
    protected $jari;
    protected $luas;

    function __construct($r){
        $this->jari = $r;
        echo "Lingkaran \r\n";
        echo "Jari ".$this->jari."\r\n";
    }

    function luasLingkaran(){
        $this->luas = 3.14*$this->jari*$this->jari;
        return $this->luas;
    }
}

class Tabung extends Lingkaran{
    private $tinggi;
    private $volume;

    function __construct($r,$t){
        $this->jari = $r;
        $this->tinggi = $t;
        echo "Tabung \r\n";
        echo "Jari ".$this->jari." dan tinggi ".$this->tinggi."\r\n";
    }

    function volumeTabung(){
        parent::luasLingkaran();
        $this->volume = $this->luas * $this->tinggi;
        return $this->volume;
    }
}

class Main extends Tabung{

    function __construct($r,$t){
        Lingkaran::__construct($r);
        echo "Luas Lingkaran : ".Lingkaran::luasLingkaran()."\r\n";
        Tabung::__construct($r,$t);
        echo "Volume Tabung : ".Tabung::volumeTabung();
    }

}
?>