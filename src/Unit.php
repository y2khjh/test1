<?php
abstract class Unit {
    const OF = 'of';
    const GRAMS = 'grams';
    const ML = 'ml';
    const SLICES = 'slices';

    public static function validate($name) {
        $constClass = new ReflectionClass(__CLASS__);
        if (false !== $constClass->getConstant(strtoupper($name))) {
            return true;
        }
        return false;
    }
}