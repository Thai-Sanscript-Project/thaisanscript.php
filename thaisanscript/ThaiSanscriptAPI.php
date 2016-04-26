<?php

namespace ThaiSanskrit;

use ThaiSanskrit\ThaiSanscriptRule;
use ThaiSanskrit\ThaiSanscriptInformRule;
use ThaiSanskrit\Util;

class ThaiSanscriptAPI {

    public $thaiInformRule;
    public $thaiRule;

    public function __construct() {

        $this->thaiRule = new ThaiSanscriptRule();
        $this->thaiInformRule = new ThaiSanscriptInformRule();
    }

    public function transliterationTracking($romanize) {
        $real = $this->thaiRule->convert($romanize);
        $track = $this->thaiRule->convertTrackMode($romanize);
        $check_concurrent = $real == $track;
        if($check_concurrent){
            return $track ;
        }else{
            echo 'transliterationTracking not concurrent';
        }
        return "";
    }

    public function transliterationToArray($romanize, $devanagari) {
        mb_internal_encoding("UTF-8");
        $romanize = mb_strtolower($romanize, "UTF-8");
        $returnArray = array();
        $listRomanize = preg_split('/\r\n|\r|\n/', $romanize);
        foreach ($listRomanize as $key => $line) {
            $syllableRomanize = explode(" ", $line);
            $syllableThai = array();
            $syllableThaiInform = array();

            foreach ($syllableRomanize as $i => $syllable) {
                $syllableThai[$i] = $this->thaiRule->convert($syllable);
                $syllableThaiInform[$i] = $this->thaiInformRule->convert($syllable);
            }
            $returnArray['0'][$key] = $syllableRomanize;
            $returnArray['1'][$key] = $syllableThai;
            $returnArray['2'][$key] = $syllableThaiInform;
        }
        if (trim($devanagari) != "") {
            $listDevanagari = preg_split('/\r\n|\r|\n/', $devanagari);
            foreach ($listDevanagari as $key => $line) {
                $syllableDevanagari = explode(" ", $line);
                $returnArray['3'][$key] = $syllableDevanagari;
            }
        }
        return $returnArray;
    }

}
