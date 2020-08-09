<?php
require_once('./dependencies.php');

$sandwich = new Product('Sandwich', 'food', 200, 3.5);

echo ($sandwich->price());
echo ("\n");

$tomatoes = new ProductToBeDecorated('Tomatoes', 'food', 5000, 7.5);
$tomatoes = new VatDecorator($tomatoes);

echo ($tomatoes->price());
echo ("\n");
