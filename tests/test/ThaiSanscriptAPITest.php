<?php

use ThaiSanskrit\ThaiSanscriptAPI;

class ThaiSanscriptAPITest extends PHPUnit_Framework_TestCase {
    /* @var $api ThaiSanskrit\ThaiSanscriptAPI; */

    public $api;

    public function __construct() {
        $this->api = new ThaiSanscriptAPI();
    }

    public function testPrepareTxt() {
        $asrt = "xxxx@xxx@xx@x@";
        $param = "xxxx xxx  xx   x     ";
        $src = $this->api->prepareTxt($param);
        $this->assertEquals($asrt, $src);
    }

    public function line_split() {
        $asrt = "as df ฟหกดเสวง";
        $src = $this->assertEquals($asrt, $src);
    }

    public function testConvertThaiInform() {
        $asrt = "โลกาะ สมสฺตาะ สุขิโนภวนฺตุ";
        $param = "lokāḥ samastāḥ sukhinobhavantu";
        $src = $this->api->convertThaiInform($param);
        $this->assertEquals($asrt, $src);
    }

    public function testConvertThai() {
        $asrt = "โลกาห์ สะมัสตาห์ สุขิโนภะวันตุ";
        $param = "lokāḥ samastāḥ sukhinobhavantu";
        $src = $this->api->convertThai($param);
        $this->assertEquals($asrt, $src);
    }

}
