<?php

namespace Respect\Validation\Rules;

use Countable;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Validator;

class Length extends AbstractRule
{

    public $minValue;
    public $maxValue;
    public $inclusive;

    public function __construct($min=null, $max=null, $inclusive=true)
    {
        $this->minValue = $min;
        $this->maxValue = $max;
        $this->inclusive = $inclusive;
        $paramValidator = new OneOf(new Numeric, new NullValue);
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
                sprintf('%s cannot be less than %s for validation', $min, $max)
            );
        }
    }

    public function validate($input)
    {
        $length = $this->extractLength($input);
        return $this->validateMin($length) && $this->validateMax($length);
    }

    protected function extractLength($input)
    {
        if (is_string($input))
            return mb_strlen($input);
        elseif (is_array($input) || $input instanceof Countable)
            return count($input);
        else
            return false;
    }

    protected function validateMin($length)
    {
        if (is_null($this->minValue))
            return true;
        elseif ($this->inclusive)
            return $length >= $this->minValue;
        else
            return $length > $this->minValue;
    }

    protected function validateMax($length)
    {
        if (is_null($this->maxValue))
            return true;
        elseif ($this->inclusive)
            return $length <= $this->maxValue;
        else
            return $length < $this->maxValue;
    }

}
