<?php
require_once('./Car.php');
require_once('./EngineConversionDecorator.php');
require_once('./WeightReductionDecorator.php');
require_once('./SoundSystemDecorator.php');

$car = new Car('Prius', 'normal');
$car = new EngineConversionDecorator($car, 1);
$car = new WeightReductionDecorator($car, 2);
$car = new SoundSystemDecorator($car);

echo ($car->price());
echo ("\n");
echo ($car->maxSpeed());

