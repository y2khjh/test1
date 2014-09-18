<?php
class Recipe {
    private $name;
    private $ingredients = array();
    private $earliestUsedBy;

    public function __construct($name, array $ingredients) {
        $this->name = strval($name);
        $this->addIngredients($ingredients);
    }

    private function addIngredients(array $ingredients) {
        if (!$ingredients) {
            throw new InvalidArgumentException('Ingredient cannot empty');
        }
        foreach ($ingredients as $ingredient) {
            if (!$ingredient instanceof Ingredient) {
                throw new InvalidArgumentException('Invalid ingredient');
            } else {
                $ingredientName = strval($ingredient);
                if (isset($this->ingredients[$ingredientName])) {
                    $this->ingredients[$ingredientName]->addAmount($ingredient->getAmount());
                } else {
                    $this->ingredients[$ingredientName] = $ingredient;
                }

                // update the earliest usedBy date in ingredients
                if (empty($this->earliestUsedBy) || $ingredient->getUsedBy() < $this->earliestUsedBy) {
                    $this->earliestUsedBy = $ingredient->getUsedBy();
                }
            }
        }
    }

    public function getName() {
        return $this->name;
    }

    public function getIngredients() {
        return array_values($this->ingredients);
    }

    public function getEarliestUsedBy() {
        return $this->earliestUsedBy;
    }
}