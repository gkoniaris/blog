<?php

class ShippingDecorator extends BaseDecorator
{
    protected $entity;

    public function __construct($entity)
    {
        parent::__construct($entity);
    }

    public function price()
    {
        $shippingCost = null;

        switch(true)
        {
            case $this->entity->weight === 0:
                $shippingCost = 0; // 0 dollars (eg non physical products)
                break;

            // Up to 1 kg
            case $this->entity->weight <= 1000:
                $shippingCost = 5; // 5 dollars
                break;

            // 1.1 to 5 kg
            case $this->entity->weight <= 5000:
                $shippingCost = 10; // 10 dollars
                break;

            // 5.1 to 20 kg
            case $this->entity->weight <= 20000:
                $shippingCost = 20; // 20 dollars
                break;
            
            // 5.1 to 20 kg
            case $this->entity->weight > 20000:
                $shippingCost = 100; // 100 dollars
                break;
        }

        return $this->entity->price() + $shippingCost;
    }
}