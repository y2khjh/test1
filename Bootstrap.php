<?php
date_default_timezone_set('Australia/Sydney');

spl_autoload_register(function ($class) {
    include_once 'src' . DIRECTORY_SEPARATOR . ucwords($class) . '.php';
});