<?php

require_once('./Product.php');
require_once('./BaseDecorator.php');
require_once('./ProductToBeDecorated.php');
require_once('./VatDecorator.php');
require_once('./ShippingDecorator.php');

$sandwich = new Product('Sandwich', 'food', 200, 3.5);

echo ($sandwich->price());
echo ("\n");

$tomatoes = new ProductToBeDecorated('Tomatoes', 'food', 5000, 3.5);
$tomatoes = new VatDecorator($tomatoes);
$tomatoes = new ShippingDecorator($tomatoes);

echo ($tomatoes->price());
echo ("\n");