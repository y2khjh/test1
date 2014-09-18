<?php
include_once 'Bootstrap.php';

function main() {
    $fridge_csv_path = isset($argv[1]) ? $argv[1] : 'fridge.csv';
    $recipe_json_path = isset($argv[2]) ? $argv[2] : 'recipes.js';

    $ingredients = array_map('str_getcsv', file($fridge_csv_path));
    $recipes = json_decode(file_get_contents($recipe_json_path), 1);

    $fridge = new Fridge();
    $fridge->fillFromArray($ingredients);
    $finder = new Finder($fridge);
    $recipeToday = $finder->findRecipe($recipes);
    echo $recipeToday . "\n";
}

if (PHP_SAPI == 'cli') {
    main();
}
