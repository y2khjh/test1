<?php
include_once 'Bootstrap.php';

class FridgeTest extends PHPUnit_Framework_TestCase {

    public function testPutGoodItem() {
        $fridge = new Fridge();
        $ingredient1 = new Ingredient('bread', 1, 'slices', new DateTime('+30 day'));
        $ingredient2 = new Ingredient('butter', 1, 'slices', new DateTime('+30 day'));
        $fridge->put($ingredient1);
        $fridge->put($ingredient2);

        $this->assertEquals($fridge->getItems()[0]->getItem(), $ingredient1->getItem());
        $this->assertEquals($fridge->getItems()[1]->getItem(), $ingredient2->getItem());
    }

    public function testPutExpiredItem() {
        $fridge = new Fridge();
        $ingredient1 = new Ingredient('bread', 1, 'slices', new DateTime('+30 day'));
        $ingredient2 = new Ingredient('butter', 1, 'slices', new DateTime('-30 day'));
        $fridge->put($ingredient1);
        $fridge->put($ingredient2);

        $this->assertEquals($fridge->getItems()[0]->getItem(), $ingredient1->getItem());
        $this->assertEquals(sizeof($fridge->getItems()), 1);
    }

    public function testLookupFunction() {
        $fridge = new Fridge();
        $ingredient1 = new Ingredient('bread', 1, 'slices', new DateTime('+30 day'));
        $ingredient2 = new Ingredient('butter', 1, 'slices', new DateTime('+30 day'));
        $fridge->put($ingredient1);
        $fridge->put($ingredient2);

        $wanted = new Ingredient('bread', 1, 'slices', new DateTime('+30 day'));
        $results = $fridge->lookup($wanted);
        $this->assertEquals($results[0], $wanted);
        $this->assertEquals(sizeof($fridge->getItems()), 1);
    }
}