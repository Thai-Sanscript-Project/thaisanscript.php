<?php

namespace ThaiSanskrit;

use ThaiSanskrit\Utility;
use ThaiSanskrit\Util;
use ThaiSanskrit\ThaiSanscript;

/* @var util Utility */

class ThaiSanscriptInformRule {

    public $informmapper;
    public $util;

    public function __construct() {
        $this->informmapper = new ThaiSanscript(TRUE);
        $this->util = new Util(TRUE);
    }

    public function convert($txt) {
        $txt = $this->util->convertNumber($txt);
        $txt = $this->util->convertRomanizeMixConsonant($txt);
        $txt = $this->util->convertRomanizeMixVowel($txt);
        $txt = $this->util->convertRomanizeSingleConsonant($txt);
        $txt = $this->util->convertRomanizeSingleVowel($txt);
        $txt = $this->convertBindu($txt);
        $txt = $this->util->convertThaiVowelInFist($txt);
        $txt = $this->util->convertThaiVowelPrefix($txt);
        $txt = $this->removeA($txt);
        $txt = $this->swapAnusvaraAndChandrabindu($txt);
        $txt = $this->convertChandrabindu($txt);
        $txt = $this->util->convertThaiAAInFist($txt);

        return $txt;
    }

    public function convertTrackMode($txt) {
        $txt = $this->util->convertNumber($txt);
        $txt = $this->util->convertRomanizeMixConsonant($txt);
        $txt = $this->util->convertRomanizeMixVowel($txt);
        $txt = $this->util->convertRomanizeSingleConsonant($txt);
        $txt = $this->util->convertRomanizeSingleVowel($txt);
        $txt = $this->convertBindu($txt);
        $txt = $this->util->convertThaiVowelInFist($txt);
        $txt = $this->util->convertThaiVowelPrefix($txt);
        $txt = $this->removeA($txt);
        $txt = $this->swapAnusvaraAndChandrabindu($txt);
        $txt = $this->convertChandrabindu($txt);
        $txt = $this->util->convertThaiAAInFist($txt);

        return $txt;
    }

    public function printTrackMode($txt, $isTracking) {
        echo ($txt . " -> ");
    }

    public function convertBindu($txt) {
        $txt = $txt . " ";
        $charList = $this->util->charList($txt);
        foreach ($charList as $i => $char) {

//        }
//        for ($i = 0; $i < count($charList); $i++) {
            if ($charList[$i] != " ") {
//                $_current = $charList[$i];
                $_current = $char;
                $_after1 = $charList[$i + 1];
                $condition = $this->util->isThaiConsonant($_current) &&
                        $this->informmapper->anusvara != $_current &&
                        $this->informmapper->chandrabindu != $_current &&
                        "ะ" != $_current &&
                        "'" != $_current &&
                        $_after1 != "a" &&
                        !$this->util->isThaiVowel($_after1);
                if ($condition) {
                    $charList[$i] = $_current . "ฺ";
                }
            }
        }
        $txt = $this->util->convertListTostring($charList);

        return $txt;
    }

    public function removeA($txt) {

        $charList = $this->util->charList($txt);

        foreach ($charList as $i => $char) {
//        for ($i = 0; $i < count($charList); $i++) {
            if ($char == "a") {
                $charList[$i] = "";
            }
        }
        $txt = $this->util->convertListTostring($charList);

        return $txt;
    }

    public function convertChandrabindu($txt) {
        $txt = str_replace($this->informmapper->chandrabindu, "ัํ", $txt);
        return $txt;
    }

    public function swapAnusvaraAndChandrabindu($txt) {
        $txt = $txt . "  "; //  after space 2  reserve  for condition
        $charList = $this->util->charList($txt);

        foreach ($charList as $i => $char) {
//        for ($i = 1; $i < count($charList); $i++) {
            if ($char == "า") {

                if ($charList[$i + 1] == "ํ") {
                    $charList = $this->util->swapArray(TRUE, $charList, $i + 1);
                } elseif ($charList[$i + 1] == $this->informmapper->chandrabindu) {
                    $charList = $this->util->swapArray(TRUE, $charList, $i + 1);
                }
            }
        }
        return str_replace(" ", "", $this->util->convertListTostring($charList));
    }

}
