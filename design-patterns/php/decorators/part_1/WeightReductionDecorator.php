<?php

class WeightReductionDecorator
{
    protected $entity;
    protected $stage;

    public function __construct($entity, $stage)
    {
        $this->entity = $entity;
        $this->stage = $stage;
    }

    public function price()
    {
        switch($this->stage)
        {
            case 1:
                return $this->entity->price() + 100;
            case 2:
                return $this->entity->price() + 300;
            case 3:
                return $this->entity->price() + 500;
        }
    }

    public function maxSpeed()
    {
        switch($this->stage)
        {
            case 1:
                return $this->entity->maxSpeed() + 5;
            case 2:
                return $this->entity->maxSpeed() + 10;
            case 3:
                return $this->entity->maxSpeed() + 15;
        }
    }

}