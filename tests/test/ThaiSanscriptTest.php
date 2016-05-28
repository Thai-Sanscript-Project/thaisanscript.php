<?php



use ThaiSanskrit\ThaiSanscript;

class ThaiSanscriptTest extends PHPUnit_Framework_TestCase {

     public $thaiMapper;

    public function __construct() {
        $this->thaiMapper = new ThaiSanscript();
    }

    public function testgetAnusvara() {
        $src = "อ,ก,ค,ง,จ,ช,ญ,ฏ,ฑ,ณ,ต,ท,น,ป,พ,ม,ย,ร,ล,ว,ฬ,ศ,ษ,ส,ห,ห์,',ข,ฉ,ฐ,ถ,ผ,ฆ,ฌ,ฒ,ธ,ภ";

        $src = explode(",", $src);
        $revert = "";
        $assrt = "มงงงญญญณณณนนนมมมมมมมมมมมมมมงญณนมงญณนม";
        foreach ($src as $value) {
            $revert .= $this->thaiMapper->getAnusvara($value);
        }
        $this->assertEquals($assrt, $revert);
    }

    public function testsetRevertFlag() {
        $torevert = $this->thaiMapper->singleConsonant;
        $revert = array();
        $revert = $this->thaiMapper->setRevertFlag($revert, $torevert);
        $assrt = "k,g,ṅ,c,j,ñ,ṭ,ḍ,ṇ,t,d,n,p,b,m,y,r,l,v,ḻ,ś,ṣ,s,h,ṁ,ḥ,'";
        $src = implode(",", $revert);
        $this->assertEquals($assrt, $src);
    }

    public function testmappingIsThaiConsonant() {
        $consonant = $this->thaiMapper->mappingIsThaiConsonant();
        //print_r($consonant);
        $assrt = "อ,ก,ค,ง,จ,ช,ญ,ฏ,ฑ,ณ,ต,ท,น,ป,พ,ม,ย,ร,ล,ว,ฬ,ศ,ษ,ส,ห,ํ,ห์,',ข,ฉ,ฐ,ถ,ผ,ฆ,ฌ,ฒ,ธ,ภ";
        $revert = $this->thaiMapper->setRevertFlag(array(), $consonant);
        $src = implode(",", $revert);
        $this->assertEquals($assrt, $src);
    }

    public function testmappingIsThaiVowel() {
        $vowel = $this->thaiMapper->mappingIsThaiVowel();
        $assrt = "ั,า,ิ,ี,ุ,ู,ฤ,ฤๅ,ฦ,ฦๅ,เ,โ,ไ,เา,ँ";
        $revert = $this->thaiMapper->setRevertFlag(array(), $vowel);
        $src = implode(",", $revert);
        $this->assertEquals($assrt, $src);
    }

}
