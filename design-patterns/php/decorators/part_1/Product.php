<?php

class Product
{
    public $name, $type, $weight, $price;

    public function __construct($name, $type, $weight, $price)
    {
        $this->name = $name;
        $this->type = $type;
        $this->weight = $weight;
        $this->price = $price;
    }

    public function price()
    {
        $shippingCost = null;

        switch(true)
        {
            case $this->weight === 0:
                $shippingCost = 0; // 0 dollars (eg non physical products)
                break;

            // Up to 1 kg
            case $this->weight <= 1000:
                $shippingCost = 5; // 5 dollars
                break;

            // 1.1 to 5 kg
            case $this->weight <= 5000:
                $shippingCost = 10; // 10 dollars
                break;

            // 5.1 to 20 kg
            case $this->weight <= 20000:
                $shippingCost = 20; // 20 dollars
                break;
            
            // 5.1 to 20 kg
            case $this->weight > 20000:
                $shippingCost = 100; // 100 dollars
                break;
        }

        $vatPercentage = null;

        switch($this->type)
        {
            case 'service':
                $vatPercentage = 0.13; // Reduced VAT for services
                break;
            case 'food':
                $vatPercentage = 0.17; // Reduced VAT for food products
                break;
            default:
                $vatPercentage = 0.24; // All other products have a 24% VAT
        }

        $price = ($this->price * (1 + $vatPercentage)) +  $shippingCost;
        
        return $price;
    }
}