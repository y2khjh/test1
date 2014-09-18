<?php
class RecipeTest extends PHPUnit_Framework_TestCase {

    public function testRecipeWhenValid() {
        $name = 'bread with butter';
        $ingredients = array(
            new Ingredient('bread', 1, 'slices', new DateTime('+30 day')),
            new Ingredient('butter', 1, 'slices', new DateTime('+15 day')),
        );
        $recipe = new Recipe($name, $ingredients);

        $this->assertEquals($recipe->getName(), $name);
        $this->assertEquals($recipe->getIngredients(), $ingredients);
        $this->assertEquals($recipe->getEarliestUsedBy(), new DateTime('+15 day'));
    }

    public function testRecipeWithNotIngredient() {
        $this->setExpectedException('InvalidArgumentException');
        $recipe = new Recipe('bad recipe', array());
    }

    public function testRecipeWithBadIngredient() {
        $this->setExpectedException('InvalidArgumentException');
        $recipe = new Recipe('bad recipe', array(1, 2));
    }
}