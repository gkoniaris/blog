<?php

class DecoratorBuilder extends BaseDecorator {

    protected $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
        parent::__construct($entity);
    }
}