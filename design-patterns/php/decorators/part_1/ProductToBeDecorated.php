<?php

class ProductToBeDecorated
{
    protected $name, $type, $weight, $price;

    public function __construct($name, $type, $weight, $price)
    {
        $this->name = $name;
        $this->type = $type;
        $this->weight = $weight;
        $this->price = $price;
    }

    public function price()
    {       
        return $this->price;
    }

    
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->{$property};
        }

        throw new \Exception('Property ' . $property . ' does not exist in class ' . get_class($this));
    }
}