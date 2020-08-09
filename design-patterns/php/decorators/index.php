<?php
require_once('./dependencies.php');

$sandwich = new Product('Sandwich', 'food', 200, 3.5);

echo ($sandwich->price());
echo ("\n");

$tomatoes = new ProductToBeDecorated('Tomatoes', 'food', 5000, 7.5);
$tomatoes = new VatDecorator($tomatoes);
// $tomatoes = new ShippingDecorator($tomatoes);

echo ($tomatoes->price());
echo ("\n");

$potatoes = new DecoratorBuilder(new ProductToBeDecorated('Potatoes', 'food', 5000, 7.5));
$potatoes = $potatoes
            ->applyDecorator(VatDecorator::class)
            ->applyDecorator(ShippingDecorator::class);

echo ($potatoes->price());
echo ("\n");
