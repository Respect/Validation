<?php

namespace Respect\Validation\Rules;

class Instance extends AbstractRule
{

    public $instance;

    public function __construct($instance)
    {
        $this->instance = $instance;
    }

    public function validate($input)
    {
        return $input instanceof $this->instance;
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this->reportError($input, array(), $this->instance);
        return true;
    }

}