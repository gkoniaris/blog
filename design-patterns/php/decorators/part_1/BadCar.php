<?php

class Car
{
    protected $name, $type, $engineConversionStage, $turboConversionStage, $soundSystem;

    public function __construct($name, $type, $engineConversionStage, $turboConversionStage, $soundSystem = false)
    {
        $this->name = $name;
        $this->type = $type;
        $this->engineConversionStage = $engineConversionStage;
        $this->turboConversionStage = $turboConversionStage;
        $this->soundSystem = $soundSystem;
    }

    public function price()
    {
        $price = null;

        switch($this->type)
        {
            case 'normal':
                $price = 38000;
                break;

            case 'sport':
                $price = 79000;
                break;

            case 'supersport':
                $price = 195000;
                break;
        }

        return $price;
    }

    public function maxSpeed()
    {
        $maxSpeed = null;

        switch($this->type)
        {
            case 'normal':
                $maxSpeed = 210;
                break;

            case 'sport':
                $maxSpeed = 260;
                break;
            
            case 'race':
                $maxSpeed = 310;
                break;
        }

        return $maxSpeed();
    }

    public function getSpecifications()
    {
        return "This is a " . $this->type . " with a top speed of " . $this->maxSpeed() . " km/h costing $" . $this->price();
    }
}