<?php
class FinderTest extends PHPUnit_Framework_TestCase {

    private function getFridge() {
        $fridgeItems = array (
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
            2 =>
                array (
                    0 => 'butter',
                    1 => '250',
                    2 => 'grams',
                    3 => date_format(new DateTime('+365 days'), 'd/m/Y'),
                ),
            3 =>
                array (
                    0 => 'peanut butter',
                    1 => '250',
                    2 => 'grams',
                    3 => date_format(new DateTime('+180 days'), 'd/m/Y'),
                ),
            4 =>
                array (
                    0 => 'mixed salad',
                    1 => '500',
                    2 => 'grams',
                    3 => date_format(new DateTime('-10 days'), 'd/m/Y'),
                ),
        );

        $fridge = new Fridge();
        foreach ($fridgeItems as $item) {
            $fridge->put(new Ingredient(
                $item[0],
                $item[1],
                $item[2],
                date_create_from_format('d/m/Y', $item[3])
            ));
        }
        return $fridge;
    }

    private function getRecipesData() {
        $recipesData = array (
            0 =>
                array (
                    'name' => 'grilled cheese on toast',
                    'ingredients' =>
                        array (
                            0 =>
                                array (
                                    'item' => 'bread',
                                    'amount' => '2',
                                    'unit' => 'slices',
                                ),
                            1 =>
                                array (
                                    'item' => 'cheese',
                                    'amount' => '2',
                                    'unit' => 'slices',
                                ),
                        ),
                ),
            1 =>
                array (
                    'name' => 'salad sandwich',
                    'ingredients' =>
                        array (
                            0 =>
                                array (
                                    'item' => 'bread',
                                    'amount' => '2',
                                    'unit' => 'slices',
                                ),
                            1 =>
                                array (
                                    'item' => 'mixed salad',
                                    'amount' => '200',
                                    'unit' => 'grams',
                                ),
                        ),
                ),
        );
        return $recipesData;
    }

    public function testFindRecipeFunction() {
        $fridge = $this->getFridge();
        $idealRecipes = $this->getRecipesData();
        $finder = new Finder($fridge);

        $result1 = $finder->findRecipe($idealRecipes);
        $this->assertEquals($result1, 'grilled cheese on toast');

        $newRecipe2 = array (
            'name' => 'extra cheese and peanut butter on bread',
            'ingredients' =>
                array (
                    0 =>
                        array (
                            'item' => 'bread',
                            'amount' => '2',
                            'unit' => 'slices',
                        ),
                    1 =>
                        array (
                            'item' => 'cheese',
                            'amount' => '10',
                            'unit' => 'slices',
                        ),
                    2 =>
                        array (
                            'item' => 'peanut butter',
                            'amount' => '250',
                            'unit' => 'grams',
                        ),
                ),
        );
        $result2 = $finder->findRecipe(array_merge($idealRecipes, array($newRecipe2)));
        $this->assertEquals($result2, 'extra cheese and peanut butter on bread');

        $newRecipe3 = array (
            'name' => 'expired salad',
            'ingredients' =>
                array (
                    0 =>
                        array (
                            'item' => 'mixed salad',
                            'amount' => '200',
                            'unit' => 'grams',
                        ),
                ),
        );
        $result3 = $finder->findRecipe(array($newRecipe3));
        $this->assertEquals($result3, 'Order Takeout');
    }
}