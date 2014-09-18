<?php
class IngredientTest extends PHPUnit_Framework_TestCase {

    public function testIngredientWhenValid() {
        $item = 'butter';
        $amount = 1;
        $unit = 'slices';
        $usedBy = new DateTime('+30 day');
        $ingredient = new Ingredient($item, $amount, $unit, $usedBy);

        $this->assertEquals($ingredient->getItem(), $item);
        $this->assertEquals($ingredient->getAmount(), $amount);
        $this->assertEquals($ingredient->getUnit(), $unit);
        $this->assertEquals($ingredient->getUsedBy(), $usedBy);
        $this->assertEquals($ingredient->hasExpired(), false);
    }

    public function testIngredientWhenExpired() {
        $ingredient = new Ingredient('butter', 1, 'slices', new DateTime('-30 day'));
        $this->assertEquals($ingredient->hasExpired(), true);
    }

    public function testIngredientWhenUnitInvalid() {
        $this->setExpectedException('InvalidArgumentException');
        $ingredient = new Ingredient('butter', 1, 'tones', new DateTime('-30 day'));
    }
}