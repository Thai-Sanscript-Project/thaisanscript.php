<?php

use ThaiSanskrit\ThaiSanscriptAPI;

class ThaiNormalWordTest extends PHPUnit_Framework_TestCase {

    public function testCaseProvider() {
        // parse your data file however you want
        $data = array();
        foreach (file('./test/DataProviderWordTest.csv') as $line) {
            $data[] = explode(",", trim($line));
        }
        return $data;
    }

    /**
     * @dataProvider testCaseProvider
     */
    public function testAddition($roman, $thai) {
        $roman = trim($roman);
        $thai = trim($thai);
        $this->spacialCase($roman, $thai);
    }

    public function spacialCase($src, $asrt) {
        $thaiSanscriptAPI = new ThaiSanscriptAPI();
        $src = $thaiSanscriptAPI->transliterationTracking($src);
        echo " ['ASRT :" . $asrt . "' : '" . $src . "'] \n";
        $this->assertEquals($asrt, $src);
    }

}
