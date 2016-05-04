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
        $txt = $this->util->convertRomanChandrabinduToSingle($txt);
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
        $this->printTrackMode($txt);
        $txt = $this->util->convertRomanChandrabinduToSingle($txt);
        $this->printTrackMode($txt);
        $txt = $this->util->convertNumber($txt);
        $this->printTrackMode($txt);
        $txt = $this->util->convertRomanizeMixConsonant($txt);
        $this->printTrackMode($txt);
        $txt = $this->util->convertRomanizeMixVowel($txt);
        $this->printTrackMode($txt);
        $txt = $this->util->convertRomanizeSingleConsonant($txt);
        $this->printTrackMode($txt);
        $txt = $this->util->convertRomanizeSingleVowel($txt);
        $this->printTrackMode($txt);
        $txt = $this->convertBindu($txt);
        $this->printTrackMode($txt);
        $txt = $this->util->convertThaiVowelInFist($txt);
        $this->printTrackMode($txt);
        $txt = $this->util->convertThaiVowelPrefix($txt);
        $this->printTrackMode($txt);
        $txt = $this->removeA($txt);
        $this->printTrackMode($txt);
        $txt = $this->swapAnusvaraAndChandrabindu($txt);
        $this->printTrackMode($txt);
        $txt = $this->convertChandrabindu($txt);
        $this->printTrackMode($txt);
        $txt = $this->util->convertThaiAAInFist($txt);
        $this->printTrackMode($txt);

        return $txt;
    }

    public function printTrackMode($txt) {
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
        $txt = str_replace("a", "", $txt);
        return $txt;
//        $charList = $this->util->charList($txt);
//        foreach ($charList as $i => $char) {
//            if ($char == "a") {
//                $charList[$i] = "";
//            }
//        }
//        $txt = $this->util->convertListTostring($charList);
//        return $txt;
    }

    public function convertChandrabindu($txt) {
        $txt = str_replace($this->informmapper->chandrabindu, $this->informmapper->chandrabinduThaiInform, $txt);
        return $txt;
    }

    public function swapAnusvaraAndChandrabindu($txt) {
        $txt = str_replace("า" . $this->informmapper->anusvara, $this->informmapper->anusvara . "า", $txt);
        $txt = str_replace("า" . $this->informmapper->chandrabindu, $this->informmapper->chandrabindu . "า", $txt);
        return $txt;
//        $txt = $txt . "  "; //  after space 2  reserve  for condition
//        $charList = $this->util->charList($txt);       
//        foreach ($charList as $i => $char) {
//            if ($char == "า") {
//
//                if ($charList[$i + 1] == "ํ") {
//                    $charList = $this->util->swapArray(TRUE, $charList, $i + 1);
//                } elseif ($charList[$i + 1] == $this->informmapper->chandrabindu) {
//                    $charList = $this->util->swapArray(TRUE, $charList, $i + 1);
//                }
//            }
//        }
//        return trim($this->util->convertListTostring($charList));
    }

}
