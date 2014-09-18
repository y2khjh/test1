=== Required ===

PHP 5.3.10+
PHPUnit 4.2.6+

=== How to run ===


php Main.php fridge.csv recipes.js

fridge.csv - fridge CSV data

recipes.js - recipes JSON data

if fridge.csv and recipes.js not given, by default the program will use:

fridge.csv and recipes.js


=== How to run Unit Test ===


phpunit --bootstrap Bootstrap.php tests/
