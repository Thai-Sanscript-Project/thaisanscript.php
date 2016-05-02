<?php

use ThaiSanskrit\ThaiSanscriptAPI;

class ProviderTest extends PHPUnit_Framework_TestCase {

    public function testCaseProvider() {
        // parse your data file however you want
        $data = array();
        foreach (file('test_data.txt') as $line) {
            $data[] = explode("\t", trim($line));
        }

        return $data;
    }

    /**
     * @dataProvider testCaseProvider
     */
    public function testAddition($num1, $num2, $expectedResult) {
        $this->assertEquals($expectedResult, $num1 + $num2);
    }

}
