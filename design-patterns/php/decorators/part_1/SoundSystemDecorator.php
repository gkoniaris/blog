<?php

class SoundSystemDecorator
{
    protected $entity;
    protected $stage;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    public function price()
    {
        return $this->entity->price() + 400;
    }

    public function maxSpeed()
    {
        return $this->entity->maxSpeed() - 5;
    }

}