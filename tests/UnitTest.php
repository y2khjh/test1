<?php
class UnitTest extends PHPUnit_Framework_TestCase {

    public function testValidateFunction() {
        $this->assertEquals(Unit::validate('of'), true);
        $this->assertEquals(Unit::validate('grams'), true);
        $this->assertEquals(Unit::validate('ml'), true);
        $this->assertEquals(Unit::validate('slices'), true);

        $this->assertEquals(Unit::validate('tones'), false);
    }
}