<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\MaxException;

class Max extends AbstractRule
{

    protected $max;

    public function __construct($maxValue)
    {
        $this->max = $maxValue;
    }

    public function validate($input)
    {
        return $input <= $this->max;
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this->getException() ? : MaxException::create()
                    ->configure($input, $this->max);
        return true;
    }

}