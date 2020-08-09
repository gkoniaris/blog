<?php

class VatDecorator
{
    protected $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    public function price()
    {
        $vatPercentage = null;

        switch($this->entity->type)
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

        $price = $this->entity->price() * (1 + $vatPercentage);
        
        return $price;
    }

}