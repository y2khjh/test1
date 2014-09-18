<?php
class Ingredient {
    private $item;
    private $amount;
    private $unit;
    private $usedBy;

    public function __construct($item, $amount, $unit, DateTime $usedBy) {
        $this->item = strval($item);
        $this->amount = intval($amount);
        $this->usedBy = $usedBy;
        if (Unit::validate($unit)) {
            $this->unit = strtolower($unit);
        } else {
            throw new InvalidArgumentException("Invalid unit");
        }
    }

    public function __toString() {
        return $this->item . '@' . $this->unit;
    }

    public function getItem() {
        return $this->item;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getUnit() {
        return $this->unit;
    }

    public function getUsedBy() {
        return $this->usedBy;
    }

    public function hasExpired() {
        if (new DateTime() > $this->getUsedBy()) {
            return true;
        }
        return false;
    }

    public function addAmount($amount) {
        $this->amount += $amount;
    }
}