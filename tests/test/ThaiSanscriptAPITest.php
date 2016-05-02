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

    public function testLine_split() {
        $asrt = array(array("xxx", "xxx", "xxx", "xxx"), array("zzz", "zzz", "zzz", "zzz"));
        $param = "xxx@xxx@xxx@xxx\n"
                . "zzz@zzz@zzz@zzz";
        $src = $this->api->line_split($param);
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
