<?php

namespace Respect\Validation\Rules;

class Instance extends AbstractRule
{

    public $instance;

    public function __construct($instance)
    {
        $this->instance = $instance;
    }

    public function reportError($input, array $related=array())
    {
        return parent::reportError($input, $related, $this->instance);
    }

    public function validate($input)
    {
        return $input instanceof $this->instance;
    }

}