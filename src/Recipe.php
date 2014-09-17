<?php
class Recipe {
    private $name;
    private $ingredients = array();

    public function __construct($name, array $ingredients) {
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