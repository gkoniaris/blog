<?php

abstract class BaseDecorator
{
    private $key;

    public function __construct($object)
    {
        $this->entity = $object;
    }

    protected function getOriginal()
    {
        $original = $this->entity;
        
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

        if (is_callable([$originalObject, $method])) {
            return $originalObject->{$method}($args);
        }

        throw new \Exception('Method ' . $method . ' does not exist in class ' . get_class($this->entity));
    }

    public function applyDecorator($decoratorClass)
    {
        $arguments = func_get_args();

        array_shift($arguments);

        $decoratorInstance = new $decoratorClass($this, ...$arguments);

        return $decoratorInstance;
    }
}
