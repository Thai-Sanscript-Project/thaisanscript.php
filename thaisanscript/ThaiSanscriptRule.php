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
        $txt = $this->util->convertRomanChandrabinduToSingle($txt);
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
        $txt = $this->util->convertAE($txt);
        $txt = $this->util->convertAO($txt);

        return $txt;
    }

    public function convertTrackMode($romanize) {
        $txt = $romanize;
        $this->printTrackMode($txt);
        $txt = $this->util->convertRomanChandrabinduToSingle($txt);
        ThaiSanscriptRule::printTrackMode($txt, "begin");
        $txt = $this->util->convertNumber($txt);
        ThaiSanscriptRule::printTrackMode($txt, "Number");
        $txt = $this->util->convertRomanizeMixConsonant($txt);
        ThaiSanscriptRule::printTrackMode($txt, "MixCon");
        $txt = $this->util->convertRomanizeMixVowel($txt);
        ThaiSanscriptRule::printTrackMode($txt, "MixVow");
        $txt = $this->util->convertRomanizeSingleConsonant($txt);
        ThaiSanscriptRule::printTrackMode($txt, "SingleCon");
        $txt = $this->util->convertRomanizeSingleVowel($txt);
        ThaiSanscriptRule::printTrackMode($txt, "SingleVow");
        $txt = $this->convertAnusvaraAndChandrabindu($txt);
        ThaiSanscriptRule::printTrackMode($txt, "AnusvaraAndChandrabindu");
        $txt = $this->util->convertThaiVowelInFist($txt);
        ThaiSanscriptRule::printTrackMode($txt, "ThaiVowelInFist");
        $txt = $this->convertThaiVisarga($txt);
        ThaiSanscriptRule::printTrackMode($txt, "ThaiVisarga");
        $txt = $this->util->convertThaiVowelPrefix($txt);
        ThaiSanscriptRule::printTrackMode($txt, "ThaiVowelPrefix");
        $txt = $this->util->convertThaiAAInFist($txt);
        ThaiSanscriptRule::printTrackMode($txt, "ThaiAAInFist");
        $txt = $this->util->convertAE($txt);
        $txt = $this->util->convertAO($txt);

        return $txt;
    }

    public static function printTrackMode($romanize, $state = "") {
        echo ("[" . $state . "] " . $romanize . " -> ");
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
        //return str_replace(" ", "", $this->util->convertListTostring($charList));
        return trim($this->util->convertListTostring($charList));
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
