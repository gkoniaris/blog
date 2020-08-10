<?php

class Car
{
    protected $name, $type;

    public function __construct($name, $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function price()
    {
        switch($this->type)
        {
            case 'normal':
                return 38000;

            case 'sport':
                return 79000;
            
            case 'supersport':
                return 195000;
        }
    }

    public function maxSpeed()
    {
        switch($this->type)
        {
            case 'normal':
                return 210;

            case 'sport':
                return 260;
            
            case 'race':
                return 310;
        }
    }

    public function getSpecifications()
    {
        return "This is a " . $this->type . " with a top speed of " . $this->maxSpeed() . " km/h costing $" . $this->price();
    }
}