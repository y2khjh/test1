=== Required ===

PHP 5.3.10+
PHPUnit 4.2.6+

=== How to run ===


php Main.php csvfile1 jsonfile2

csvfile1 - fridge CSV data

jsonfile2 - recipes JSON data

if csvfile1 and jsonfile2 not given, by default the program will use:

fridge.csv and recipes.js


=== How to run Unit Test ===


phpunit --bootstrap Bootstrap.php tests/
