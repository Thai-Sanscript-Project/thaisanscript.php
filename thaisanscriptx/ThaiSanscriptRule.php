<?php

namespace ThaiSanskrit;

use ThaiSanskrit\ThaiSanscript;
use ThaiSanskrit\ThaiVisargaConvert;
use ThaiSanskrit\Util;

class ThaiSanscriptRule {

    public $thaimapper;
    public $visarga;
    private $util;

    function __construct() {
        $this->thaimapper = new ThaiSanscript();
        $this->visarga = new ThaiVisargaConvert();
        $this->util = new Util();
    }

    public function convert($romanize) {
        $txt = $romanize;
        $txt = $this->util->convertNumber($txt);
        $txt = $this->util->convertRomanizeMixConsonant($txt);
        $txt = $this->util->convertRomanizeMixVowel($txt);
        $txt = $this->util->convertRomanizeSingleConsonant($txt);
        $txt = $this->util->convertRomanizeSingleVowel($txt);
        $txt = $this->convertAnusvaraAndChandrabindu($txt);
        $txt = $this->util->convertThaiVowelInFist($txt);
        $txt = $this->convertThaiVisarga($txt);
        $txt = $this->util->convertThaiVowelPrefix($txt);
        $txt = $this->util->convertThaiAAInFist($txt);

        return $txt;
    }

    public function convertTrackMode($romanize) {
        $txt = $romanize;
        ThaiSanscriptRule::printTrackMode($txt);
        $txt = $this->util->convertNumber($txt);
        ThaiSanscriptRule::printTrackMode($txt);
        $txt = $this->util->convertRomanizeMixConsonant($txt);
        ThaiSanscriptRule::printTrackMode($txt);
        $txt = $this->util->convertRomanizeMixVowel($txt);
        ThaiSanscriptRule::printTrackMode($txt);
        $txt = $this->util->convertRomanizeSingleConsonant($txt);
        ThaiSanscriptRule::printTrackMode($txt);
        $txt = $this->util->convertRomanizeSingleVowel($txt);
        ThaiSanscriptRule::printTrackMode($txt);
        $txt = $this->convertAnusvaraAndChandrabindu($txt);
        ThaiSanscriptRule::printTrackMode($txt);
        $txt = $this->util->convertThaiVowelInFist($txt);
        ThaiSanscriptRule::printTrackMode($txt);
        $txt = $this->convertThaiVisarga($txt);
        ThaiSanscriptRule::printTrackMode($txt);
        $txt = $this->util->convertThaiVowelPrefix($txt);
        ThaiSanscriptRule::printTrackMode($txt);
        $txt = $this->util->convertThaiAAInFist($txt);
        ThaiSanscriptRule::printTrackMode($txt);

        return $txt;
    }

    public static function printTrackMode($romanize) {
        echo ($romanize . " -> ");
    }

    public function convertAnusvaraAndChandrabindu($thaiChar) {
        $thaiChar = $thaiChar . " "; // after space 1  reserve  for condition
        $charList = $this->util->charList($thaiChar);

        foreach ($charList as $i => $char) {
//        for ($i = 0; $i < count($charList); $i++) {
            if ($char === $this->thaimapper->anusvara ||
                    $char === $this->thaimapper->chandrabindu) {

                $charList[$i] = $this->thaimapper->getAnusvara($charList[$i + 1]);
            }
        }
        return str_replace(" ", "", $this->util->convertListTostring($charList));
    }

//    public function convertThaiAAInFist($thaiChar) { //แปลงท้ายสุดแก้ปัญหา สระ เอา จะเหลือสระอา ดังนั้นต้องแปลงอีก
//        $charList = $this->util->charList($thaiChar);
//        foreach ($charList as $i => $char) {
//            //for ($index = 1; $index < count($charList); $index++) {
//            if ($i > 0) {
//                $check1 = !$this->util->isThaiConsonant($charList[$i - 1]) &&
//                        $char == 'า';
//
//                if ($check1) {
//                    $charList[$i] = "อา";
//                }
//            }
//        }
//        $thaiChar = $this->util->convertListTostring($charList);
//        $thaiChar = str_replace("\xE2\x80\x8D", "", $thaiChar); //Remove ZERO WIDTH JOINER
//        return $thaiChar;
//    }

    public function convertThaiVisarga($thaiChar) {
        return $this->visarga->convert($thaiChar);
    }

}
