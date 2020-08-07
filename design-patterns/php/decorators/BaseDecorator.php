<?php

abstract class BaseDecorator
{
    private $key;

    public function __construct($key, $object)
    {
        $this->key = $key;
        $this->{$key} = $object;
    }

    /**
     * Allows us to retrieve properties in the parent object
     */
    public function __get($property)
    {
        if (property_exists($this->{$this->key}, $property)) {
            return $this->{$this->key}->{$property};
        }

        throw new \Exception('Property ' . $property . ' does not exist in class ' . get_class($this));
    }

    /**
     * Allows us to set properties in the parent object
     */
    public function __set($property, $value)
    {
        $this->{$this->key}->{$property} = $value;
    }

    /**
     * Allows us to call the functions of the original object passed
     * in the constructor
     */
    public function __call($method, $args)
    {
        if (is_callable([$this->{$this->key}, $method])) {
            return $this->{$this->key}->{$method}($args);
        }

        throw new \Exception('Method ' . $method . ' does not exist in class ' . get_class($this->{$this->key}));
    }
}
