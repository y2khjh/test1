<?php
class Finder {
    private $fridge;

    public function __construct(Fridge $fridge) {
        $this->fridge = $fridge;
    }

    private function prepareIngredients(array $items) {
        $ingredients = array();
        foreach ($items as $item) {
            $fridgeStocks = $this->fridge->lookup(
                $item['item'],
                $item['unit'],
                $item['amount']
            );

            // return empty array if any ingredient is not available
            if (empty($fridgeStocks)) {
                return array();
            }

            $ingredients = array_merge($ingredients, $fridgeStocks);
        }

        return $ingredients;
    }

    private function reorderRecipesByExpiry(array $recipes) {
        usort($recipes, function($a, $b) {
            if ($a->getEarliestUsedBy() > $b->getEarliestUsedBy()) {
                return 1;
            } elseif ($a->getEarliestUsedBy() == $b->getEarliestUsedBy()) {
                return 0;
            } else {
                return -1;
            }
        });
        return $recipes;
    }

    public function findRecipe(array $idealRecipes) {
        $recipes = array();
        foreach ($idealRecipes as $idealRecipe) {
            $ingredients = $this->prepareIngredients($idealRecipe['ingredients']);
            if ($ingredients) {
                $recipes[] = new Recipe($idealRecipe['name'], $ingredients);
            }
        }

        $recipes = $this->reorderRecipesByExpiry($recipes);

        if ($recipes) {
            return $recipes[0]->getName();
        }
        return 'Order Takeout';
    }
}