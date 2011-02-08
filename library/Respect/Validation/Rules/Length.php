<?php

namespace Respect\Validation\Rules;

use Countable;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\InvalidException;
use Respect\Validation\Exceptions\LengthException;
use Respect\Validation\Exceptions\NotNumericException;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Validator;

class Length extends AbstractRule
{

    protected $min;
    protected $max;
    protected $inclusive;

    public function __construct($min=null, $max=null, $inclusive=true)
    {
        $this->min = $min;
        $this->max = $max;
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

    public function reportError($input, array $related=array())
    {
        return parent::reportError($input, $related, $this->min, $this->max);
    }

    public function validate($input)
    {
        return $this->validateMin($input) && $this->validateMax($input);
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

    protected function validateMin($input)
    {
        $length = $this->extractLength($input);
        if (is_null($this->min))
            return true;
        if ($this->inclusive)
            return $length >= $this->min;
        else
            return $length > $this->min;
    }

    protected function validateMax($input)
    {
        $length = $this->extractLength($input);
        if (is_null($this->max))
            return true;
        if ($this->inclusive)
            return $length <= $this->max;
        else
            return $length < $this->max;
    }

}