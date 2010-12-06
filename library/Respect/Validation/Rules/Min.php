<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\MinException;

class Min extends AbstractRule
{

    protected $min;

    public function __construct($minValue)
    {
        $this->min = $minValue;
    }

    public function validate($input)
    {
        return $input >= $this->min;
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this->getException() ? : MinException::create()
                    ->configure($input, $this->min);
        return true;
    }

}