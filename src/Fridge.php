<?php
class Fridge {
    private $items = array();

    public function getItems() {
        return $this->items;
    }

    public function put(Ingredient $ingredient) {
        $this->items[] = $ingredient;
    }

    public function lookup(Ingredient $ingredient) {
        return array();
    }
}