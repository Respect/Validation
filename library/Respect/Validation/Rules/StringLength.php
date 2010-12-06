<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\StringLengthException;
use Respect\Validation\Validator;
use Respect\Validation\Exceptions\NotNumericException;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\InvalidException;

class StringLength extends AbstractRule
{

    protected $min;
    protected $max;

    public function __construct($min=null, $max=null)
    {
        $this->min = $min;
        $this->max = $max;
        $paramValidator = Validator::oneOf(
                Validator::numeric(), Validator::nullValue()
        );
        if (!$paramValidator->validate($min))
            throw new ComponentException(
                sprintf('%s is not a valid numeric length', $min)
            );

        if (!$paramValidator->validate($max))
            throw new ComponentException(
                sprintf('%s is not a valid numeric length', $max)
            );

        if (!is_null($min) && !is_null($max) && $min > $max) {
            throw new ComponentException(
                sprintf('%s cannot be less than %s for validation', $this->min,
                    $this->max)
            );
        }
    }

    public function validateMin($input)
    {
        $input = mb_strlen($input);
        return is_null($this->min) || $input >= $this->min;
    }

    public function validateMax($input)
    {
        $input = mb_strlen($input);
        return is_null($this->max) || $input <= $this->max;
    }

    public function validate($input)
    {
        return $this->validateMin($input) && $this->validateMax($input);
    }

    public function assert($input)
    {
        $validMin = $this->validateMin($input);
        $validMax = $this->validateMax($input);
        if (!$validMin || !$validMax)
            throw $this->getException() ? : $this->createException()
                    ->configure(
                        $input, $this->min, $this->max, $validMin, $validMax
                    );
        return true;
    }

}