<?php
class Fridge {
    private $items = array();

    public function getItems() {
        return $this->items;
    }

    public function fillFromArray(array $items) {
        foreach ($items as $item) {
            $this->put(new Ingredient(
                $item[0],
                $item[1],
                $item[2],
                date_create_from_format('d/m/Y', $item[3])
            ));
        }
    }

    public function put(Ingredient $ingredient) {
        if (!$ingredient->hasExpired()) {
            $this->items[] = $ingredient;
        }
    }

    public function lookup($name, $unit, $amount) {
        $search = strval($name) . '@' . strval($unit);

        $results = array();
        $totalAmount = 0;
        $reorderedItems = $this->reorderItemsByExpiry($this->items);
        foreach ($reorderedItems as $item) {
            if (false !== stripos(strval($item), $search)) {
                $results[] = $item;
                $totalAmount += $item->getAmount();
            }

            if ($amount <= $totalAmount) {
                break;
            }
        }

        // return empty array if not sufficient amount
        if ($amount > $totalAmount) {
            return array();
        }

        return $results;
    }

    private function reorderItemsByExpiry($items) {
        usort($items, function($a, $b) {
            if ($a->getUsedBy() > $b->getUsedBy()) {
                return 1;
            } elseif ($a->getUsedBy() == $b->getUsedBy()) {
                return 0;
            } else {
                return -1;
            }
        });
        return $items;
    }
}