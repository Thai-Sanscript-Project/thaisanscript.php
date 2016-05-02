<?php

use ThaiSanskrit\ThaiSanscriptRule;
use ThaiSanskrit\ThaiSanscript;
use ThaiSanskrit\Util;

class ThaiSanscriptRuleTest extends PHPUnit_Framework_TestCase {

    public $thaiMapper;
    public $util;

    public function __construct() {
        $this->thaiMapper = new ThaiSanscript();
        $this->util = new Util();
    }

    private function isThaiVowel($array, $asrt) {
        foreach ($array as $value) {
            $result = $this->util->isThaiVowel($value);
            $this->assertEquals($asrt, $result ? 1 : 0);
        }
    }

    private function isThaiConsonant($array, $asrt) {
        foreach ($array as $value) {
            $result = $this->util->isThaiConsonant($value);
            $this->assertEquals($asrt, $result ? 1 : 0);
        }
    }

    private function isThaiCharacter($array, $asrt) {
        foreach ($array as $value) {
            $result = $this->util->isThaiCharacter($value);
            $this->assertEquals($asrt, $result ? 1 : 0);
        }
    }

    public function testisThaiVowel() {
        $array1 = $this->thaiMapper->singleConsonant;
        $array2 = $this->thaiMapper->mixConsonant;
        $array3 = $this->thaiMapper->singleVowel;
        $array4 = $this->thaiMapper->mixVowel;
        $this->isThaiVowel($array1, 0);
        $this->isThaiVowel($array2, 0);
        $this->isThaiVowel($array3, 1);
        $this->isThaiVowel($array4, 1);
        $this->isThaiVowel(array(" "), 0);
    }

    public function testisThaiConsonant() {
        $array1 = $this->thaiMapper->singleConsonant;
        $array2 = $this->thaiMapper->mixConsonant;
        $array3 = $this->thaiMapper->singleVowel;
        $array4 = $this->thaiMapper->mixVowel;
        $this->isThaiConsonant($array1, 1);
        $this->isThaiConsonant($array2, 1);
        $this->isThaiConsonant($array3, 0);
        $this->isThaiConsonant($array4, 0);
        $this->isThaiConsonant(array(" "), 0);
    }

    public function testisThaiCharacter() {
        $array1 = $this->thaiMapper->singleConsonant;
        $array2 = $this->thaiMapper->mixConsonant;
        $array3 = $this->thaiMapper->singleVowel;
        $array4 = $this->thaiMapper->mixVowel;
        $this->isThaiCharacter($array1, 1);
        $this->isThaiCharacter($array2, 1);
        $this->isThaiCharacter($array3, 1);
        $this->isThaiCharacter($array4, 1);
        $this->isThaiCharacter(array(" ", "-", "@", ","), 0);
    }

    public function testconvertListTostring() {

        $asrt = "as df ฟหกดเสวง";
        $src = $this->util->convertListTostring(array('a', 's', ' ', 'd', 'f', ' ', 'ฟ', 'ห', 'ก', 'ด', 'เ', 'ส', 'ว', 'ง'));
        $this->assertEquals($asrt, $src);
    }

    public function testcharList() {

        $asrt = array('a', 's', ' ', 'd', 'f', ' ', 'ฟ', 'ห', 'ก', 'ด', 'เ', 'ส', 'ว', 'ง');
        $src = $this->util->charList("as df ฟหกดเสวง");
        $this->assertEquals($asrt, $src);
    }

    public function testMapper() {
        $asrt = "ฟหก";
        $romanize = "ASD";
        $mapping = array("A" => "ฟ", "S" => "ห", "D" => "ก");
        $src = $this->util->Mapper($mapping, $romanize);
        $this->assertEquals($asrt, $src);
    }

    public function testconvertRomanizeSingleConsonant() {
        $mapping = $this->thaiMapper->singleConsonant;
        $revert = array();
        $romanize = $this->thaiMapper->setRevertFlag($revert, $mapping);
        $src = $this->util->convertRomanizeSingleConsonant($romanize);
        $src = implode("", $src);
        $asrt = "กคงจชญฏฑณตทนปพมยรลวฬศษสหँํห์'";
        $this->assertEquals($asrt, $src);
    }

    public function testconvertRomanizeMixConsonant() {
        $mapping = $this->thaiMapper->mixConsonant;
        $revert = array();
        $romanize = $this->thaiMapper->setRevertFlag($revert, $mapping);
        $src = $this->util->convertRomanizeMixConsonant($romanize);
        $src = implode("", $src);
        $asrt = "ขฉฐถผญฆฌฒธภ";
        $this->assertEquals($asrt, $src);
    }

    public function testconvertRomanizeSingleVowel() {
        $mapping = $this->thaiMapper->singleVowel;
        $revert = array();
        $romanize = $this->thaiMapper->setRevertFlag($revert, $mapping);
        $src = $this->util->convertRomanizeSingleVowel($romanize);
        $src = implode("", $src);
        $asrt = "ะาิีุูฤฤๅฦฦๅเโ";
        $this->assertEquals($asrt, $src);
    }

    public function testconvertRomanizeMixVowel() {
        $mapping = $this->thaiMapper->mixVowel;
        $revert = array();
        $romanize = $this->thaiMapper->setRevertFlag($revert, $mapping);
        $src = $this->util->convertRomanizeMixVowel($romanize);
        $src = implode("", $src);
        $asrt = "ไเาฤ";
        $this->assertEquals($asrt, $src);
    }

    public function testconvertThaiVowelPrefix() {

        $src = "อเกกโนกไลกเา";
        $src = $this->util->convertThaiVowelPrefix($src);
        $asrt = "เอกโกนไกลเกา";
        $this->assertEquals($asrt, $src);
    }

    public function testswapArray() {
        $src = array("A", "B");
        $src = $this->util->swapArray(true, $src, 1);
        $asrt = array("B", "A");
        $this->assertEquals($asrt, $src);
    }

    public function testconvertThaiVowelInFist() {

        $src = "ะ า ิ ี ุ ู เ โ ะ ไ";
        $src = $this->util->convertThaiVowelInFist($src);
        $asrt = "อะ อา อิ อี อุ อู เอ โอ อะ ไอ ";
        $this->assertEquals($asrt, $src);
    }

    public function testconvertThaiVisarga() {
//        try {
        $src = "ะนกะ";
        $asrt = "อันกะ";
        $src = $this->getThaiSanscriptRule()->convertThaiVisarga($src);
        $this->assertEquals($asrt, $src);

        $src = "ระก";
        $asrt = "รัก";
        $src = $this->getThaiSanscriptRule()->convertThaiVisarga($src);
        $this->assertEquals($asrt, $src);


////              
//        } catch (Exception $exc) {
//            echo $exc->getTraceAsString();
//        }
    }

//    public function testconvertThaiAAInFist() {
//
//        $src = "॥ารยะวัชรัจเฉทิกา";
//        $asrt = "॥อารยะวัชรัจเฉทิกา";
//        $src = $this->getThaiSanscriptRule()->convertThaiAAInFist($src);
//        $this->assertEquals($asrt, $src);
//    }

    public function getThaiSanscriptRule() {

        return new ThaiSanscriptRule();
    }

}
