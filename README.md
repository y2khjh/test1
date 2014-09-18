=== Required ===

PHP 5.3.10+
PHPUnit 4.2.6+

=== How to run ===


php Main.php <file1> <file2>

<file1> - fridge CSV data
<file2> - recipes JSON data

if <file1> and <file2> not given, by default the program will use:

fridge.csv and recipes.js


=== How to run Unit Test ===


phpunit --bootstrap Bootstrap.php tests/
