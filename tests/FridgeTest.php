<?php
class FridgeTest extends PHPUnit_Framework_TestCase {

    public function testPutGoodItem() {
        $fridge = new Fridge();
        $ingredient1 = new Ingredient('bread', 1, 'slices', new DateTime('+30 day'));
        $ingredient2 = new Ingredient('butter', 1, 'slices', new DateTime('+30 day'));
        $fridge->put($ingredient1);
        $fridge->put($ingredient2);

        $items = $fridge->getItems();
        $this->assertEquals($items[0]->getItem(), $ingredient1->getItem());
        $this->assertEquals($items[1]->getItem(), $ingredient2->getItem());
    }

    public function testPutExpiredItem() {
        $fridge = new Fridge();
        $ingredient1 = new Ingredient('bread', 1, 'slices', new DateTime('+30 day'));
        $ingredient2 = new Ingredient('butter', 1, 'slices', new DateTime('-30 day'));
        $fridge->put($ingredient1);
        $fridge->put($ingredient2);

        $items = $fridge->getItems();
        $this->assertEquals($items[0]->getItem(), $ingredient1->getItem());
        $this->assertEquals(sizeof($fridge->getItems()), 1);
    }

    public function testLookupFunction() {
        $fridge = new Fridge();
        $ingredient1 = new Ingredient('bread', 1, 'slices', new DateTime('+30 day'));
        $ingredient2 = new Ingredient('butter', 1, 'slices', new DateTime('+30 day'));
        $ingredient3 = new Ingredient('butter', 2, 'slices', new DateTime('+15 day'));
        $fridge->put($ingredient1);
        $fridge->put($ingredient2);
        $fridge->put($ingredient3);

        $results = $fridge->lookup("butter", "slices", 1);
        $this->assertEquals($results[0], $ingredient3);
        $this->assertEquals(sizeof($results), 1);

        $results = $fridge->lookup("butter", "slices", 2);
        $this->assertEquals($results[0], $ingredient3);
        $this->assertEquals(sizeof($results), 1);

        $results = $fridge->lookup("butter", "slices", 3);
        $this->assertEquals($results[0], $ingredient3);
        $this->assertEquals($results[1], $ingredient2);
        $this->assertEquals(sizeof($results), 2);
    }

    public function testFillFromArrayFunction() {
        $testData = array(
            0 =>
                array (
                    0 => 'bread',
                    1 => '10',
                    2 => 'slices',
                    3 => date_format(new DateTime('+365 days'), 'd/m/Y'),
                ),
            1 =>
                array (
                    0 => 'cheese',
                    1 => '10',
                    2 => 'slices',
                    3 => date_format(new DateTime('+365 days'), 'd/m/Y'),
                ),
        );
        $fridge = new Fridge();
        $fridge->fillFromArray($testData);

        $items = $fridge->getItems();
        $this->assertEquals($items[0]->getItem(), $testData[0][0]);
        $this->assertEquals($items[1]->getItem(), $testData[1][0]);
        $this->assertEquals(sizeof($items), 2);
    }
}