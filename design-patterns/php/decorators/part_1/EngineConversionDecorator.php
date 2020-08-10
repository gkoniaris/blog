<?php

class EngineConversionDecorator
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
                return $this->entity->price() + 500;
            case 2:
                return $this->entity->price() + 1500;
            case 3:
                return $this->entity->price() + 2500;
        }
    }

    public function maxSpeed()
    {
        switch($this->stage)
        {
            case 1:
                return $this->entity->maxSpeed() + 15;
            case 2:
                return $this->entity->maxSpeed() + 25;
            case 3:
                return $this->entity->maxSpeed() + 40;
        }
    }

}