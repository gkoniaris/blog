<?php

abstract class BaseDecorator
{
    private $key;

    public function __construct($key, $object)
    {
        $this->key = $key;
        $this->{$key} = $object;
    }

    protected function getOriginal()
    {
        $original = $this->{$this->key};
        
        if (is_a($original, 'BaseDecorator')) {
            return $original->getOriginal();
        }

        return $original;
    }

    /**
     * Allows us to retrieve properties in the parent object
     */
    public function __get($property)
    {
        $originalObject = $this->getOriginal();

        if (property_exists($originalObject, $property)) {
            return $originalObject->{$property};
        }

        throw new \Exception('Property ' . $property . ' does not exist in class ' . get_class($this));
    }

    /**
     * Allows us to set properties in the parent object
     */
    public function __set($property, $value)
    {
        $originalObject = $this->getOriginal();

        $originalObject->{$property} = $value;
    }

    /**
     * Allows us to call the functions of the original object passed
     * in the constructor
     */
    public function __call($method, $args)
    {
        $originalObject = $this->getOriginal();

        if (is_callable([originalObject, $method])) {
            return $originalObject->{$method}($args);
        }

        throw new \Exception('Method ' . $method . ' does not exist in class ' . get_class($this->{$this->key}));
    }
}
