<?php
class Ingredient {
    public $item;
    private $amount;
    private $unit;
    private $usedBy;

    public function __construct($item, $amount, $unit, DateTime $usedBy) {
        $this->item = strval($item);
        $this->amount = intval($amount);
        $this->usedBy = $usedBy;
        $this->unit = $unit;
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
}