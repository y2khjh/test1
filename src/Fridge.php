<?php
class Fridge {
    private $items = array();

    public function getItems() {
        return $this->items;
    }

    public function put(Ingredient $ingredient) {
        if (!$ingredient->hasExpired()) {
            $this->items[] = $ingredient;
        }
    }

    public function lookup(Ingredient $ingredient) {
        $positions = array_keys($this->items, $ingredient, true);
        $results = array();
        foreach ($positions as $index) {
            $results[] = &$this->items[$index];
        }
        return $results;
    }
}