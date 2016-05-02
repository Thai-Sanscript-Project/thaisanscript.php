<?php

use ThaiSanskrit\ThaiSanscriptAPI;

class ThaiInformWordTest extends PHPUnit_Framework_TestCase {

    public function testCaseProvider() {
        // parse your data file however you want
        $data = array();
        $file = file('./test/DataProviderWordTest.csv');
        unset($file[0]);
        foreach ($file as $line) {
            $data[] = explode(",", trim($line));
        }
        return $data;
    }

    /**
     * @dataProvider testCaseProvider
     */
    public function testAddition($roman, $thai,$thaiform) {
        $roman = trim($roman);
        $thai = trim($thaiform);
        $this->spacialCase($roman, $thai);
    }

    public function spacialCase($src, $asrt) {
        $thaiSanscriptAPI = new ThaiSanscriptAPI();
        $src = $thaiSanscriptAPI->transliterationTracking($src,"inform");
        echo " ['ASRT :" . $asrt . "' : '" . $src . "'] \n";
        $this->assertEquals($asrt, $src);
    }

}
