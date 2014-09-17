<?php
class Recipe {
    private $name;
    private $ingredients = array();

    public function __construct($name, array $ingredients) {
        if (!$ingredients) {
            throw new InvalidArgumentException('Ingredient cannot empty');
        }
        foreach ($ingredients as $ingredient) {
            if (!$ingredient instanceof Ingredient) {
                throw new InvalidArgumentException('Invalid ingredient');
            }
        }

        $this->name = strval($name);
        $this->ingredients = $ingredients;
    }

    public function getName() {
        return $this->name;
    }

    public function getIngredients() {
        return $this->ingredients;
    }
}