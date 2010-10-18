<?php

namespace Respect\Validation\Rules;

use \Exception;
use Respect\Validation\Validator;
use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NotBetweenException;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validatable;

class Between extends AbstractRule
{

    public function __construct($min=null, $max=null, Validatable $type=null)
    {
        $this->min = $min;
        $this->max = $max;
        $this->type = $type;
        if (!is_null($min) && !is_null($max) && $min > $max)
            throw new ComponentException(
                sprintf(
                    '%s cannot be less than  %s for validation', $this->min,
                    $this->max
                )
            );
        if (is_null($type))
            return;
        try {
            $type->assert($min);
            $type->assert($max);
        } catch (Exception $e) {
            throw new ComponentException(
                $e->getMessage()
            );
        }
    }

    public function validateMin($input)
    {
        return is_null($this->min) || $input >= $this->min;
    }

    public function validateMax($input)
    {
        return is_null($this->max) || $input <= $this->max;
    }

    public function validate($input)
    {
        return (is_null($this->type) || $this->type->validate($input))
        && $this->validateMin($input)
        && $this->validateMax($input);
    }

    public function assert($input)
    {
        if (!is_null($this->type))
            $this->type->assert($input);
        $validMin = $this->validateMin($input);
        $validMax = $this->validateMax($input);
        if (!$validMin || !$validMax)
            throw new NotBetweenException(
                $input,
                $validMin,
                $validMax,
                $this->min,
                $this->max
            );
        return true;
    }

}